@extends('layouts.admin')

@section('page_title', 'Transaction Report')

@section('content')
<div class="container-fluid">
    <!-- Stats Section -->
    <div class="admin-form-grid" style="grid-template-columns: repeat(2, 1fr); gap: 30px; margin-bottom: 30px;">
        <div style="background: #fff; padding: 30px; border-radius: 20px; box-shadow: var(--card-shadow-soft); border: 1px solid #f1f5f9; text-align: center;">
            <p style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">TOTAL ORDERS</p>
            <h2 style="font-size: 42px; font-weight: 900; color: var(--primary); margin: 0;">{{ $totalOrders }}</h2>
        </div>
        <div style="background: #fff; padding: 30px; border-radius: 20px; box-shadow: var(--card-shadow-soft); border: 1px solid #f1f5f9; text-align: center;">
            <p style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">TOTAL REVENUE (PAID)</p>
            <h2 style="font-size: 42px; font-weight: 900; color: #063a17; margin: 0;">{{ format_inr($totalRevenue) }}</h2>
        </div>
    </div>

    <!-- Filters Section -->
    <div style="background: #fff; padding: 25px; border-radius: 20px; box-shadow: var(--card-shadow-soft); border: 1px solid #f1f5f9; margin-bottom: 30px;">
        <form action="{{ route('admin.reports.transactions') }}" method="GET" class="admin-form-grid" style="grid-template-columns: repeat(5, 1fr); gap: 15px; align-items: flex-end;">
            <div class="admin-form-group" style="margin-bottom: 0;">
                <label class="admin-form-label" style="font-size: 10px; color: #64748b;">Search</label>
                <div style="position: relative;">
                    <i class="fas fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 12px;"></i>
                    <input type="text" name="search" value="{{ request('search') }}" class="admin-input" placeholder="Order ID, Name..." style="height: 42px; padding-left: 40px; border-radius: 10px; font-size: 13px;">
                </div>
            </div>
            <div class="admin-form-group" style="margin-bottom: 0;">
                <label class="admin-form-label" style="font-size: 10px; color: #64748b;">Payment Status</label>
                <select name="payment_status" class="admin-select" style="height: 42px; border-radius: 10px; font-size: 13px; padding: 0 10px;">
                    <option value="all">All Statuses</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div class="admin-form-group" style="margin-bottom: 0;">
                <label class="admin-form-label" style="font-size: 10px; color: #64748b;">Start Date</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="admin-input" style="height: 42px; border-radius: 10px; font-size: 13px;">
            </div>
            <div class="admin-form-group" style="margin-bottom: 0;">
                <label class="admin-form-label" style="font-size: 10px; color: #64748b;">End Date</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="admin-input" style="height: 42px; border-radius: 10px; font-size: 13px;">
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="admin-btn" style="background: var(--primary); color: #fff; border: none; height: 42px; padding: 0 25px; border-radius: 10px; font-weight: 700; font-size: 12px; flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fas fa-filter"></i> FILTER
                </button>
                <a href="{{ route('admin.reports.transactions') }}" class="admin-btn" style="background: #f1f5f9; color: #64748b; border: none; height: 42px; width: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                    <i class="fas fa-undo"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Registry Section -->
    <div style="background: #fff; border-radius: 20px; box-shadow: var(--card-shadow-soft); border: 1px solid #f1f5f9; overflow: hidden;">
        <div style="padding: 20px 25px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 35px; height: 35px; background: var(--luxury-green-soft); color: var(--primary); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-list-ul"></i>
                </div>
                <h3 style="font-size: 16px; font-weight: 800; color: #1a1a1a; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">Statement Registry</h3>
            </div>
            <div style="display: flex; gap: 10px;">
                <form action="{{ route('admin.reports.transactions') }}" method="GET" style="display: inline;">
                    @foreach(request()->except('export') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <button type="submit" name="export" value="csv" class="admin-btn" style="background: #e8f5e9; color: #2e7d32; border: none; padding: 8px 20px; border-radius: 8px; font-weight: 700; font-size: 11px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-file-excel"></i> Export CSV (Excel)
                    </button>
                </form>
                <form action="{{ route('admin.reports.transactions') }}" method="GET" style="display: inline;">
                    @foreach(request()->except('export') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <button type="submit" name="export" value="pdf" class="admin-btn" style="background: #fff1f2; color: #be123c; border: none; padding: 8px 20px; border-radius: 8px; font-weight: 700; font-size: 11px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="admin-table" style="margin: 0;">
                <thead style="background: var(--primary);">
                    <tr>
                        <th style="color: #fff; font-size: 10px; padding: 15px; border: none; white-space: nowrap;">S.NO</th>
                        <th style="color: #fff; font-size: 10px; padding: 15px; border: none; white-space: nowrap;">ORDER #</th>
                        <th style="color: #fff; font-size: 10px; padding: 15px; border: none; white-space: nowrap;">CUSTOMER</th>
                        <th style="color: #fff; font-size: 10px; padding: 15px; border: none; white-space: nowrap;">DATE</th>
                        <th style="color: #fff; font-size: 10px; padding: 15px; border: none; white-space: nowrap;">TAXABLE</th>
                        <th style="color: #fff; font-size: 10px; padding: 15px; border: none; white-space: nowrap;">GST</th>
                        <th style="color: #fff; font-size: 10px; padding: 15px; border: none; white-space: nowrap;">TOTAL AMNT</th>
                        <th style="color: #fff; font-size: 10px; padding: 15px; border: none; white-space: nowrap;">METHOD</th>
                        <th style="color: #fff; font-size: 10px; padding: 15px; border: none; white-space: nowrap;">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $index => $order)
                    @php
                        $taxable = $order->taxable_value ?: (($order->amount - ($order->shipping_amount - $order->shipping_discount)) / 1.18);
                        $gst = $order->gst_amount ?: (($order->amount - ($order->shipping_amount - $order->shipping_discount)) * 0.18 / 1.18);
                    @endphp
                    <tr>
                        <td style="font-size: 12px; font-weight: 700; color: #94a3b8;">{{ ($orders->currentPage()-1) * $orders->perPage() + $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" style="text-decoration: none; color: var(--primary); font-weight: 800; font-size: 12px;">
                                #{{ $order->order_number }}
                            </a>
                        </td>
                        <td style="font-size: 13px; font-weight: 600; color: #475569;">{{ $order->customer_name }}</td>
                        <td style="font-size: 12px; color: #64748b;">{{ $order->created_at->format('d M, Y') }}</td>
                        <td style="font-size: 13px; font-weight: 600;">{{ format_inr($taxable) }}</td>
                        <td style="font-size: 13px; font-weight: 600;">{{ format_inr($gst) }}</td>
                        <td style="font-size: 14px; font-weight: 800;">{{ format_inr($order->amount) }}</td>
                        <td>
                            <span style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">{{ $order->payment_method ?: 'ONLINE' }}</span>
                        </td>
                        <td>
                            @php
                                $statusStyle = match($order->payment_status) {
                                    'paid' => 'background: #e8f5e9; color: #2e7d32;',
                                    'pending' => 'background: #fff7ed; color: #c2410c;',
                                    default => 'background: #fff1f2; color: #be123c;',
                                };
                            @endphp
                            <span style="{{ $statusStyle }} padding: 4px 12px; border-radius: 50px; font-size: 10px; font-weight: 800; text-transform: uppercase;">
                                {{ $order->payment_status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 50px; color: #94a3b8;">
                            <i class="fas fa-folder-open" style="font-size: 40px; margin-bottom: 15px; display: block;"></i>
                            No transactions found matching your criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($orders->count() > 0)
        <div style="padding: 20px 25px; border-top: 1px solid #f1f5f9;">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
