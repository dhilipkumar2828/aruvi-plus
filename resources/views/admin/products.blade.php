@extends('layouts.admin')

@section('page_title', 'Product Management')

@section('content')
<div class="content-card" style="overflow: auto">
    <div class="card-header card-header-flex">
        <h3 style="margin: 0;">All Products</h3>
        <div class="card-header-actions">
            <form action="{{ route('admin.products') }}" method="GET" class="header-filter-form">
                <div class="header-search-wrap" style="position: relative; flex: 1; min-width: 200px;">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="header-search-input">
                </div>
                <select name="category" class="select2" data-placeholder="Select Category" onchange="this.form.submit()" style="min-width: 150px;">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <select name="stock_status" class="select2" data-placeholder="Select Stock" onchange="this.form.submit()" style="min-width: 140px;">
                    <option value="">Stock Status</option>
                    <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>

                <select name="status" class="select2" data-placeholder="Select Status" onchange="this.form.submit()" style="min-width: 120px;">
                    <option value="">Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>

                @if(request('category') || request('search') || request('status') || request('stock_status'))
                    <a href="{{ route('admin.products') }}" class="admin-btn" style="background: #fff; color: #ff6d00; border: 1px solid #ff6d00; padding: 6px 18px; font-weight: 800; text-transform: uppercase; font-size: 11px; height: 38px; display: inline-flex; align-items: center; letter-spacing: 0.5px; box-shadow: 0 2px 6px rgba(255, 109, 0, 0.1); border-radius: 50px;">CLEAR</a>
                @endif
            </form>
            <a href="{{ route('admin.products.create') }}" class="admin-btn admin-btn-primary" style="white-space: nowrap; height: 42px;">
                <i class="fas fa-plus"></i> Add Product
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table products-table">

            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                    <td>
                        <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden; background: var(--glass);">
                            @if ($product->primary_image)
                                <img src="{{ asset($product->primary_image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #666; font-size: 10px;">No Image</div>
                            @endif
                        </div>
                    </td>
                    <td class="text-nowrap">
                        <div style="font-weight: 600;">{{ $product->name }}</div>
                        <div style="font-size: 12px; color: #666;">SKU: {{ $product->sku ?? 'N/A' }}</div>
                    </td>
                    <td>{{ $product->category_rel?->name ?? $product->category ?? 'Uncategorized' }}</td>
                    <td>{{ format_inr($product->price) }}</td>
                    <td>
                        @if ($product->stock > 0)
                            <span class="status-badge status-success">{{ $product->stock }} Units</span>
                        @else
                            <span class="status-badge status-danger">Out of Stock</span>
                        @endif
                    </td>
                    <td>
                        @if ($product->is_active)
                            <span class="status-badge status-success">Active</span>
                        @else
                            <span class="status-badge status-danger">InActive</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-flex">
                            <a href="{{ route('admin.products.edit', $product) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="action-btn delete-confirm" type="submit" title="Delete" data-item-name="{{ $product->name }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="padding: 30px; text-align: center; color: #888;">
                        @if(request('search') || request('category') || request('stock_status') || request('status'))
                            No products found matching your criteria.
                        @else
                            No products yet. Create your first product.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>

    <div style="padding: 20px 30px; border-top: 1px solid rgba(194, 24, 91, 0.05); display: flex; justify-content: space-between; align-items: center;">
        <div style="color: var(--text-muted); font-size: 14px;">
            Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} entries
        </div>
        <div>
            {{ $products->links('pagination.admin') }}
        </div>
    </div>
</div>
@endsection
