<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inquiry;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::active()
            ->featured()
            ->orderByDesc('created_at')
            ->take(4)
            ->with('category_rel')
            ->get();

        $newArrivals = Product::active()
            ->newArrivals()
            ->orderByDesc('created_at')
            ->take(4)
            ->with('category_rel')
            ->get();

        $latestBlogs = Blog::published()
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->orderByDesc('created_at')
            ->get();

        $categories = Category::where('status', 'active')->get();

        return view('auri.home', compact('featuredProducts', 'newArrivals', 'latestBlogs', 'testimonials', 'categories'));
    }

    public function about()
    {
        return view('auri.about');
    }

    public function shop(Request $request)
    {
        $sort = $request->get('sort', 'default');

        $query = Product::active();

        if ($sort === 'low-high') {
            $query->orderBy('price');
        } elseif ($sort === 'high-low') {
            $query->orderByDesc('price');
        } elseif ($sort === 'newest') {
            $query->orderByDesc('created_at');
        } else {
            $query->orderBy('name');
        }

        $products = $query->with('category_rel')->get();
        $categories = Category::where('status', 'active')->get();

        return view('auri.shop', [
            'products' => $products,
            'categories' => $categories,
            'selectedSort' => $sort,
        ]);
    }

    public function product(Product $product)
    {
        $product->load(['reviews' => function ($query) {
            $query->orderByDesc('created_at');
        }]);

        $category = $product->category_rel ?? Category::where('name', $product->category)->first();

        // Related products from same category
        $relatedProducts = Product::active()
            ->where('id', '!=', $product->id)
            ->when($category, fn($q) => $q->where('category_id', $category->id))
            ->take(4)
            ->with('category_rel')
            ->get();

        return view('auri.product-detail', compact('product', 'category', 'relatedProducts'));
    }

    public function category($id_or_slug)
    {
        if (is_numeric($id_or_slug)) {
            $category = Category::findOrFail($id_or_slug);
        } else {
            $category = Category::where('slug', $id_or_slug)->firstOrFail();
        }
        $products = Product::active()
            ->where(function ($query) use ($category) {
                $query->where('category_id', $category->id)
                      ->orWhere('category', $category->name);
            })
            ->with('category_rel')
            ->get();
        $categories = Category::where('status', 'active')->get();

        return view('auri.shop', [
            'products' => $products,
            'categories' => $categories,
            'category' => $category,
            'selectedSort' => 'default'
        ]);
    }

    public function faq()
    {
        return view('auri.faq');
    }

    public function contact()
    {
        return view('auri.contact');
    }

    public function storeInquiry(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Inquiry::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'] ?? 'General',
            'message' => $data['message'],
            'status' => 'new',
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Thanks! Your inquiry has been sent. We will get back to you soon.');
    }

    public function storeReview(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        ProductReview::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'email' => $data['email'],
            'rating' => $data['rating'],
            'comment' => $data['comment'],
            'is_approved' => false,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Your review has been submitted and is pending administrator approval.');
    }

    public function blogs()
    {
        $blogs = Blog::published()
            ->orderByDesc('published_at')
            ->get();

        return view('blogs', compact('blogs'));
    }

    public function blog(Blog $blog)
    {
        if (!$blog->is_published) {
            abort(404);
        }

        return view('blog-show', compact('blog'));
    }
}
