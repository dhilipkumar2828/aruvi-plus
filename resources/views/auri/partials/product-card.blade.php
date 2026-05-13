<div class="product-card">
    <a href="{{ route('product.show', $product->slug) }}" class="product-card-link"></a>
    
    <div class="p-img-wrap">
        <a href="{{ route('product.show', $product->slug) }}">
            @php
                $img_path = $product->primary_image;
                if ($img_path && !str_starts_with($img_path, 'http') && !str_starts_with($img_path, '/')) {
                    $img_path = asset($img_path);
                }
            @endphp
            @if($img_path)
                <img src="{{ $img_path }}" alt="{{ $product->name }}" onerror="this.src='https://via.placeholder.com/300?text=Auvri+Product'">
            @else
                <img src="https://via.placeholder.com/300?text={{ urlencode($product->name) }}" alt="{{ $product->name }}">
            @endif
        </a>
        
        <!-- Wishlist Overlay -->
        @php
            $isInWishlist = Auth::check() && Auth::user()->wishlist->contains('product_id', $product->id);
        @endphp
        <form action="{{ route('wishlist.toggle') }}" method="POST" class="wishlist-overlay-form" style="position: absolute; top: 15px; right: 15px; z-index: 20;">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" style="width: 40px; height: 40px; border-radius: 50%; background: #fff; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); cursor: pointer; display: flex; align-items: center; justify-content: center; color: {{ $isInWishlist ? '#d4145a' : 'var(--primary)' }}; transition: all 0.3s ease;">
                <i class="{{ $isInWishlist ? 'fas' : 'far' }} fa-heart"></i>
            </button>
        </form>

        @php
            $img_path = $product->primary_image;
            if ($img_path && !str_starts_with($img_path, 'http') && !str_starts_with($img_path, '/')) {
                $img_path = asset($img_path);
            }
        @endphp
        @if($img_path)
            <img src="{{ $img_path }}" alt="{{ $product->name }}" onerror="this.src='https://via.placeholder.com/300?text=Auvri+Product'">
        @else
            <img src="https://via.placeholder.com/300?text={{ urlencode($product->name) }}" alt="{{ $product->name }}">
        @endif
        
        @if($product->compare_price && $product->compare_price > $product->price)
            <div style="position: absolute; top: 15px; left: 15px; background: #e53935; color: #fff; padding: 4px 10px; border-radius: 4px; font-size: 0.7rem; font-weight: 800; z-index: 5; box-shadow: 0 4px 10px rgba(229,57,53,0.2);">
                {{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}% OFF
            </div>
        @endif
    </div>
    <div class="p-info">
        <div class="p-rating">
            @for($i = 1; $i <= 5; $i++)
                <i class="{{ $i <= round($product->rating ?? 5) ? 'fas' : 'far' }} fa-star" style="color: #ffd700; font-size: 0.8rem;"></i>
            @endfor
        </div>
        <h4 class="p-title">{{ $product->name }}</h4>
        @if($product->category_rel)
            <span style="font-size: 0.8rem; color: var(--primary); opacity: 0.7;">{{ $product->category_rel->name }}</span>
        @endif
        <div class="p-bot">
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <span class="p-price" style="font-size: 1.2rem; font-weight: 800; color: #004200;">₹{{ number_format($product->price) }}</span>
                @if($product->compare_price && $product->compare_price > 0)
                    <span style="text-decoration: line-through; color: #999; font-size: 0.9rem; letter-spacing: 0.5px; opacity: 0.7;">₹{{ number_format($product->compare_price) }}</span>
                @endif
            </div>
            <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="add-btn" title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
            </form>
        </div>
    </div>
</div>
