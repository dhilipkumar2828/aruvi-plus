@extends('layouts.admin')

@section('page_title', 'Orders')

@section('content')
<div class="content-card orders-management-page">
    <style>
        /* Specific styles for Orders Page only */
        .orders-management-page .admin-btn {
            height: 42px !important;
            border-radius: 50px !important;
            padding: 0 25px !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            background: #fff !important;
            color: #ff6d00 !important;
            border: 1px solid #ff6d00 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 2px 8px rgba(255, 109, 0, 0.12) !important;
            transition: all 0.3s ease !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            cursor: pointer !important;
            text-decoration: none !important;
        }
        
        .orders-management-page .admin-btn:hover {
            background: #ff6d00 !important;
            color: #fff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(255, 109, 0, 0.2) !important;
        }
        
        .orders-management-page .header-filter-form {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }
    </style>
    <div class="card-header card-header-flex">
        <h3 style="margin: 0;">Order Management</h3>
        <div class="card-header-actions">
            <form id="orderFilterForm" action="{{ route('admin.orders') }}" method="GET" class="header-filter-form">
                <div class="header-search-wrap" style="position: relative; flex: 1; min-width: 200px;">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search orders..." class="header-search-input" id="orderSearchInput">
                </div>
                
                <select name="status" class="select2" data-placeholder="Select Status" onchange="this.form.submit()" style="min-width: 140px;">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                <select name="payment_status" class="select2" data-placeholder="Select Payment" onchange="this.form.submit()" style="min-width: 150px;">
                    <option value="">Payment Status</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>

                <div style="position: relative; min-width: 150px;">
                    <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()" class="datepicker" style="width: 100% !important;">
                </div>

                @if(count(request()->all()) > 0)
                    <a href="{{ route('admin.orders') }}" class="admin-btn">CLEAR</a>
                @endif
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table orders-table">

            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    {{-- <th>Product</th> --}}
                    <th>Qty</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
        <tbody>
            @forelse ($orders as $order)
                   @php
                    $status = strtolower($order->status);
                    $badgeClass = 'status-warning';
                    if ($status === 'delivered' || $status === 'shipped') {
                        $badgeClass = 'status-success';
                    } elseif ($status === 'cancelled') {
                        $badgeClass = 'status-danger';
                    }

                    $pStatus = strtolower($order->payment_status);
                    $pBadge = 'status-warning';
                    if ($pStatus === 'paid') {
                        $pBadge = 'status-success';
                    } elseif ($pStatus === 'failed' || $pStatus === 'cancelled') {
                        $pBadge = 'status-danger';
                    }
                @endphp
                <tr>
                    <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                    <td class="text-nowrap">#{{ $order->order_number }}</td>
                    <td class="text-nowrap">
                        <div style="font-weight: 600;">{{ $order->customer_name }}</div>
                        <div style="font-size: 12px; color: #666;">{{ $order->customer_email }}</div>
                    </td>
                    {{-- <td>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; max-width: 300px;">
                            @foreach($order->items as $item)
                                <span style="background: #f0fdf4; color: #166534; padding: 4px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; border: 1px solid #bbf7d0; white-space: nowrap;">
                                    {{ $item->product_name }}
                                </span>
                            @endforeach
                            @if($order->items_count > 1)
                                <span style="background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 50px; font-size: 11px; font-weight: 700; border: 1px solid #bae6fd;">
                                    +{{ $order->items_count - 1 }} More
                                </span>
                            @endif
                        </div>
                    </td> --}}
                    <td class="text-nowrap">{{ $order->quantity }}</td>
                    <td class="text-nowrap">{{ format_inr($order->amount) }}</td>
                    <td class="text-nowrap"><span class="status-badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span></td>
                    <td class="text-nowrap"><span class="status-badge {{ $pBadge }}">{{ $order->payment_status == 'pending' ? 'Unpaid' : ucfirst($order->payment_status) }}</span></td>
                    <td class="text-nowrap">{{ optional($order->created_at)->format('M d, Y') }}</td>
                    <td>
                        <div class="action-flex">
                            <a href="{{ route('admin.orders.show', $order) }}" class="action-btn" title="View Invoice">
                                <i class="fas fa-file-invoice"></i>
                            </a>
                            <a href="{{ route('admin.orders.edit', $order) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="action-btn delete-confirm" type="submit" title="Delete" data-item-name="{{ $order->order_number }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center; color: #888; padding: 30px;">
                        @if(request('search'))
                            No orders found for "{{ request('search') }}".
                        @elseif(request('status') && request('payment_status'))
                            No {{ ucfirst(request('status')) }} orders with {{ ucfirst(request('payment_status')) }} payment found.
                        @elseif(request('status'))
                            No {{ ucfirst(request('status')) }} orders found.
                        @elseif(request('payment_status'))
                            No {{ ucfirst(request('payment_status')) }} orders found.
                        @elseif(request('date'))
                            No orders found for {{ \Carbon\Carbon::parse(request('date'))->format('M d, Y') }}.
                        @else
                            No orders yet.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    <div style="padding: 20px 30px; border-top: 1px solid rgba(194, 24, 91, 0.05); display: flex; justify-content: space-between; align-items: center;">
        <div style="color: var(--text-muted); font-size: 14px;">
            Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} entries
        </div>
        <div>
            {{ $orders->links('pagination.admin') }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let filterTimer;
function debounceFilter(input) {
    clearTimeout(filterTimer);
    filterTimer = setTimeout(() => {
        document.getElementById('orderFilterForm').submit();
    }, 800);
}
</script>
@endsection
