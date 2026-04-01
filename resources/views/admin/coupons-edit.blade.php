@extends('layouts.admin')

@section('page_title', 'Coupon Management')

@section('content')
<div class="content-card">
    <div class="card-header">
        <div>
            <h3>Edit Coupon</h3>
            <p style="margin: 6px 0 0; font-size: 13px; color: var(--text-muted);">Update coupon details and availability.</p>
        </div>
        <a href="{{ route('admin.coupons') }}" class="admin-btn admin-btn-ghost">
            <i class="fas fa-arrow-left"></i> Back to Coupons
        </a>
    </div>

    @if ($errors->any())
        <div style="padding: 15px 30px; border-bottom: 1px solid var(--glass-border); color: #d9534f; font-size: 14px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST" style="padding: 40px;">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px;">
            <div class="admin-form-group" style="grid-column: span 2;">
                <label class="admin-form-label">Applicable Products (Optional)</label>
                <p style="font-size: 12px; color: #888; margin-bottom: 10px;">Select products this coupon should apply to. If none selected, it applies to the entire cart.</p>
                <select name="product_ids[]" class="admin-select select2-multiple" multiple="multiple" style="width: 100%;">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ in_array($product->id, old('product_ids', $selectedProducts)) ? 'selected' : '' }}>
                            {{ $product->name }} (SKU: {{ $product->sku }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Coupon Code</label>
                <input type="text" name="code" value="{{ old('code', $coupon->code) }}" required class="admin-input" style="text-transform: uppercase;">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Description (Optional)</label>
                <input type="text" name="description" value="{{ old('description', $coupon->description) }}" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Discount Type</label>
                <select name="type" class="admin-select" required>
                    <option value="percent" {{ old('type', $coupon->type) === 'percent' ? 'selected' : '' }}>Percentage</option>
                    <option value="fixed" {{ old('type', $coupon->type) === 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Discount Value</label>
                <input type="number" name="value" value="{{ old('value', $coupon->value) }}" step="0.01" min="0" required class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Minimum Order Amount</label>
                <input type="number" name="minimum_amount" value="{{ old('minimum_amount', $coupon->minimum_amount) }}" step="0.01" min="0" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Maximum Discount Cap</label>
                <input type="number" name="maximum_discount" value="{{ old('maximum_discount', $coupon->maximum_discount) }}" step="0.01" min="0" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Starts On</label>
                <input type="date" name="starts_at" value="{{ old('starts_at', optional($coupon->starts_at)->format('Y-m-d')) }}" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Ends On</label>
                <input type="date" name="ends_at" value="{{ old('ends_at', optional($coupon->ends_at)->format('Y-m-d')) }}" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Usage Limit</label>
                <input type="number" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}" min="1" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Status</label>
                <select name="is_active" class="admin-select">
                    <option value="1" {{ old('is_active', $coupon->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $coupon->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 20px; padding-top: 30px; border-top: 1px solid rgba(194, 24, 91, 0.1);">
            {{-- <a href="{{ route('admin.coupons') }}" class="admin-btn admin-btn-ghost">Cancel</a> --}}
            <button type="submit" class="admin-btn admin-btn-primary">
                <i class="fas fa-save"></i> Update Coupon
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<style>
    .select2-container--default .select2-selection--multiple {
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        padding: 6px 12px;
        min-height: 48px;
        background: #fff;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(255, 152, 0, 0.1);
        outline: none;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: var(--icon-gradient) !important;
        border: none !important;
        color: white !important;
        border-radius: 8px !important;
        margin: 4px !important;
        display: inline-flex !important;
        align-items: center !important;
        padding: 0 !important;
        height: 32px !important;
        overflow: hidden !important;
        box-shadow: 0 3px 8px rgba(255, 152, 0, 0.2);
        position: relative !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        position: static !important;
        color: rgba(255, 255, 255, 0.9) !important;
        border: none !important;
        background: rgba(255, 255, 255, 0.15) !important;
        font-weight: bold !important;
        font-size: 18px !important;
        cursor: pointer !important;
        padding: 0 !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 32px !important;
        height: 32px !important;
        transition: all 0.2s !important;
        border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        padding: 0 12px 0 10px !important;
        display: flex !important;
        align-items: center !important;
        height: 100% !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        margin: 0 !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        background: rgba(255, 255, 255, 0.3) !important;
        color: #fff !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__clear {
        margin-top: 10px;
        margin-right: 10px;
        font-size: 18px;
    }
    .select2-dropdown {
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.1);
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-top: 5px;
    }
    .select2-results__option {
        padding: 10px 15px;
        font-size: 14px;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background: var(--icon-gradient) !important;
    }
    /* Fix alignment of typing text */
    .select2-container--default .select2-selection--multiple .select2-search--inline {
        margin-top: 5px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-search--inline .select2-search__field {
        margin-top: 0 !important;
        margin-left: 10px !important;
        height: 32px !important;
        line-height: 32px !important;
        vertical-align: middle !important;
        font-family: inherit !important;
        font-size: 14px !important;
    }
</style>
<script>
    $(document).ready(function() {
        $('.select2-multiple').select2({
            placeholder: "Search and select products...",
            allowClear: true
        });
    });
</script>
@endsection
