@extends('layouts.auri')

@section('title', 'My Wishlist | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('content')
<style>
    /* Desktop & General Styles */
    .main-content {
        padding-top: 40px !important;
        padding-bottom: 0px !important;
        min-height: auto !important;
    }
    
    .wishlist-table-container {
        width: 100%;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .wishlist-table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap; /* Ensures table cells don't wrap weirdly on small screens */
    }

    .wishlist-table thead {
        background: linear-gradient(135deg, #FF9800, #C2185B);
        color: #fff;
    }

    .wishlist-table th {
        padding: 18px;
        text-align: center;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 1px;
        border: none;
    }
    
    .wishlist-table th.align-left { text-align: left; }

    .wishlist-table tbody tr {
        border-bottom: 1px solid #eee;
        transition: background 0.3s;
    }

    .wishlist-table tbody tr:hover {
        background-color: #fafafa;
    }

    .wishlist-table td {
        padding: 20px;
        text-align: center;
        vertical-align: middle;
        color: #333;
    }
    
    .wishlist-table td.align-left {
        text-align: left;
    }

    /* Mobile Responsive Styles - Horizontal Scroll */
    @media (max-width: 992px) {
        .wishlist-table-container {
            margin-bottom: 40px; /* Added bottom space for mobile */
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Optional: adjust cell padding slightly for mobile to save some space */
        .wishlist-table td, .wishlist-table th {
            padding: 15px 10px;
        }
    }
</style>

<!-- Page Title / Hero -->
<section class="hero-small" style="background-image: url('{{ asset('images/hero_bg.jpg') }}'); margin-bottom: 0;">
    <div class="hero-overlay"></div>
    <div class="container">
        <h1>My Wishlist</h1>
        <p>{{ isset($wishlistItems) && $wishlistItems->count() > 0 ? 'Your curated collection of sacred treasures.' : 'Start collecting your divine favorites.' }}</p>
    </div>
</section>

<main class="main-content">

    <div class="container account-container">
        @if($wishlistItems->count() > 0)
            
            <div class="wishlist-table-container">
                <div class="table-responsive">
                    <table class="table wishlist-table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Product Image</th>
                                <th class="align-left">Product Name</th>
                                <th>Price</th>
                                <th>Cart</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wishlistItems as $item)
                                <tr>
                                    <td style="color: #555;">{{ $loop->iteration }}</td>
                                    
                                    <td>
                                        <a href="{{ route('product.show', $item->product) }}" style="display: block;">
                                            @if($item->product->primary_image)
                                                <img src="{{ asset($item->product->primary_image) }}" alt="{{ $item->product->name }}" style="width: 70px; height: auto; border-radius: 6px; display: inline-block;">
                                            @else
                                                <img src="{{ asset('images/placeholder.png') }}" alt="{{ $item->product->name }}" style="width: 70px; height: auto; border-radius: 6px; display: inline-block;">
                                            @endif
                                        </a>
                                    </td>
                                    
                                    <td class="align-left">
                                        <a href="{{ route('product.show', $item->product) }}" style="color: #333; font-weight: 600; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#C2185B'" onmouseout="this.style.color='#333'">
                                            {{ $item->product->name }}
                                        </a>
                                    </td>
                                    
                                    <td style="font-weight: 700; color: #C2185B;">
                                         ₹{{ number_format($item->product->price, 0) }}
                                    </td>
                                    
                                    <td>
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" style="background: none; border: none; cursor: pointer; transition: transform 0.2s;" title="Add to Cart" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                                 <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #FF9800, #F44336); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; box-shadow: 0 4px 10px rgba(244, 67, 54, 0.3);">
                                                    <i class="fas fa-shopping-cart" style="font-size: 18px;"></i>
                                                </div>
                                            </button>
                                        </form>
                                    </td>
                                    
                                    <td>
                                        <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-confirm" data-message="Remove {{ $item->product->name }} from your wishlist?" style="background: none; border: none; cursor: pointer; transition: transform 0.2s;" title="Remove" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                                <div style="width: 45px; height: 45px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #ff0000; border: 1px solid #ffcccc; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                                                    <i class="fas fa-trash-alt" style="font-size: 18px;"></i>
                                                </div>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @else
            <div style="background: #fff; padding: 60px 20px; border-radius: 12px; text-align: center; color: #777; box-shadow: 0 5px 20px rgba(0,0,0,0.05); border: 1px solid #eee;">
                <div style="width: 80px; height: 80px; background: #fce4ec; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-heart-broken" style="font-size: 32px; color: #C2185B;"></i>
                </div>
                <h3 style="font-size: 20px; color: #333; margin-bottom: 10px;">Your wishlist is empty</h3>
                <p style="font-size: 15px; margin-bottom: 25px; color: #888;">Explore our collections and save your favorite items here.</p>
                <a href="{{ route('shop') }}" class="btn" style="padding: 12px 35px; background: linear-gradient(135deg, #FF9800, #C2185B); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 600; box-shadow: 0 4px 15px rgba(194, 24, 91, 0.3); transition: all 0.3s;">Start Shopping</a>
            </div>
        @endif
    </div>
</main>
@endsection
