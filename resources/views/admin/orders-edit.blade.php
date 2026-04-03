@extends('layouts.admin')

@section('page_title', 'Edit Order')

@section('styles')
<style>
    .admin-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 15px;
    }
    @media (max-width: 768px) {
        .admin-summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="content-card">
    <div class="card-header">
        <div>
            <h3>Update Order Lifecycle</h3>
            <p style="margin: 6px 0 0; font-size: 13px; color: var(--text-muted);">Customer and product details are locked. Update status and notes below.</p>
        </div>
        <a href="{{ route('admin.orders') }}" class="admin-btn admin-btn-ghost">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>
    </div>

    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="p-responsive">
        @csrf
        @method('PUT')
        
        <div class="admin-form-grid">
            <!-- Read-only section for reference -->
            <div class="admin-form-group">
                <label class="admin-form-label">Order ID</label>
                <input type="text" value="#{{ $order->order_number }}" readonly class="admin-input">
            </div>
            
            <div class="admin-form-group">
                <label class="admin-form-label">Customer Name</label>
                <input type="text" value="{{ $order->customer_name }}" readonly class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Customer Email</label>
                <input type="email" value="{{ $order->customer_email }}" readonly class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Phone Number</label>
                <input type="text" value="{{ $order->phone ?? 'N/A' }}" readonly class="admin-input">
            </div>

            <div class="admin-form-group" style="grid-column: span 2;">
                <label class="admin-form-label">Shipping Address</label>
                <input type="text" value="{{ $order->address_line1 }}{{ $order->address_line2 ? ', ' . $order->address_line2 : '' }}, {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}, {{ $order->country }}" readonly class="admin-input">
            </div>

            <div class="admin-form-group" style="grid-column: span 2;">
                <label class="admin-form-label">Order Items</label>
                @if ($order->items->count() > 0)
                    <div class="table-responsive" style="border: 1px solid rgba(0, 66, 0, 0.12); border-radius: 14px;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Total Amount</th>
                                    <th>Discount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td class="cell-wrap">{{ $item->product_name }}</td>
                                        <td class="text-nowrap">{{ format_inr($item->unit_price) }}</td>
                                        <td class="text-nowrap">{{ $item->quantity }}</td>
                                        <td class="text-nowrap">{{ format_inr($item->line_total) }}</td>
                                        <td class="text-nowrap">{{ $item->line_discount > 0 ? format_inr($item->line_discount) : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @php
                        $itemsSubtotal = $order->items->sum('line_total');
                        $itemsDiscount = $order->items->sum('line_discount');
                    @endphp
                    <div class="admin-summary-grid" style="grid-template-columns: repeat(2, 1fr); gap: 15px;">
                        <div class="admin-input" style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666;">Items Subtotal</span>
                            <strong>{{ format_inr($itemsSubtotal) }}</strong>
                        </div>
                        <div class="admin-input" style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666;">Coupon Discount</span>
                            <strong style="color: #dc2626;">{{ $order->discount_amount > 0 ? '-' . format_inr($order->discount_amount) : '0' }}</strong>
                        </div>
                        <div class="admin-input" style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666;">Shipping Charges</span>
                            <strong>{{ format_inr($order->shipping_amount) }}</strong>
                        </div>
                        <div class="admin-input" style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #2e7d32;">Shipping Discount</span>
                            <strong style="color: #2e7d32;">{{ $order->shipping_discount > 0 ? '-' . format_inr($order->shipping_discount) : '0' }}</strong>
                        </div>
                        <div class="admin-input" style="display: flex; justify-content: space-between; align-items: center; border-color: rgba(0, 66, 0, 0.4); background: #fffcfd;">
                            <span style="color: #666;">Shipping Amount (Net)</span>
                            <strong style="color: var(--primary-dark);">{{ format_inr($order->shipping_amount - $order->shipping_discount) }}</strong>
                        </div>
                        <div class="admin-input" style="display: flex; justify-content: space-between; align-items: center; border-color: var(--primary); background: #fff9fb;">
                            <span style="color: #666; font-weight: 700;">Total Payable</span>
                            <strong style="color: var(--primary); font-size: 16px;">{{ format_inr($order->amount) }}</strong>
                        </div>
                    </div>
                @else
                    <input type="text" value="{{ $order->product_name }} ({{ $order->quantity }} Units) - {{ format_inr($order->amount) }}" readonly class="admin-input">
                @endif
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Coupon Code</label>
                <input type="text" value="{{ $order->coupon_code ?? 'N/A' }}" readonly class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Discount Applied</label>
                <input type="text" value="{{ $order->discount_amount > 0 ? format_inr($order->discount_amount) : 'N/A' }}" readonly class="admin-input">
            </div>

            <!-- Editable fields -->
            <div class="admin-form-group">
                <label class="admin-form-label">Order Status</label>
                <select name="status" class="admin-select" style="border-color: var(--primary);">
                    @foreach (['processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'] as $value => $label)
                        <option value="{{ $value }}" {{ old('status', $order->status) === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Payment Status</label>
                <select name="payment_status" class="admin-select" style="border-color: var(--primary);">
                    @foreach (['paid' => 'Paid', 'pending' => 'Pending', 'failed' => 'Failed'] as $value => $label)
                        <option value="{{ $value }}" {{ old('payment_status', $order->payment_status) === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group" style="grid-column: span 2;">
                <label class="admin-form-label">Order Notes / Internal Remarks</label>
                <textarea name="notes" rows="4" class="admin-textarea" placeholder="Add any specific instructions or internal tracking notes about this order...">{{ old('notes', $order->notes) }}</textarea>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 20px; padding-top: 30px; border-top: 1px solid rgba(0, 66, 0, 0.1);">
            {{-- <a href="{{ route('admin.orders') }}" class="admin-btn admin-btn-ghost">Discard Changes</a> --}}
            <button type="submit" class="admin-btn admin-btn-primary">
                <i class="fas fa-save"></i> Update Order
            </button>
        </div>
    </form>
</div>
@endsection
