@extends('layouts.auri')

@section('title', 'My Wishlist | Auvri Plus')

@section('content')
<div class="luxury-account-page">
    <div class="container">
        <!-- Page Header -->
        <div class="account-page-header">
            <h1 class="account-title">My Wishlist</h1>
            <div class="account-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <i class="fas fa-chevron-right separator"></i>
                <a href="{{ route('customer.dashboard') }}">Account</a>
                <i class="fas fa-chevron-right separator"></i>
                <span>Wishlist</span>
            </div>
        </div>

        <div class="account-grid">
            <!-- Sidebar -->
            <aside class="account-sidebar-col">
                @include('customer.sidebar')
            </aside>

            <!-- Main Content -->
            <div class="account-main-content">
                <div class="section-card">
                    <div class="section-header-flex">
                        <h3 class="premium-section-title">Saved Products</h3>
                        <span class="order-count">{{ $wishlistItems->count() }} Items</span>
                    </div>

                    @if($wishlistItems->count() > 0)
                        <div class="luxury-table-wrapper">
                            <table class="luxury-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wishlistItems as $item)
                                        <tr>
                                            <td>
                                                <div class="wishlist-product-cell">
                                                    <a href="{{ route('product.show', $item->product) }}" class="product-thumb">
                                                        @if($item->product->primary_image)
                                                            <img src="{{ asset($item->product->primary_image) }}" alt="{{ $item->product->name }}">
                                                        @else
                                                            <div class="placeholder"><i class="fas fa-image"></i></div>
                                                        @endif
                                                    </a>
                                                    <div class="product-info">
                                                        <a href="{{ route('product.show', $item->product) }}" class="product-link">{{ $item->product->name }}</a>
                                                        <span class="product-category">{{ $item->product->category?->name ?? 'Natural Wellness' }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product-price">₹{{ number_format($item->product->price, 2) }}</td>
                                            <td>
                                                <div class="action-btns center">
                                                    <form action="{{ route('cart.add') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit" class="icon-btn cart-btn" title="Add to Cart">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="icon-btn delete-btn" title="Remove">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon"><i class="far fa-heart"></i></div>
                            <h4 class="empty-title">Your wishlist is empty</h4>
                            <p>Explore our collections and save your favorites to review them later.</p>
                            <a href="{{ route('shop') }}" class="btn btn-premium">Start Exploring</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Wishlist Page Specific Styles */
.luxury-account-page {
    background: var(--beige-light);
    padding: 60px 0 100px;
    min-height: 80vh;
}

.account-page-header { margin-bottom: 40px;margin-top: 30px; }
.account-title {font-size: 38px; color: var(--primary); margin-bottom: 10px; }
.account-breadcrumb { display: flex; align-items: center; gap: 10px; font-size: 14px; color: #888; }
.account-breadcrumb a { color: var(--primary); font-weight: 600; }

.account-grid { display: grid; grid-template-columns: 320px 1fr; gap: 40px; }

.section-card {
    background: #fff;
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--beige-soft);
}

.section-header-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    border-bottom: 1px solid var(--beige-light);
    padding-bottom: 20px;
}

.premium-section-title { font-size: 24px; color: var(--primary); margin: 0; }
.order-count { font-size: 14px; color: #888; background: var(--beige-light); padding: 5px 15px; border-radius: 50px; }

/* Product Table Cell */
.wishlist-product-cell { display: flex; align-items: center; gap: 20px; }
.product-thumb { width: 70px; height: 70px; flex-shrink: 0; border-radius: 12px; overflow: hidden; background: #fff; border: 1px solid var(--beige-soft); }
.product-thumb img { width: 100%; height: 100%; object-fit: cover; }
.product-thumb .placeholder { height: 100%; display: flex; align-items: center; justify-content: center; color: #ccc; font-size: 24px; }

.product-link { font-weight: 700; color: #333; text-decoration: none; font-size: 16px; display: block; margin-bottom: 4px; transition: color 0.3s; }
.product-link:hover { color: var(--primary); }
.product-category { font-size: 12px; color: #999; }

.product-price { font-weight: 700; color: var(--primary); font-size: 16px; }

/* Luxury Table Override */
.luxury-table-wrapper { overflow-x: auto; }
.luxury-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
.luxury-table th { padding: 15px 20px; text-align: left; color: #999; font-size: 13px; text-transform: uppercase; font-weight: 600; }
.luxury-table td { padding: 15px 20px; background: var(--luxury-green-soft); font-size: 15px; vertical-align: middle; }
.luxury-table tr td:first-child { border-radius: 15px 0 0 15px; }
.luxury-table tr td:last-child { border-radius: 0 15px 15px 0; }

.text-center { text-align: center; }

/* Action Buttons */
.action-btns.center { justify-content: center; display: flex; gap: 12px; }

.icon-btn {
    width: 42px; height: 42px; border-radius: 12px; background: #fff; border: 1px solid var(--beige-soft);
    display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; cursor: pointer;
}

.cart-btn { color: var(--primary); }
.cart-btn:hover { background: var(--primary); color: #fff; border-color: var(--primary); }

.delete-btn { color: #d32f2f; }
.delete-btn:hover { background: #d32f2f; color: #fff; border-color: #d32f2f; }

/* Empty State */
.empty-state { text-align: center; padding: 100px 20px; }
.empty-icon { font-size: 70px; color: var(--beige-dark); margin-bottom: 30px; opacity: 0.5; }
.empty-title { font-size: 26px; color: var(--primary); margin-bottom: 10px; }
.btn-premium {
    background: var(--primary); color: #fff; padding: 15px 40px; border-radius: 50px;
    font-weight: 700; margin-top: 30px; display: inline-block; box-shadow: 0 10px 25px rgba(0, 66, 0, 0.2);
}

@media (max-width: 991px) {
    .account-grid { grid-template-columns: 1fr; }
}
</style>
@endsection
