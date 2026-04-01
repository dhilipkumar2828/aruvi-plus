<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\UserAddress;
use App\Models\OrderItem;
use App\Models\ShippingInfo;
use App\Models\Wishlist;
use App\Mail\CustomerOrderConfirmation;
use App\Mail\AdminOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', []);
        $subtotal = $this->calculateSubtotal($cart);
        [$coupon, $discount] = $this->resolveCoupon($subtotal);
        
        $user = Auth::user();
        $defaultAddress = $user ? $user->addresses()->where('is_default', true)->first() : null;
        
        // Get state from request or fallback to default address state
        $state = $request->get('state') ?: ($defaultAddress ? $defaultAddress->state : null);
        
        $shipping_charges = 0;
        $shipping_discount = 0;
        
        if ($state) {
            [$shipping_charges, $shipping_discount] = $this->calculateShipping($subtotal, $state);
        }
        
        $shipping = $shipping_charges - $shipping_discount;
        $total = max($subtotal - $discount + $shipping, 0);

        return view('cart', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping_charges' => $shipping_charges,
            'shipping_discount' => $shipping_discount,
            'shipping' => $shipping,
            'total' => $total,
            'coupon' => $coupon,
            'selected_state' => $state,
        ]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
            'action' => ['nullable', 'string'],
        ]);

        $product = Product::findOrFail($data['product_id']);
        $quantity = $data['quantity'] ?? 1;

        $cart = session('cart', []);
        $existing = $cart[$product->id] ?? null;

        if ($existing) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'image' => $product->primary_image,
                'slug' => $product->slug,
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]);

        $action = $data['action'] ?? 'add';
        if ($action === 'buy') {
            return redirect()
                ->route('cart.index')
                ->with('success', 'Item added to cart. You can continue to checkout.');
        }

        return back()->with('success', 'Item added to cart.');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session('cart', []);
        if (isset($cart[$data['product_id']])) {
            $cart[$data['product_id']]['quantity'] = $data['quantity'];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $cart = session('cart', []);
        unset($cart[$data['product_id']]);
        session(['cart' => $cart]);
        if (empty($cart)) {
            session()->forget('coupon_code');
        }

        return back()->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        session()->forget('cart');
        session()->forget('coupon_code');

        return back()->with('success', 'Cart cleared.');
    }

    public function showCheckout(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Your cart is empty.');
        }

        $subtotal = $this->calculateSubtotal($cart);
        [$coupon, $discount] = $this->resolveCoupon($subtotal);
        
        $user = Auth::user();
        $addresses = $user ? $user->addresses()->orderByDesc('is_default')->get() : collect();

        if ($user && $addresses->isEmpty() && $user->address_line1) {
            $profileAddress = new UserAddress([
                'user_id' => $user->id,
                'phone' => $user->phone,
                'address_line1' => $user->address_line1,
                'address_line2' => $user->address_line2,
                'city' => $user->city,
                'state' => $user->state,
                'postal_code' => $user->postal_code,
                'country' => $user->country,
                'is_default' => true
            ]);
            $addresses->push($profileAddress);
        }
        $defaultAddress = $addresses->where('is_default', true)->first() ?: $addresses->first();
        
        $state = $request->get('state') ?: ($defaultAddress ? $defaultAddress->state : null);
        [$shipping_charges, $shipping_discount] = $this->calculateShipping($subtotal, $state);
        
        $total = max($subtotal - $discount + $shipping_charges - $shipping_discount, 0);

        return view('checkout', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping_charges' => $shipping_charges,
            'shipping_discount' => $shipping_discount,
            'total' => $total,
            'coupon' => $coupon,
            'user' => $user,
            'addresses' => $addresses,
        ]);
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Your cart is empty.');
        }

        $user = $request->user();
        $subtotal = $this->calculateSubtotal($cart);
        [$coupon, $discount] = $this->resolveCoupon($subtotal);
        if ($coupon && $coupon->alreadyUsedBy($user)) {
            session()->forget('coupon_code');
            return redirect()
                ->route('cart.index')
                ->withErrors(['coupon' => 'You have already used this coupon.']);
        }

        $shipping = $request->validate([
            'phone' => ['required', 'string', 'max:50'],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:500'],
            'save_address' => ['nullable', 'boolean'],
        ]);

        if ($user && $request->boolean('save_address')) {
            $user->addresses()->updateOrCreate(
                [
                    'address_line1' => $shipping['address_line1'],
                    'postal_code' => $shipping['postal_code']
                ],
                [
                    'phone' => $shipping['phone'],
                    'address_line2' => $shipping['address_line2'] ?? null,
                    'city' => $shipping['city'],
                    'state' => $shipping['state'],
                    'country' => $shipping['country'],
                    'is_default' => !$user->addresses()->exists()
                ]
            );
        }

        $discountMap = [];
        if ($coupon && $discount > 0 && $subtotal > 0) {
            $items = array_values($cart);
            $remainingDiscount = $discount;
            $itemCount = count($items);

            foreach ($items as $index => $item) {
                $lineTotal = $item['price'] * $item['quantity'];
                if ($index === $itemCount - 1) {
                    $lineDiscount = $remainingDiscount;
                } else {
                    $lineDiscount = round(($lineTotal / $subtotal) * $discount, 2);
                    $remainingDiscount -= $lineDiscount;
                }
                $discountMap[$item['product_id']] = $lineDiscount;
            }
        }

        $distinctCount = count($cart);
        $totalUnits = collect($cart)->sum('quantity');
        $firstItem = reset($cart);
        $productSummary = $distinctCount === 1
            ? ($firstItem['name'] ?? 'Item')
            : 'Multiple items (' . $distinctCount . ' items)';

        $orderNumber = $this->generateOrderNumber();
        
        [$ship_charge, $ship_discount] = $this->calculateShipping($subtotal, $shipping['state']);
        $orderTotal = max($subtotal - $discount + $ship_charge - $ship_discount, 0);

        $order = Order::create([
            'order_number' => $orderNumber,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'phone' => $shipping['phone'],
            'address_line1' => $shipping['address_line1'],
            'address_line2' => $shipping['address_line2'] ?? null,
            'city' => $shipping['city'],
            'state' => $shipping['state'],
            'postal_code' => $shipping['postal_code'],
            'country' => $shipping['country'],
            'notes' => $shipping['notes'] ?? null,
            'product_name' => $productSummary,
            'product_id' => $distinctCount === 1 ? ($firstItem['product_id'] ?? null) : null,
            'quantity' => $totalUnits,
            'amount' => $orderTotal,
            'shipping_amount' => $ship_charge,
            'shipping_discount' => $ship_discount,
            'coupon_code' => $coupon?->code,
            'coupon_type' => $coupon?->type,
            'coupon_value' => $coupon?->value,
            'discount_amount' => $discount,
            'status' => 'processing',
            'payment_status' => 'pending',
        ]);

        // Prepare Product/HSN lookup for performance
        $productsMap = Product::whereIn('id', array_column($cart, 'product_id'))
            ->get()
            ->keyBy('id');

        foreach ($cart as $item) {
            $lineTotal = $item['price'] * $item['quantity'];
            $lineDiscount = $discountMap[$item['product_id']] ?? 0;
            $productModel = $productsMap[$item['product_id']] ?? null;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'hsn' => $productModel?->hsn,
                'unit_price' => $item['price'],
                'quantity' => $item['quantity'],
                'line_total' => $lineTotal,
                'line_discount' => $lineDiscount,
            ]);

            // Decrement Stock
            if ($productModel) {
                $productModel->stock = max(0, $productModel->stock - $item['quantity']);
                
                // Update status if out of stock
                if ($productModel->stock <= 0) {
                    $productModel->inventory_status = 'Out of Stock';
                }
                $productModel->save();
            }
        }

        if ($coupon) {
            $coupon->increment('usage_count');

            $usage = CouponUsage::create([
                'coupon_id' => $coupon->id,
                'user_id' => $user->id,
                'order_id' => $order->id,
                'used_at' => now(),
            ]);

            // Record which products the coupon was applied to in the pivot table
            $eligibleIds = $coupon->products()->pluck('products.id')->toArray();
            $usedOnProductIds = [];

            if (!empty($eligibleIds)) {
                foreach ($cart as $item) {
                    if (in_array($item['product_id'], $eligibleIds)) {
                        $usedOnProductIds[] = $item['product_id'];
                    }
                }
            } else {
                $usedOnProductIds = collect($cart)->pluck('product_id')->toArray();
            }

            if (!empty($usedOnProductIds)) {
                $usage->products()->attach($usedOnProductIds);
            }
        }

        // Clear from Wishlist if logged in
        if ($user) {
            Wishlist::where('user_id', $user->id)
                ->whereIn('product_id', array_keys($cart))
                ->delete();
        }

        // Send Emails
        try {
            // To Customer
            Mail::to($order->customer_email)->send(new CustomerOrderConfirmation($order));
            
            // To Admin
            $adminEmail = env('ADMIN_EMAIL', 'admin@bogor.com');
            Mail::to($adminEmail)->send(new AdminOrderNotification($order));
        } catch (\Exception $e) {
            // Log error or ignore to prevent checkout from failing due to mail issues
            \Illuminate\Support\Facades\Log::error('Order Mail Error: ' . $e->getMessage());
        }

        session()->forget('cart');
        session()->forget('coupon_code');

        return redirect()
            ->route('order.success', ['order' => $order->order_number])
            ->with('success', 'Thank you! Your order has been placed.');
    }

    public function orderSuccess($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('customer_email', Auth::user()->email)
            ->firstOrFail();

        return view('order-success', compact('order'));
    }

    public function applyCoupon(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['coupon' => 'Your cart is empty.']);
        }

        $data = $request->validate([
            'code' => ['required', 'string', 'max:50'],
        ]);

        $code = Str::upper(trim($data['code']));
        $coupon = Coupon::where('code', $code)->first();
        if (!$coupon) {
            return back()->withErrors(['coupon' => 'Invalid coupon code.']);
        }

        if ($request->user() && $coupon->alreadyUsedBy($request->user())) {
            return back()->withErrors(['coupon' => 'You have already used this coupon.']);
        }

        $subtotal = $this->calculateSubtotal($cart);
        $error = $coupon->validationError($subtotal, $cart);
        if ($error) {
            return back()->withErrors(['coupon' => $error]);
        }

        session(['coupon_code' => $coupon->code]);

        return back()->with('success', 'Coupon applied successfully.');
    }

    public function removeCoupon()
    {
        session()->forget('coupon_code');

        return back()->with('success', 'Coupon removed.');
    }

    private function generateOrderNumber(): string
    {
        $base = 'ORD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
        while (Order::where('order_number', $base)->exists()) {
            $base = 'ORD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
        }

        return $base;
    }

    private function calculateSubtotal(array $cart): float
    {
        return collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    private function resolveCoupon(float $subtotal): array
    {
        $code = session('coupon_code');
        if (!$code) {
            return [null, 0.0];
        }

        $coupon = Coupon::where('code', $code)->first();
        if (!$coupon) {
            session()->forget('coupon_code');
            return [null, 0.0];
        }

        $user = Auth::user();
        if ($user && $coupon->alreadyUsedBy($user)) {
            session()->forget('coupon_code');
            return [null, 0.0];
        }

        $cart = session('cart', []);
        if (!$coupon->isValidForSubtotal($subtotal, $cart)) {
            session()->forget('coupon_code');
            return [null, 0.0];
        }

        return [$coupon, $coupon->discountFor($subtotal, $cart)];
    }

    private function calculateShipping(float $subtotal, ?string $state): array
    {
        if (!$state) {
            return [0.0, 0.0];
        }

        $shippingInfo = ShippingInfo::where('from_amount', '<=', $subtotal)
            ->where('to_amount', '>=', $subtotal)
            ->first();

        if (!$shippingInfo) {
            // Fallback to highest range if amount exceeds all ranges
            $shippingInfo = ShippingInfo::orderByDesc('to_amount')->first();
        }

        if (!$shippingInfo) {
            return [0.0, 0.0];
        }

        $isTNPY = false;
        $stateLower = strtolower(trim($state));
        if (str_contains($stateLower, 'tamil') || str_contains($stateLower, 'pondi') || str_contains($stateLower, 'puduc')) {
            $isTNPY = true;
        }

        if ($isTNPY) {
            return [
                (float) $shippingInfo->shipping_charges_tn_py,
                (float) $shippingInfo->discount_tn_py
            ];
        }

        return [
            (float) $shippingInfo->shipping_charges_other,
            (float) $shippingInfo->discount_other
        ];
    }
    public function calculateShippingAjax(Request $request)
    {
        $state = $request->input('state');
        $cart = session('cart', []);
        
        $subtotal = $this->calculateSubtotal($cart);
        [$coupon, $discount] = $this->resolveCoupon($subtotal);
        
        [$shipping_charges, $shipping_discount] = $this->calculateShipping($subtotal, $state);
        
        $shipping = $shipping_charges - $shipping_discount;
        $total = max($subtotal - $discount + $shipping, 0);

        return response()->json([
            'shipping_charges' => $shipping_charges,
            'shipping_discount' => $shipping_discount,
            'shipping_net' => $shipping,
            'total' => $total,
            'formatted_shipping_charges' => '₹' . number_format($shipping_charges, 0),
            'formatted_shipping_discount' => '-₹' . number_format($shipping_discount, 0),
            'formatted_shipping_net' => $shipping <= 0 ? 'FREE' : '₹' . number_format($shipping, 0),
            'formatted_total' => '₹' . number_format($total, 0),
            'currency_symbol' => '₹'
        ]);
    }
}
