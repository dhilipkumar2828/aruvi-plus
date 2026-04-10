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
        
        <div style="background: #fff; padding: 25px; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); border: 1px solid #f1f5f9; margin-bottom: 30px;">
            <div class="admin-form-grid" style="margin-bottom: 25px;">
                <div class="admin-form-group">
                    <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px;">ORDER ID</label>
                    <input type="text" value="#{{ $order->order_number }}" readonly class="admin-input" style="background: #fafafa; border-radius: 8px; height: 42px; font-size: 13px;">
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px;">CUSTOMER NAME</label>
                    <input type="text" value="{{ $order->customer_name }}" readonly class="admin-input" style="background: #fafafa; border-radius: 8px; height: 42px; font-size: 13px;">
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px;">CUSTOMER EMAIL</label>
                    <input type="text" value="{{ $order->customer_email }}" readonly class="admin-input" style="background: #fafafa; border-radius: 8px; height: 42px; font-size: 13px;">
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px;">PHONE NUMBER</label>
                    <input type="text" value="{{ $order->phone ?? 'N/A' }}" readonly class="admin-input" style="background: #fafafa; border-radius: 8px; height: 42px; font-size: 13px;">
                </div>
            </div>

            <div class="admin-form-group" style="margin-bottom: 25px;">
                <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px;">SHIPPING ADDRESS</label>
                <input type="text" value="{{ $order->address_line1 }}{{ $order->address_line2 ? ', ' . $order->address_line2 : '' }}, {{ $order->city }}, {{ $order->state }} - {{ $order->postal_code }}, {{ $order->country }}" readonly class="admin-input" style="background: #fafafa; border-radius: 8px; height: 42px; font-size: 13px;">
            </div>

            <div style="margin-bottom: 0;">
                <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px;">ORDER ITEMS</label>
                <div class="table-responsive" style="border-radius: 12px; overflow: hidden; border: 1px solid #eee;">
                    <table class="admin-table" style="margin: 0;">
                        <thead style="background: #063a17;">
                            <tr>
                                <th style="color: #fff; font-size: 10px; padding: 15px; border: none;">ITEM</th>
                                <th style="color: #fff; font-size: 10px; text-align: center; padding: 15px; border: none;">UNIT PRICE</th>
                                <th style="color: #fff; font-size: 10px; text-align: center; padding: 15px; border: none;">QTY</th>
                                <th style="color: #fff; font-size: 10px; text-align: center; padding: 15px; border: none;">TOTAL AMOUNT</th>
                                <th style="color: #fff; font-size: 10px; text-align: center; padding: 15px; border: none;">DISCOUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="font-size: 13px; font-weight: 600; padding: 15px; color: #475569;">{{ $item->product_name }}</td>
                                <td style="font-size: 13px; text-align: center; padding: 15px; color: #475569;">{{ format_inr($item->unit_price) }}</td>
                                <td style="font-size: 13px; text-align: center; font-weight: 700; padding: 15px; color: #475569;">{{ $item->quantity }}</td>
                                <td style="font-size: 13px; text-align: center; font-weight: 700; padding: 15px; color: #475569;">{{ format_inr($item->line_total) }}</td>
                                <td style="font-size: 13px; text-align: center; padding: 15px; color: #475569;">{{ $item->line_discount > 0 ? format_inr($item->line_discount) : 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div style="background: #fff; padding: 25px; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); border: 1px solid #f1f5f9;">
            <!-- Pricing Summary Section -->
            <div class="admin-form-grid" style="margin-bottom: 15px;">
                <div class="admin-form-group">
                    <div class="admin-input" style="display: flex; justify-content: space-between; align-items: center; background: #fafafa; height: 42px; border-radius: 8px; border: 1px solid #eee;">
                        <span style="color: #64748b; font-size: 13px;">Product Cost</span>
                        <strong style="color: #1a1a1a; font-size: 14px;">{{ format_inr($order->amount - ($order->shipping_amount - $order->shipping_discount)) }}</strong>
                    </div>
                </div>
                <div class="admin-form-group">
                    <div class="admin-input" style="display: flex; justify-content: space-between; align-items: center; background: #fafafa; height: 42px; border-radius: 8px; border: 1px solid #eee;">
                        <span style="color: #64748b; font-size: 13px;">Shipping Charges</span>
                        <strong style="color: #1a1a1a; font-size: 14px;">{{ format_inr($order->shipping_amount - $order->shipping_discount) }}</strong>
                    </div>
                </div>
            </div>

            <div style="background: #fff5f8; border: 1px solid #ffdeeb; border-radius: 10px; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <span style="color: #c2185b; font-weight: 800; font-size: 13px; text-transform: uppercase;">Total (Inclusive of GST)</span>
                <strong style="color: #c2185b; font-size: 20px; font-weight: 800;">{{ format_inr($order->amount - ($order->shipping_amount - $order->shipping_discount)) }}</strong>
            </div>

            <div class="admin-form-grid" style="margin-bottom: 15px;">
                <div class="admin-form-group">
                    <div class="admin-input" style="display: flex; justify-content: space-between; align-items: center; background: #fafafa; height: 42px; border-radius: 8px; border: 1px solid #eee;">
                        <span style="color: #64748b; font-size: 13px;">Taxable Value</span>
                        <strong style="color: #1a1a1a; font-size: 14px;">{{ format_inr($order->taxable_value ?: (($order->amount - ($order->shipping_amount - $order->shipping_discount)) / 1.18)) }}</strong>
                    </div>
                </div>
                <div class="admin-form-group">
                    <div class="admin-input" style="display: flex; justify-content: space-between; align-items: center; background: #fafafa; height: 42px; border-radius: 8px; border: 1px solid #eee;">
                        <span style="color: #64748b; font-size: 13px;">GST ({{ number_format($order->gst_rate ?: 18, 0) }}%)</span>
                        <strong style="color: #1a1a1a; font-size: 14px;">{{ format_inr($order->gst_amount ?: (($order->amount - ($order->shipping_amount - $order->shipping_discount)) * 0.18 / 1.18)) }}</strong>
                    </div>
                </div>
            </div>

            <div style="background: #fff5f8; border: 2px solid #ffdeeb; border-radius: 12px; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <span style="color: #1a1a1a; font-weight: 800; font-size: 16px; text-transform: uppercase;">Final Amount</span>
                <strong style="color: #063a17; font-size: 28px; font-weight: 900; letter-spacing: -1px;">{{ format_inr($order->amount) }}</strong>
            </div>

            <!-- Coupon Section -->
            <div class="admin-form-grid" style="margin-bottom: 25px; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="admin-form-group">
                    <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px;">COUPON CODE</label>
                    <input type="text" value="{{ $order->coupon_code ?? 'N/A' }}" readonly class="admin-input" style="background: #fafafa; border-radius: 8px; height: 42px; font-weight: 600; font-size: 13px;">
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px;">DISCOUNT APPLIED</label>
                    <input type="text" value="{{ $order->discount_amount > 0 ? format_inr($order->discount_amount) : 'N/A' }}" readonly class="admin-input" style="background: #fafafa; border-radius: 8px; height: 42px; font-weight: 600; font-size: 13px;">
                </div>
            </div>

            <!-- Status Section -->
            <div class="admin-form-grid" style="margin-bottom: 30px; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="admin-form-group">
                    <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px;">PAYMENT STATUS</label>
                    <select name="payment_status" class="admin-select" style="border-color: #063a17; height: 42px; border-radius: 8px; font-weight: 600; font-size: 14px; padding: 0 10px;">
                        @foreach (['paid' => 'Paid', 'pending' => 'Pending', 'failed' => 'Failed'] as $value => $label)
                            <option value="{{ $value }}" {{ old('payment_status', $order->payment_status) === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px;">ORDER STATUS</label>
                    <select name="status" class="admin-select" style="border-color: #063a17; height: 42px; border-radius: 8px; font-weight: 600; font-size: 14px; padding: 0 10px;">
                        @foreach ([
                            'placed' => 'Order Placed', 
                            'shipped' => 'Shipped', 
                            'out_for_delivery' => 'Out for Delivery', 
                            'delivered' => 'Delivered', 
                            'cancelled' => 'Cancelled'
                        ] as $value => $label)
                            <option value="{{ $value }}" {{ old('status', $order->status) === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Transaction Details Area -->
            <div style="background: #f0f7ff; border-radius: 16px; padding: 20px; margin-bottom: 30px; border: 1px solid #e0f0ff;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px; color: #1e40af;">
                    <i class="fas fa-info-circle"></i>
                    <span style="font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px;">Transaction Details</span>
                </div>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                    <div>
                        <label style="display: block; font-size: 10px; color: #64748b; font-weight: 700; text-transform: uppercase; margin-bottom: 5px; letter-spacing: 0.5px;">Payment Method</label>
                        <strong style="color: #1a1a1a; font-size: 14px; text-transform: uppercase; font-weight: 800;">{{ $order->payment_method ?? 'ONLINE' }}</strong>
                    </div>
                    <div>
                        <label style="display: block; font-size: 10px; color: #64748b; font-weight: 700; text-transform: uppercase; margin-bottom: 5px; letter-spacing: 0.5px;">Transaction ID</label>
                        <strong style="color: #1a1a1a; font-size: 14px; font-weight: 800; word-break: break-all;">{{ $order->transaction_id ?? 'pay_SbhNVjqjRR88G8' }}</strong>
                    </div>
                    <div>
                        <label style="display: block; font-size: 10px; color: #64748b; font-weight: 700; text-transform: uppercase; margin-bottom: 5px; letter-spacing: 0.5px;">Gateway Order ID</label>
                        <strong style="color: #1a1a1a; font-size: 14px; font-weight: 800; word-break: break-all;">{{ $order->gateway_order_id ?? 'order_SbhNK0OAGXN9VYU' }}</strong>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="admin-form-group" style="margin-bottom: 0;">
                <label class="admin-form-label" style="font-size: 11px; font-weight: 900; color: #1a1a1a; letter-spacing: 0.5px; text-transform: uppercase;">ORDER NOTES / INTERNAL REMARKS</label>
                <textarea name="notes" rows="3" class="admin-textarea" placeholder="Add any specific instructions or internal tracking notes..." style="border-radius: 12px; border-color: #e2e8f0; padding: 15px; font-size: 13px; line-height: 1.5;">{{ old('notes', $order->notes) }}</textarea>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 25px; margin-bottom: 40px;">
            <button type="submit" class="admin-btn" style="background: #063a17; color: #fff; border: none; padding: 14px 40px; border-radius: 12px; font-weight: 800; display: flex; align-items: center; gap: 10px; box-shadow: 0 8px 20px rgba(255, 143, 0, 0.2); cursor: pointer; transition: all 0.3s; font-size: 14px;">
                <i class="fas fa-check-circle" style="font-size: 18px;"></i> UPDATE ORDER
            </button>
        </div>
    </form>
</div>
@endsection
