@extends('layouts.admin')

@section('page_title', 'Dashboard Overview')

@section('content')
<div class="stats-grid">
    <a href="{{ route('admin.orders') }}" class="stat-card" style="text-decoration: none; color: inherit; display: block;">
        <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
        <div class="stat-value">{{ $totalSales ?? 0 }}</div>
        <div class="stat-label">Total Orders</div>
    </a>
    <a href="{{ route('admin.orders') }}" class="stat-card" style="text-decoration: none; color: inherit; display: block;">
        <div class="stat-icon"><i class="fas fa-rupee-sign"></i></div>
        <div class="stat-value">{{ format_inr($revenue ?? 0) }}</div>
        <div class="stat-label">Revenue</div>
    </a>
    <a href="{{ route('admin.users') }}" class="stat-card" style="text-decoration: none; color: inherit; display: block;">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-value">{{ $customers ?? 0 }}</div>
        <div class="stat-label">Customers</div>
    </a>
    <a href="{{ route('admin.inquiries') }}" class="stat-card" style="text-decoration: none; color: inherit; display: block;">
        <div class="stat-icon"><i class="fas fa-comments"></i></div>
        <div class="stat-value">{{ $newInquiries ?? 0 }}</div>
        <div class="stat-label">New Inquiries</div>
    </a>
</div>

<div class="stats-grid" style="grid-template-columns: 1fr;">
    <div class="content-card" style="overflow: auto">
        <div class="card-header">
            <h3>Recent Orders</h3>
            <a href="{{ route('admin.orders') }}" style="color: var(--secondary); text-decoration: none; font-size: 14px; font-weight: 700; display: inline-flex; align-items: center; gap: 5px; transition: all 0.3s;">
                View All <i class="fas fa-chevron-right" style="font-size: 11px;"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    {{-- <th>Product</th> --}}
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse (($recentOrders ?? collect()) as $order)
                    @php
                        $status = strtolower($order->status);
                        $badgeClass = 'status-warning';
                        if ($status === 'delivered' || $status === 'shipped') {
                            $badgeClass = 'status-success';
                        } elseif ($status === 'cancelled') {
                            $badgeClass = 'status-danger';
                        }
                    @endphp
                    <tr>
                        <td>{{ ($recentOrders->currentPage() - 1) * $recentOrders->perPage() + $loop->iteration }}</td>
                        <td class="text-nowrap">#{{ $order->order_number }}</td>
                        <td class="text-nowrap">{{ $order->customer_name }}</td>
                        {{-- <td>
                            @if($order->items->count() > 0)
                                <div style="display: flex; flex-wrap: wrap; gap: 5px; max-width: 250px;">
                                    @foreach($order->items as $item)
                                        <span style="background: #f0fdf4; color: #166534; padding: 2px 8px; border-radius: 6px; font-size: 11px; font-weight: 600; border: 1px solid #bbf7d0; white-space: nowrap;">
                                            {{ $item->product_name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span style="font-size: 13px;">{{ $order->product_name }}</span>
                            @endif
                        </td> --}}
                        <td>{{ format_inr($order->amount) }}</td>
                        <td><span class="status-badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span></td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="action-btn">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: #888; padding: 20px;">No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
            </table>
        </div>
        <div style="padding: 20px 30px; border-top: 1px solid rgba(0, 66, 0, 0.05); display: flex; justify-content: space-between; align-items: center;">
            <div style="color: var(--text-muted); font-size: 14px;">
                Showing {{ $recentOrders->firstItem() }} to {{ $recentOrders->lastItem() }} of {{ $recentOrders->total() }} entries
            </div>
            <div>
                {{ $recentOrders->links('pagination.admin') }}
            </div>
        </div>
    </div>

    {{-- <div class="content-card">
        <div class="card-header">
            <h3>Top Products</h3>
            <a href="{{ route('admin.products') }}" style="color: var(--primary-light); text-decoration: none; font-size: 13px;">Manage</a>
        </div>
        <div style="padding: 20px;">
            @forelse (($topProducts ?? collect()) as $product)
                <a href="{{ route('admin.products.edit', $product->id) }}" style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; text-decoration: none; color: inherit;">
                    <div style="width: 45px; height: 45px; background: var(--glass); border-radius: 10px; overflow: hidden;">
                        @if ($product->primary_image)
                            <img src="{{ asset($product->primary_image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #666; font-size: 10px;">No Image</div>
                        @endif
                    </div>
                    <div style="flex: 1;">
                        <div style="font-size: 14px; font-weight: 600;">{{ $product->name }}</div>
                        <div style="font-size: 12px; color: #888;">Stock: {{ $product->stock }}</div>
                    </div>
                    <div style="font-weight: 700; color: var(--text-gold);">{{ format_inr($product->price) }}</div>
                </a>
            @empty
                <div style="color: #888; font-size: 13px;">No products available.</div>
            @endforelse
        </div>
    </div> --}}
</div>
@endsection
