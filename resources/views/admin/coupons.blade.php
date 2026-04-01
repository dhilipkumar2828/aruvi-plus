@extends('layouts.admin')

@section('page_title', 'Coupon Management')

@section('content')
<div class="content-card coupons-management-page" style="overflow: auto">
    <style>
        /* Specific styles for Coupons Page only */
        .coupons-management-page .admin-btn {
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
        
        .coupons-management-page .admin-btn:hover {
            background: #ff6d00 !important;
            color: #fff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(255, 109, 0, 0.2) !important;
        }

        .coupons-management-page .admin-btn-primary {
            background: linear-gradient(135deg, #ff6d00 0%, #ff9100 100%) !important;
            border: none !important;
            color: #fff !important;
        }
        
        .coupons-management-page .header-filter-form {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .coupons-management-page .header-search-wrap {
            width: 220px !important;
        }
    </style>
    <div class="card-header card-header-flex">
        <h3 style="margin: 0;">Coupons</h3>
        <div class="card-header-actions">
            <form id="couponFilterForm" action="{{ route('admin.coupons') }}" method="GET" class="header-filter-form">
                <div class="header-search-wrap" style="position: relative;">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search coupons..." class="header-search-input">
                </div>
                <select name="type" class="select2" data-placeholder="Select Type" onchange="this.form.submit()" style="min-width: 140px;">
                    <option value="">All Types</option>
                    <option value="fixed" {{ request('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="percent" {{ request('type') == 'percent' ? 'selected' : '' }}>Percent</option>
                </select>
                <select name="status" class="select2" data-placeholder="Select Status" onchange="this.form.submit()" style="min-width: 140px;">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @if(count(request()->all()) > 0)
                    <a href="{{ route('admin.coupons') }}" class="admin-btn">CLEAR</a>
                @endif
            </form>
            <a href="{{ route('admin.coupons.create') }}" class="admin-btn admin-btn-primary" style="white-space: nowrap;">
                <i class="fas fa-plus"></i> Add Coupon
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table">

            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Min Order</th>
                    <th>Usage</th>
                    <th>Status</th>
                    <th>Validity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($coupons as $coupon)
                    @php
                        $isActive = $coupon->is_active;
                        $badgeClass = $isActive ? 'status-success' : 'status-danger';
                        $valueLabel = $coupon->type === 'percent'
                            ? rtrim(rtrim(number_format($coupon->value, 2), '0'), '.') . '%'
                            : format_inr($coupon->value);
                        $minLabel = $coupon->minimum_amount ? format_inr($coupon->minimum_amount) : 'N/A';
                        $usageLabel = $coupon->usage_limit ? $coupon->usage_count . ' / ' . $coupon->usage_limit : $coupon->usage_count . ' / Unlimited';
                        $startLabel = $coupon->starts_at ? $coupon->starts_at->format('M d, Y') : null;
                        $endLabel = $coupon->ends_at ? $coupon->ends_at->format('M d, Y') : null;
                        $validityLabel = $startLabel || $endLabel
                            ? trim(($startLabel ?: 'Anytime') . ' - ' . ($endLabel ?: 'No Expiry'))
                            : 'No Expiry';
                    @endphp
                    <tr>
                        <td>{{ ($coupons->currentPage() - 1) * $coupons->perPage() + $loop->iteration }}</td>
                        <td class="cell-wrap">
                            <div style="font-weight: 700;">{{ $coupon->code }}</div>
                            {{-- <div style="font-size: 12px; color: #666;">{{ $coupon->description ?? 'N/A' }}</div> --}}
                        </td>
                        <td>{{ ucfirst($coupon->type) }}</td>
                        <td class="text-nowrap">{{ $valueLabel }}</td>
                        <td class="text-nowrap">{{ $minLabel }}</td>
                        <td class="text-nowrap">{{ $usageLabel }}</td>
                        <td class="text-nowrap"><span class="status-badge {{ $badgeClass }}">{{ $isActive ? 'Active' : 'Inactive' }}</span></td>
                        <td class="text-nowrap">{{ $validityLabel }}</td>
                        <td>
                            <div class="action-flex">
                                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="action-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-btn delete-confirm" type="submit" title="Delete" data-item-name="{{ $coupon->code }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="padding: 30px; text-align: center; color: #888;">
                            @if(request('search') || request('type') || request('status'))
                                No coupons found matching your criteria.
                            @else
                                No coupons yet. Create your first coupon.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 20px 30px; border-top: 1px solid rgba(194, 24, 91, 0.05); display: flex; justify-content: space-between; align-items: center;">
        <div style="color: var(--text-muted); font-size: 14px;">
            Showing {{ $coupons->firstItem() ?? 0 }} to {{ $coupons->lastItem() ?? 0 }} of {{ $coupons->total() }} entries
        </div>
        <div>
            {{ $coupons->links('pagination.admin') }}
        </div>
    </div>
</div>
@endsection
