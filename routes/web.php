<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SiteAuthController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ShippingInfoController;

Route::get('/', [SiteController::class, 'home'])->name('home');

Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/faq', [SiteController::class, 'faq'])->name('faq');

Route::get('/shop', [SiteController::class, 'shop'])->name('shop');
Route::get('/category', function() { return redirect()->route('shop'); });
Route::get('/product/{product:slug}', [SiteController::class, 'product'])->name('product.show');
Route::post('/product/{product}/review', [SiteController::class, 'storeReview'])->name('product.review.store')->middleware('auth');
Route::get('/category/{slug}', [SiteController::class, 'category'])->name('category.show');

Route::get('/blogs', [SiteController::class, 'blogs'])->name('blogs.index');
Route::get('/blogs/{blog:slug}', [SiteController::class, 'blog'])->name('blogs.show');

Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [SiteController::class, 'storeInquiry'])->name('contact.store');

// Static Policy Pages
Route::get('/terms', function () { return view('policies.terms'); })->name('terms');
Route::get('/refund-policy', function () { return view('policies.refund'); })->name('refund');
Route::get('/shipping-policy', function () { return view('policies.shipping'); })->name('shipping');
Route::get('/privacy-policy', function () { return view('policies.privacy'); })->name('privacy');

Route::get('/product/detail', function () {
    return redirect()->route('product.show', ['product' => 'Aurvi Plus-shivlingam']);
})->name('product.detail');

Route::get('/product/murugan', function () {
    return redirect()->route('product.show', ['product' => 'navapasanam-lord-murugan-statue']);
})->name('product.murugan');

// Site Auth
Route::get('/login', [SiteAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [SiteAuthController::class, 'login'])->name('login.submit');
Route::get('/register', [SiteAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [SiteAuthController::class, 'register'])->name('register.submit');
Route::match(['get', 'post'], '/logout', [SiteAuthController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', [SiteAuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [SiteAuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [SiteAuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [SiteAuthController::class, 'updatePassword'])->name('password.update');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon.apply');
Route::post('/cart/coupon/remove', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');
Route::get('/checkout', [CartController::class, 'showCheckout'])->middleware('auth')->name('checkout');
Route::post('/checkout', [CartController::class, 'checkout'])->middleware('auth')->name('checkout.process');
Route::post('/cart/shipping-calc', [CartController::class, 'calculateShippingAjax'])->name('cart.shipping.calc');
Route::get('/order-success/{order}', [CartController::class, 'orderSuccess'])->name('order.success')->middleware('auth');

// Customer Routes
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WishlistController;

Route::middleware(['auth'])->group(function () {
    Route::get('/my-account', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('customer.orders');
    Route::get('/orders/{order}', [CustomerController::class, 'orderDetail'])->name('customer.orders.show');
    Route::get('/orders/{order}/download', [CustomerController::class, 'downloadInvoice'])->name('customer.orders.download');
    Route::get('/address', [CustomerController::class, 'address'])->name('customer.address');
    Route::post('/address/update', [CustomerController::class, 'updateAddress'])->name('customer.address.update');
    Route::get('/account-details', [CustomerController::class, 'accountDetails'])->name('customer.details');
    Route::post('/account-details', [CustomerController::class, 'updateAccountDetails'])->name('customer.details.update');
    Route::post('/account-details/password', [CustomerController::class, 'updatePassword'])->name('customer.password.update');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'store'])->name('wishlist.toggle');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::match(['get', 'post'], '/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');

    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');

    Route::get('/shipping-info', [ShippingInfoController::class, 'index'])->name('admin.shipping_info');
    Route::post('/shipping-info', [ShippingInfoController::class, 'update'])->name('admin.shipping_info.update');

    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::get('/orders/{order}/download', [AdminController::class, 'downloadInvoice'])->name('admin.orders.download');
    Route::get('/reports/transactions', [AdminController::class, 'transactionReport'])->name('admin.reports.transactions');
    Route::get('/orders/{order}/edit', [AdminController::class, 'editOrder'])->name('admin.orders.edit');
    Route::put('/orders/{order}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
    Route::delete('/orders/{order}', [AdminController::class, 'destroyOrder'])->name('admin.orders.destroy');
    Route::get('/coupons', [AdminController::class, 'coupons'])->name('admin.coupons');
    Route::get('/coupons/create', [AdminController::class, 'createCoupon'])->name('admin.coupons.create');
    Route::post('/coupons', [AdminController::class, 'storeCoupon'])->name('admin.coupons.store');
    Route::get('/coupons/{coupon}/edit', [AdminController::class, 'editCoupon'])->name('admin.coupons.edit');
    Route::put('/coupons/{coupon}', [AdminController::class, 'updateCoupon'])->name('admin.coupons.update');
    Route::delete('/coupons/{coupon}', [AdminController::class, 'destroyCoupon'])->name('admin.coupons.destroy');
    Route::get('/coupon-usages', [AdminController::class, 'couponUsages'])->name('admin.coupon_usages');
    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('admin.inquiries');
    Route::get('/inquiries/{inquiry}/edit', [AdminController::class, 'editInquiry'])->name('admin.inquiries.edit');
    Route::put('/inquiries/{inquiry}', [AdminController::class, 'updateInquiry'])->name('admin.inquiries.update');
    Route::delete('/inquiries/{inquiry}', [AdminController::class, 'destroyInquiry'])->name('admin.inquiries.destroy');
    Route::get('/blogs', [AdminController::class, 'blogs'])->name('admin.blogs');
    Route::get('/blogs/create', [AdminController::class, 'createBlog'])->name('admin.blogs.create');
    Route::post('/blogs', [AdminController::class, 'storeBlog'])->name('admin.blogs.store');
    Route::get('/blogs/{blog}/edit', [AdminController::class, 'editBlog'])->name('admin.blogs.edit');
    Route::put('/blogs/{blog}', [AdminController::class, 'updateBlog'])->name('admin.blogs.update');
    Route::delete('/blogs/{blog}', [AdminController::class, 'destroyBlog'])->name('admin.blogs.destroy');
    Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('admin.testimonials');
    Route::get('/testimonials/create', [AdminController::class, 'createTestimonial'])->name('admin.testimonials.create');
    Route::post('/testimonials', [AdminController::class, 'storeTestimonial'])->name('admin.testimonials.store');
    Route::get('/testimonials/{testimonial}/edit', [AdminController::class, 'editTestimonial'])->name('admin.testimonials.edit');
    Route::put('/testimonials/{testimonial}', [AdminController::class, 'updateTestimonial'])->name('admin.testimonials.update');
    Route::delete('/testimonials/{testimonial}', [AdminController::class, 'destroyTestimonial'])->name('admin.testimonials.destroy');

    Route::get('/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::patch('/reviews/{review}/approve', [AdminController::class, 'approveReview'])->name('admin.reviews.approve');
    Route::delete('/reviews/{review}', [AdminController::class, 'destroyReview'])->name('admin.reviews.destroy');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::put('/users/{user}/password', [AdminController::class, 'updateUserPassword'])->name('admin.users.password.update');

    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile/personal', [AdminController::class, 'updatePersonalInfo'])->name('admin.profile.personal');
    Route::post('/profile/address', [AdminController::class, 'updateAddress'])->name('admin.profile.address');           
    Route::post('/profile/password', [AdminController::class, 'updatePassword'])->name('admin.profile.password');
    Route::get('/validate-unique', [AdminController::class, 'validateUnique'])->name('admin.validate.unique');
});

// Auth Placeholders (If not using Breeze/Jetstream yet)
