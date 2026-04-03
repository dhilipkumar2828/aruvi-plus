<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Blog;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\CouponUsage;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    private function topProducts()
    {
        return Product::orderByDesc('stock')->take(3)->get();
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');
        $guard = Auth::guard('admin');

        // Check if user exists
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Email is Wrong.'])->withInput($request->only('email'));
        }

        if ($guard->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if ($guard->user()->role !== 'admin') {
                $guard->logout();
                return back()->withErrors(['email' => 'Access denied. Admins only.']);
            }

            return redirect()->route('admin.dashboard')->with('success', 'Admin Logged in Successfully!');
        }

        return back()->withErrors(['email' => 'Password is Wrong.'])->withInput($request->only('email'));
    }

    public function dashboard()
    {
        $topProducts = $this->topProducts();
        $recentOrders = Order::with('items')->orderByDesc('created_at')->paginate(5);
        $totalSales = Order::count();
        $revenue = Order::where('payment_status', 'paid')->sum('amount');
        $customers = User::where('role', 'customer')->count();
        $newInquiries = Inquiry::where('status', 'new')->count();

        return view('admin.dashboard', compact(
            'topProducts',
            'recentOrders',
            'totalSales',
            'revenue',
            'customers',
            'newInquiries'
        ));
    }

    public function products(Request $request)
    {
        $query = Product::with('category_rel');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('visibility', $request->status);
        }

        if ($request->filled('stock_status')) {
            if ($request->stock_status == 'in_stock') {
                $query->where('stock', '>', 0);
            } else {
                $query->where('stock', '<=', 0);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('sku', 'LIKE', "%{$search}%")
                  ->orWhere('slug', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $products = $query->orderByDesc('created_at')->paginate(10);
        $categories = Category::all();

        return view('admin.products', compact('products', 'categories'));
    }

    public function createProduct()
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.product-create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $data = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'product_sku' => ['required', 'string', 'max:100'],
            'product_hsn' => ['required', 'string', 'max:50'],
            'product_category' => ['required', 'exists:categories,id'],
            'product_collection' => ['required', 'string', 'max:150'],
            'product_visibility' => ['nullable', 'string', 'max:50'],
            'product_price' => ['required', 'numeric'],
            'product_compare' => ['nullable', 'numeric'],
            'product_stock' => ['required', 'integer', 'min:0'],
            'product_low_stock' => ['nullable', 'integer', 'min:0'],
            'product_inventory_status' => ['required', 'string', 'max:50'],
            'product_tax_class' => ['nullable', 'string', 'max:50'],
            'product_summary' => ['nullable', 'string'],
            'product_description' => ['nullable', 'string'],
            'product_weight' => ['nullable', 'string', 'max:50'],
            'product_dimensions' => ['nullable', 'string', 'max:80'],
            'product_material' => ['nullable', 'string', 'max:120'],
            'product_origin' => ['nullable', 'string', 'max:120'],
            'product_tags' => ['nullable', 'string'],
            'product_meta_title' => ['nullable', 'string', 'max:255'],
            'product_slug' => ['nullable', 'string', 'max:255'],
            'product_meta_description' => ['nullable', 'string'],
            'primary_image' => ['nullable', 'string', 'max:255'],
            'primary_image_upload' => ['nullable', 'image', 'max:5120'],
            'gallery_images' => ['nullable', 'string'],
            'gallery_uploads.*' => ['nullable', 'image', 'max:5120'],
            'badge_text' => ['nullable', 'string', 'max:50'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'reviews_count' => ['nullable', 'integer', 'min:0'],
        ]);

        $slug = $data['product_slug'] ?: Str::slug($data['product_name']);
        if (Product::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . Str::lower(Str::random(4));
        }

        $primaryImagePath = $data['primary_image'] ?? null;
        if ($request->hasFile('primary_image_upload')) {
            $primaryImagePath = $this->storeProductImage($request->file('primary_image_upload'), 'primary');
        }

        $galleryImages = [];
        if (!empty($data['gallery_images'])) {
            $galleryImages = array_filter(array_map('trim', explode(',', $data['gallery_images'])));
        }
        if ($request->hasFile('gallery_uploads')) {
            foreach ($request->file('gallery_uploads') as $upload) {
                if ($upload instanceof UploadedFile) {
                    $galleryImages[] = $this->storeProductImage($upload, 'gallery');
                }
            }
        }

        $visibility = $data['product_visibility'] ?? 'active';

        $category = null;
        if (!empty($data['product_category'])) {
            $category = Category::find($data['product_category']);
        }

        Product::create([
            'name' => $data['product_name'],
            'slug' => $slug,
            'sku' => $data['product_sku'] ?? null,
            'hsn' => $data['product_hsn'] ?? null,
            'category_id' => $data['product_category'] ?? null,
            'category' => $category?->name ?? null,
            'collection' => $data['product_collection'] ?? null,
            'visibility' => $visibility,
            'price' => $data['product_price'] ?? 0,
            'compare_price' => $data['product_compare'] ?? null,
            'stock' => $data['product_stock'] ?? 0,
            'low_stock' => $data['product_low_stock'] ?? 0,
            'inventory_status' => $data['product_inventory_status'] ?? 'in_stock',
            'tax_class' => $data['product_tax_class'] ?? 'standard',
            'is_featured' => $request->boolean('is_featured'),
            'is_new_arrival' => $request->boolean('is_new_arrival'),
            'allow_backorders' => $request->boolean('allow_backorders'),
            'is_active' => $visibility === 'active',
            'badge_text' => $data['badge_text'] ?? null,
            'rating' => $data['rating'] ?? 5,
            'reviews_count' => $data['reviews_count'] ?? 0,
            'short_description' => $data['product_summary'] ?? null,
            'description' => $data['product_description'] ?? null,
            'primary_image' => $primaryImagePath,
            'gallery_images' => $galleryImages ?: null,
            'weight' => $data['product_weight'] ?? null,
            'dimensions' => $data['product_dimensions'] ?? null,
            'material' => $data['product_material'] ?? null,
            'origin' => $data['product_origin'] ?? null,
            'tags' => $data['product_tags'] ?? null,
            'meta_title' => $data['product_meta_title'] ?? null,
            'meta_description' => $data['product_meta_description'] ?? null,
        ]);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product created successfully.');
    }

    public function editProduct(Product $product)
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.product-create', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $data = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'product_sku' => ['required', 'string', 'max:100'],
            'product_hsn' => ['required', 'string', 'max:50'],
            'product_category' => ['required', 'exists:categories,id'],
            'product_collection' => ['required', 'string', 'max:150'],
            'product_visibility' => ['nullable', 'string', 'max:50'],
            'product_price' => ['required', 'numeric'],
            'product_compare' => ['nullable', 'numeric'],
            'product_stock' => ['required', 'integer', 'min:0'],
            'product_low_stock' => ['nullable', 'integer', 'min:0'],
            'product_inventory_status' => ['required', 'string', 'max:50'],
            'product_tax_class' => ['nullable', 'string', 'max:50'],
            'product_summary' => ['nullable', 'string'],
            'product_description' => ['nullable', 'string'],
            'product_weight' => ['nullable', 'string', 'max:50'],
            'product_dimensions' => ['nullable', 'string', 'max:80'],
            'product_material' => ['nullable', 'string', 'max:120'],
            'product_origin' => ['nullable', 'string', 'max:120'],
            'product_tags' => ['nullable', 'string'],
            'product_meta_title' => ['nullable', 'string', 'max:255'],
            'product_slug' => ['nullable', 'string', 'max:255'],
            'product_meta_description' => ['nullable', 'string'],
            'primary_image' => ['nullable', 'string', 'max:255'],
            'primary_image_upload' => ['nullable', 'image', 'max:5120'],
            'gallery_images' => ['nullable', 'string'],
            'gallery_uploads.*' => ['nullable', 'image', 'max:5120'],
            'badge_text' => ['nullable', 'string', 'max:50'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'reviews_count' => ['nullable', 'integer', 'min:0'],
        ]);

        $slug = $data['product_slug'] ?: ($product->slug ?: Str::slug($data['product_name']));
        if ($slug !== $product->slug && Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $slug . '-' . Str::lower(Str::random(4));
        }

        $primaryImagePath = $data['primary_image'] ?? $product->primary_image;
        if ($request->hasFile('primary_image_upload')) {
            $primaryImagePath = $this->storeProductImage($request->file('primary_image_upload'), 'primary');
            $this->deleteProductImage($product->primary_image);
        }

        $galleryImages = [];
        if (array_key_exists('gallery_images', $data)) {
            $galleryImages = !empty($data['gallery_images'])
                ? array_filter(array_map('trim', explode(',', $data['gallery_images'])))
                : [];
        } elseif (!empty($product->gallery_images)) {
            $galleryImages = $product->gallery_images;
        }
        if ($request->hasFile('gallery_uploads')) {
            foreach ($request->file('gallery_uploads') as $upload) {
                if ($upload instanceof UploadedFile) {
                    $galleryImages[] = $this->storeProductImage($upload, 'gallery');
                }
            }
        }

        $visibility = $data['product_visibility'] ?? $product->visibility ?? 'active';

        $category = null;
        if (!empty($data['product_category'])) {
            $category = Category::find($data['product_category']);
        }

        $product->update([
            'name' => $data['product_name'],
            'slug' => $slug,
            'sku' => $data['product_sku'] ?? null,
            'hsn' => $data['product_hsn'] ?? null,
            'category_id' => $data['product_category'] ?? null,
            'category' => $category?->name ?? null,
            'collection' => $data['product_collection'] ?? null,
            'visibility' => $visibility,
            'price' => $data['product_price'] ?? 0,
            'compare_price' => $data['product_compare'] ?? null,
            'stock' => $data['product_stock'] ?? 0,
            'low_stock' => $data['product_low_stock'] ?? 0,
            'inventory_status' => $data['product_inventory_status'] ?? 'in_stock',
            'tax_class' => $data['product_tax_class'] ?? 'standard',
            'is_featured' => $request->boolean('is_featured'),
            'is_new_arrival' => $request->boolean('is_new_arrival'),
            'allow_backorders' => $request->boolean('allow_backorders'),
            'is_active' => $visibility === 'active',
            'badge_text' => $data['badge_text'] ?? null,
            'rating' => $data['rating'] ?? 5,
            'reviews_count' => $data['reviews_count'] ?? 0,
            'short_description' => $data['product_summary'] ?? null,
            'description' => $data['product_description'] ?? null,
            'primary_image' => $primaryImagePath,
            'gallery_images' => $galleryImages ?: null,
            'weight' => $data['product_weight'] ?? null,
            'dimensions' => $data['product_dimensions'] ?? null,
            'material' => $data['product_material'] ?? null,
            'origin' => $data['product_origin'] ?? null,
            'tags' => $data['product_tags'] ?? null,
            'meta_title' => $data['product_meta_title'] ?? null,
            'meta_description' => $data['product_meta_description'] ?? null,
        ]);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product updated successfully.');
    }

    public function destroyProduct(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product deleted successfully.');
    }

    public function categories(Request $request)
    {
        $query = Category::orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('slug', 'LIKE', "%{$search}%");
            });
        }

        $categories = $query->paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.category-create');
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'image' => ['nullable', 'image', 'max:5120'],
            'status' => ['nullable', 'string', 'in:active,inactive'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->storeImage($request->file('image'), 'uploads/categories', 'category');
        }

        $slug = $data['slug'] ?: Str::slug($data['name']);
        
        Category::create([
            'name' => $data['name'],
            'slug' => $slug,
            'image' => $imagePath,
            'status' => $data['status'] ?? 'active',
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category created successfully.');
    }

    public function editCategory(Category $category)
    {
        return view('admin.category-create', compact('category'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($category->id)],
            'image' => ['nullable', 'image', 'max:5120'],
            'status' => ['nullable', 'string', 'in:active,inactive'],
        ]);

        $slug = $data['slug'] ?: Str::slug($data['name']);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                $this->deleteImage($category->image);
            }
            $imagePath = $this->storeImage($request->file('image'), 'uploads/categories', 'category');
        }

        $category->update([
            'name' => $data['name'],
            'slug' => $slug,
            'image' => $imagePath,
            'status' => $data['status'] ?? 'active',
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(Category $category)
    {
        if ($category->image) {
            $this->deleteImage($category->image);
        }
        $category->delete();

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category deleted successfully.');
    }

    public function coupons(Request $request)
    {
        $query = Coupon::orderByDesc('created_at');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('code', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $coupons = $query->paginate(10);

        return view('admin.coupons', compact('coupons'));
    }

    public function createCoupon()
    {
        $products = Product::active()->get();
        return view('admin.coupons-create', compact('products'));
    }

    public function storeCoupon(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:255'],
            'type' => ['required', Rule::in(['percent', 'fixed'])],
            'value' => ['required', 'numeric', 'min:0.01'],
            'minimum_amount' => ['nullable', 'numeric', 'min:0'],
            'maximum_discount' => ['nullable', 'numeric', 'min:0'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['exists:products,id'],
        ]);

        $code = Str::upper(trim($data['code']));
        if (Coupon::where('code', $code)->exists()) {
            return back()->withErrors(['code' => 'Coupon code already exists.'])->withInput();
        }

        if ($data['type'] === 'percent' && $data['value'] > 100) {
            return back()->withErrors(['value' => 'Percentage value cannot exceed 100.'])->withInput();
        }

        $startsAt = !empty($data['starts_at']) ? Carbon::parse($data['starts_at'])->startOfDay() : null;
        $endsAt = !empty($data['ends_at']) ? Carbon::parse($data['ends_at'])->endOfDay() : null;

        $coupon = Coupon::create([
            'code' => $code,
            'description' => $data['description'] ?? null,
            'type' => $data['type'],
            'value' => $data['value'],
            'minimum_amount' => $data['minimum_amount'] ?? null,
            'maximum_discount' => $data['maximum_discount'] ?? null,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'usage_limit' => $data['usage_limit'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        if ($request->has('product_ids')) {
            $coupon->products()->sync($request->product_ids);
        }

        return redirect()
            ->route('admin.coupons')
            ->with('success', 'Coupon created successfully.');
    }

    public function editCoupon(Coupon $coupon)
    {
        $products = Product::active()->get();
        $selectedProducts = $coupon->products()->pluck('products.id')->toArray();
        return view('admin.coupons-edit', compact('coupon', 'products', 'selectedProducts'));
    }

    public function updateCoupon(Request $request, Coupon $coupon)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('coupons', 'code')->ignore($coupon->id)],
            'description' => ['nullable', 'string', 'max:255'],
            'type' => ['required', Rule::in(['percent', 'fixed'])],
            'value' => ['required', 'numeric', 'min:0.01'],
            'minimum_amount' => ['nullable', 'numeric', 'min:0'],
            'maximum_discount' => ['nullable', 'numeric', 'min:0'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['exists:products,id'],
        ]);

        $code = Str::upper(trim($data['code']));
        if ($coupon->code !== $code && Coupon::where('code', $code)->exists()) {
            return back()->withErrors(['code' => 'Coupon code already exists.'])->withInput();
        }

        if ($data['type'] === 'percent' && $data['value'] > 100) {
            return back()->withErrors(['value' => 'Percentage value cannot exceed 100.'])->withInput();
        }

        $startsAt = !empty($data['starts_at']) ? Carbon::parse($data['starts_at'])->startOfDay() : null;
        $endsAt = !empty($data['ends_at']) ? Carbon::parse($data['ends_at'])->endOfDay() : null;

        $coupon->update([
            'code' => $code,
            'description' => $data['description'] ?? null,
            'type' => $data['type'],
            'value' => $data['value'],
            'minimum_amount' => $data['minimum_amount'] ?? null,
            'maximum_discount' => $data['maximum_discount'] ?? null,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'usage_limit' => $data['usage_limit'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        if ($request->has('product_ids')) {
            $coupon->products()->sync($request->product_ids);
        } else {
            $coupon->products()->detach();
        }

        return redirect()
            ->route('admin.coupons')
            ->with('success', 'Coupon updated successfully.');
    }

    public function destroyCoupon(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()
            ->route('admin.coupons')
            ->with('success', 'Coupon deleted successfully.');
    }

    public function couponUsages(Request $request)
    {
        $query = CouponUsage::with(['coupon', 'user', 'order'])
            ->orderByDesc('used_at')
            ->orderByDesc('created_at');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('coupon', function($sq) use ($search) {
                    $sq->where('code', 'LIKE', "%{$search}%");
                })->orWhereHas('user', function($sq) use ($search) {
                    $sq->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
                })->orWhereHas('order', function($sq) use ($search) {
                    $sq->where('order_number', 'LIKE', "%{$search}%");
                });
            });
        }

        $usages = $query->paginate(15);

        return view('admin.coupon-usages', compact('usages'));
    }

    public function orders(Request $request)
    {
        $query = Order::with('items')->withCount('items')
            ->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('order_id')) {
            $query->where('order_number', 'LIKE', "%{$request->order_id}%");
        }

        if ($request->filled('customer')) {
            $query->where('customer_name', 'LIKE', "%{$request->customer}%");
        }

        if ($request->filled('product')) {
            $query->whereHas('items', function($q) use ($request) {
                $q->where('product_name', 'LIKE', "%{$request->product}%");
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'LIKE', "%{$search}%")
                  ->orWhere('customer_name', 'LIKE', "%{$search}%")
                  ->orWhere('customer_email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhereHas('items', function($sq) use ($search) {
                      $sq->where('product_name', 'LIKE', "%{$search}%");
                  });
            });
        }

        $orders = $query->paginate(10);

        return view('admin.orders', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $order->load(['items']);
        return view('admin.order-detail', compact('order'));
    }

    public function downloadInvoice(Order $order)
    {
        $order->load('items');
        $pdf = Pdf::loadView('pdf.invoice', compact('order'));
        
        return $pdf->download('invoice-' . $order->order_number . '.pdf');
    }

    public function editOrder(Order $order)
    {
        $order->load('items');

        return view('admin.orders-edit', compact('order'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'string', 'max:50'],
            'payment_status' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order->update([
            'status' => strtolower($data['status']),
            'payment_status' => strtolower($data['payment_status']),
            'notes' => $data['notes'] ?? null,
        ]);

        return redirect()
            ->route('admin.orders')
            ->with('success', 'Order #' . $order->order_number . ' updated successfully.');
    }

    public function destroyOrder(Order $order)
    {
        if ($order->coupon_code) {
            $coupon = Coupon::where('code', $order->coupon_code)->first();
            if ($coupon) {
                $usage = null;
                $user = User::where('email', $order->customer_email)->first();
                if ($user) {
                    $usage = CouponUsage::where('coupon_id', $coupon->id)
                        ->where('user_id', $user->id)
                        ->first();
                }

                if (!$usage) {
                    $usage = CouponUsage::where('coupon_id', $coupon->id)
                        ->where('order_id', $order->id)
                        ->first();
                }

                if ($usage) {
                    $usage->delete();
                    if ($coupon->usage_count > 0) {
                        $coupon->decrement('usage_count');
                    }
                }
            }
        }

        $order->delete();

        return redirect()
            ->route('admin.orders')
            ->with('success', 'Order deleted successfully.');
    }

    public function inquiries(Request $request)
    {
        $query = Inquiry::orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('subject', 'LIKE', "%{$search}%")
                  ->orWhere('message', 'LIKE', "%{$search}%");
            });
        }

        $inquiries = $query->paginate(10);

        return view('admin.inquiries', compact('inquiries'));
    }

    public function editInquiry(Inquiry $inquiry)
    {
        return view('admin.inquiries-edit', compact('inquiry'));
    }

    public function updateInquiry(Request $request, Inquiry $inquiry)
    {
        $data = $request->validate([
            'status' => ['required', 'string', 'max:50'],
        ]);

        $inquiry->update([
            'status' => strtolower($data['status']),
        ]);

        return redirect()
            ->route('admin.inquiries')
            ->with('success', 'Inquiry from ' . $inquiry->name . ' updated successfully.');
    }

    public function destroyInquiry(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()
            ->route('admin.inquiries')
            ->with('success', 'Inquiry deleted successfully.');
    }

    public function users(Request $request)
    {
        $query = User::where('role', '!=', 'admin');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function blogs(Request $request)
    {
        $query = Blog::orderByDesc('published_at')->orderByDesc('created_at');
        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%");
            });
        }

        $blogs = $query->paginate(10);

        return view('admin.blogs', compact('blogs'));
    }

    public function createBlog()
    {
        return view('admin.blogs-create');
    }

    public function storeBlog(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blogs,slug'],
            'excerpt' => ['required', 'string', 'max:400'],
            'content' => ['required', 'string'],
            'image' => ['required', 'image', 'max:5120'],
            'author' => ['required', 'string', 'max:120'],
            'is_published' => ['required', 'boolean'],
            'published_at' => ['required', 'date'],
        ]);

        $slug = $data['slug'] ?: Str::slug($data['title']);
        if (Blog::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . Str::lower(Str::random(4));
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->storeImage($request->file('image'), 'uploads/blogs', 'blog');
        }

        Blog::create([
            'title' => $data['title'],
            'slug' => $slug,
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'image' => $imagePath,
            'author' => $data['author'],
            'is_published' => $request->boolean('is_published'),
            'published_at' => $data['published_at'],
        ]);

        return redirect()
            ->route('admin.blogs')
            ->with('success', 'Blog created successfully.');
    }

    public function editBlog(Blog $blog)
    {
        return view('admin.blogs-edit', compact('blog'));
    }

    public function updateBlog(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('blogs', 'slug')->ignore($blog->id)],
            'excerpt' => ['required', 'string', 'max:400'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'author' => ['required', 'string', 'max:120'],
            'is_published' => ['required', 'boolean'],
            'published_at' => ['required', 'date'],
        ]);

        $slug = $data['slug'] ?: Str::slug($data['title']);

        $imagePath = $blog->image;
        if ($request->hasFile('image')) {
            $this->deleteImage($blog->image);
            $imagePath = $this->storeImage($request->file('image'), 'uploads/blogs', 'blog');
        }

        $blog->update([
            'title' => $data['title'],
            'slug' => $slug,
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'image' => $imagePath,
            'author' => $data['author'],
            'is_published' => $request->boolean('is_published'),
            'published_at' => $data['published_at'],
        ]);

        return redirect()
            ->route('admin.blogs')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroyBlog(Blog $blog)
    {
        $blog->delete();

        return redirect()
            ->route('admin.blogs')
            ->with('success', 'Blog deleted successfully.');
    }

    public function testimonials(Request $request)
    {
        $query = Testimonial::orderByDesc('created_at');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('designation', 'LIKE', "%{$search}%");
            });
        }

        $testimonials = $query->paginate(10);

        return view('admin.testimonials', compact('testimonials'));
    }

    public function createTestimonial()
    {
        return view('admin.testimonials-create');
    }

    public function storeTestimonial(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'image' => ['nullable', 'image', 'max:5120'],
            'is_active' => ['required', 'boolean'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->storeImage($request->file('image'), 'uploads/testimonials', 'testimonial');
        }

        Testimonial::create([
            'name' => $data['name'],
            'designation' => $data['designation'],
            'content' => $data['content'],
            'rating' => $data['rating'],
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.testimonials')
            ->with('success', 'Testimonial created successfully.');
    }

    public function editTestimonial(Testimonial $testimonial)
    {
        return view('admin.testimonials-edit', compact('testimonial'));
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'image' => ['nullable', 'image', 'max:5120'],
            'is_active' => ['required', 'boolean'],
        ]);

        $imagePath = $testimonial->image;
        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                $this->deleteImage($testimonial->image);
            }
            $imagePath = $this->storeImage($request->file('image'), 'uploads/testimonials', 'testimonial');
        }

        $testimonial->update([
            'name' => $data['name'],
            'designation' => $data['designation'],
            'content' => $data['content'],
            'rating' => $data['rating'],
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.testimonials')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroyTestimonial(Testimonial $testimonial)
    {
        if ($testimonial->image) {
            $this->deleteImage($testimonial->image);
        }
        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials')
            ->with('success', 'Testimonial deleted successfully.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }

    public function profile()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.profile', compact('user'));
    }

    public function updatePersonalInfo(Request $request)
    {
        $user = Auth::guard('admin')->user();
        
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\(\) ]+$/'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
        ], [
            'phone.regex' => 'The phone number format is invalid. It should not contain letters.',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                $this->deleteImage($user->profile_image);
            }
            $user->profile_image = $this->storeImage($request->file('profile_image'), 'uploads/images', 'admin');
        }

        $user->save();

        return back()->with('success', 'Personal information updated successfully.');
    }

    public function updateAddress(Request $request)
    {
        $user = Auth::guard('admin')->user();
        
        $data = $request->validate([
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
        ]);

        $user->address_line1 = $data['address_line1'];
        $user->address_line2 = $data['address_line2'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->postal_code = $data['postal_code'];
        $user->country = $data['country'];

        $user->save();

        return back()->with('success', 'Address details updated successfully.')->with('active_tab', 'address');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::guard('admin')->user();
        
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make($data['password']);
        $user->save();

        return back()->with('success', 'Password updated successfully.')->with('active_tab', 'security');
    }

    private function storeProductImage(UploadedFile $file, string $prefix = 'product'): string
    {
        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = $prefix . '-' . Str::lower(Str::random(12)) . '-' . time() . '.' . $extension;
        $targetDir = public_path('uploads/products');

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $file->move($targetDir, $filename);

        return 'uploads/products/' . $filename;
    }

    private function deleteProductImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        $normalized = str_replace('\\', '/', $path);
        if (!str_starts_with($normalized, 'uploads/products/')) {
            return;
        }

        $fullPath = public_path($normalized);
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }

    private function storeImage(UploadedFile $file, string $folder, string $prefix): string
    {
        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = $prefix . '-' . Str::lower(Str::random(12)) . '-' . time() . '.' . $extension;
        $targetDir = public_path($folder);

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $file->move($targetDir, $filename);

        return $folder . '/' . $filename;
    }

    private function deleteImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        $fullPath = public_path($path);
        if (file_exists($fullPath)) {
            @unlink($fullPath);
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function validateUnique(Request $request)
    {
        $table = $request->query('table');
        $column = $request->query('column');
        $value = $request->query('value');
        $ignoreId = $request->query('ignore_id');

        $allowedTables = ['categories', 'products', 'blogs', 'users'];
        if (!in_array($table, $allowedTables)) {
            return response()->json(['exists' => false]);
        }

        $query = DB::table($table)->where($column, $value);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $exists = $query->exists();

        return response()->json(['exists' => $exists]);
    }
}
