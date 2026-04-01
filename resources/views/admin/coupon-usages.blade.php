@extends('layouts.admin')

@section('page_title', 'Coupon Usage History')

@section('content')
<div class="content-card" style="overflow: auto">
    <div class="card-header" style="flex-wrap: wrap; gap: 20px;">
        <h3>Coupon Usages</h3>
        <div style="display: flex; gap: 15px; align-items: center;">
            <form action="{{ route('admin.coupon_usages') }}" method="GET" style="display: flex; gap: 10px; align-items: center;">
                <div style="position: relative;">
                    <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #888; font-size: 13px;"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search usage..." style="padding: 10px 15px 10px 40px; border-radius: 50px; border: 1px solid #ddd; outline: none; background: #fff; min-width: 250px; font-size: 14px;">
                </div>
                @if(request('search'))
                    <a href="{{ route('admin.coupon_usages') }}" class="admin-btn" style="background: #fff; color: #ff6d00; border: 1px solid #ff6d00; padding: 6px 18px; font-weight: 800; text-transform: uppercase; font-size: 11px; height: auto; display: inline-flex; align-items: center; letter-spacing: 0.5px; box-shadow: 0 2px 6px rgba(255, 109, 0, 0.1);">CLEAR</a>
                @endif
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Coupon</th>
                    <th>Customer</th>
                    <th>Order ID</th>
                    <th>Applied Products</th>
                    <th>Used At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($usages as $usage)
                    <tr>
                        <td>{{ ($usages->currentPage() - 1) * $usages->perPage() + $loop->iteration }}</td>
                        <td>
                            <div style="font-weight: 700; color: var(--primary);">{{ $usage->coupon->code ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $usage->user->name ?? 'Guest/Unknown' }}</div>
                            <div style="font-size: 12px; color: #666;">{{ $usage->user->email ?? '' }}</div>
                        </td>
                        <td>
                            @if($usage->order)
                                <a href="{{ route('admin.orders.show', $usage->order) }}" style="text-decoration: none; color: var(--primary-dark); font-weight: 700;">
                                    #{{ $usage->order->order_number }}
                                </a>
                            @else
                                <span style="color: #888;">N/A</span>
                            @endif
                        </td>
                        <td class="cell-wrap" style="max-width: 300px;">
                            @if($usage->products->count() > 0)
                                @foreach($usage->products as $product)
                                    <span class="status-badge status-success" style="font-size: 9px; min-width: auto; margin: 2px;">{{ $product->name }}</span>
                                @endforeach
                            @else
                                <span class="status-badge status-warning" style="font-size: 9px; min-width: auto;">-</span>
                            @endif
                        </td>
                        <td class="text-nowrap">{{ $usage->used_at ? $usage->used_at->format('M d, Y h:i A') : 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 30px; text-align: center; color: #888;">
                            No coupon usages recorded yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 20px 30px; border-top: 1px solid rgba(194, 24, 91, 0.05); display: flex; justify-content: space-between; align-items: center;">
        <div style="color: var(--text-muted); font-size: 14px;">
            Showing {{ $usages->firstItem() }} to {{ $usages->lastItem() }} of {{ $usages->total() }} entries
        </div>
        <div>
            {{ $usages->links('pagination.admin') }}
        </div>
    </div>
</div>
@endsection
