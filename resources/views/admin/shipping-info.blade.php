@extends('layouts.admin')

@section('page_title', 'Update Shipping Info')

@section('content')
<div class="content-card shipping-management-page" style="overflow: auto">
    <style>
        /* Premium Shipping Management Styles */
        .shipping-management-page .admin-table {
            border-collapse: separate !important;
            border-spacing: 0 !important;
            border: 1px solid #e0e0e0 !important;
            border-radius: 12px !important;
            overflow: hidden !important;
        }

        .shipping-management-page .admin-table thead tr {
            background: linear-gradient(135deg, var(--primary) 0%, #ffb200 100%) !important;
        }

        .shipping-management-page .admin-table th {
            color: #fff !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            font-size: 11px !important;
            letter-spacing: 0.5px !important;
            padding: 15px 10px !important;
            border: 1.5px solid #fff !important;
        }

        .shipping-management-page .admin-table tbody tr {
            transition: all 0.2s ease !important;
        }

        /* Zebra Striping & Hover */
        .shipping-management-page .admin-table tbody tr:nth-child(even) {
            background-color: #fafafa !important;
        }

        .shipping-management-page .admin-table tbody tr:hover {
            background-color: #fff8f0 !important;
            transform: scale(1.002);
            box-shadow: inset 0 0 10px rgba(255, 109, 0, 0.05);
        }

        .shipping-management-page .admin-table td {
            padding: 12px 10px !important;
            border-bottom: 1px solid #f0f0f0 !important;
            vertical-align: middle !important;
        }

        .shipping-management-page .admin-input {
            width: 110px !important;
            height: 38px !important;
            border: 1.5px solid #e0e0e0 !important;
            border-radius: 8px !important;
            text-align: center !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #444 !important;
            background: #fff !important;
            transition: all 0.3s ease !important;
            margin: 0 auto !important;
            display: block !important;
        }

        .shipping-management-page .admin-input:hover {
            border-color: #ffb200 !important;
        }

        .shipping-management-page .admin-input:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 4px rgba(255, 109, 0, 0.15) !important;
            outline: none !important;
            transform: translateY(-1px);
        }

        /* Labels and Groupings */
        .shipping-group-label {
            display: block;
            margin-bottom: 5px;
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
            font-weight: 700;
        }

        .shipping-management-page .admin-btn {
            height: 42px !important;
            border-radius: 50px !important;
            padding: 0 25px !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            background: #fff !important;
            color: var(--primary) !important;
            border: 1.5px solid var(--primary) !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 4px 12px rgba(255, 109, 0, 0.1) !important;
            transition: all 0.3s ease !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            cursor: pointer !important;
        }

        .shipping-management-page .admin-btn:hover {
            background: var(--primary) !important;
            color: #fff !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 15px rgba(255, 109, 0, 0.2) !important;
        }

        .shipping-management-page .admin-btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary) 100%) !important;
            border: none !important;
            color: #fff !important;
        }
    </style>
    <div class="card-header card-header-flex" style="padding: 25px 30px;">
        <div>
            <h3 style="margin: 0; color: #333; font-weight: 800;">Shipping Rate Management</h3>
            <p style="margin: 5px 0 0; font-size: 13px; color: #888;">Configure shipping charges and discounts based on order amounts.</p>
        </div>
        <div class="card-header-actions">
            <a href="{{ route('admin.dashboard') }}" class="admin-btn">
                <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Dashboard
            </a>
        </div>
    </div>

    <form action="{{ route('admin.shipping_info.update') }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="admin-table" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 50px; text-align: center; vertical-align: middle; color: #fff;">S.No</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle; color: #fff;">From Amount</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle; color: #fff;">To Amount</th>
                        <th style="text-align: center; color: #fff;">TamilNadu</th>
                        <th style="text-align: center; color: #fff;">Other States</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; color: #fff; font-size: 11px;">Shipping Charges</th>
                        <th style="text-align: center; color: #fff; font-size: 11px;">Shipping Charges</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipping_infos as $info)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td style="text-align: center;">
                                <input type="number" step="0.01" min="0" name="shipping[{{ $info->id }}][from_amount]" value="{{ $info->from_amount + 0 }}" class="admin-input" placeholder="From Amount">
                            </td>
                            <td style="text-align: center;">
                                <input type="number" step="0.01" min="0" name="shipping[{{ $info->id }}][to_amount]" value="{{ $info->to_amount + 0 }}" class="admin-input" placeholder="To Amount">
                            </td>
                            <td style="text-align: center;">
                                <input type="number" step="0.01" min="0" name="shipping[{{ $info->id }}][shipping_charges_tn_py]" value="{{ $info->shipping_charges_tn_py + 0 }}" class="admin-input" placeholder="Charges">
                            </td>
                            <td style="text-align: center;">
                                <input type="number" step="0.01" min="0" name="shipping[{{ $info->id }}][shipping_charges_other]" value="{{ $info->shipping_charges_other + 0 }}" class="admin-input" placeholder="Charges">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="padding: 30px; border-top: 1px solid rgba(0, 66, 0, 0.05); text-align: right;">
            <button type="submit" class="admin-btn admin-btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
