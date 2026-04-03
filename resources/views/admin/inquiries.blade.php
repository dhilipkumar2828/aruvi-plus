@extends('layouts.admin')

@section('page_title', 'Customer Inquiries Management')

@section('content')
<div class="content-card inquiries-management-page" style="overflow: auto">
    <style>
        /* Specific styles for Inquiries Page only */
        .inquiries-management-page .admin-btn {
            height: 42px !important;
            border-radius: 50px !important;
            padding: 0 25px !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            background: #fff !important;
            color: var(--primary) !important;
            border: 1px solid var(--primary) !important;
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
        
        .inquiries-management-page .admin-btn:hover {
            background: var(--primary) !important;
            color: #fff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(255, 109, 0, 0.2) !important;
        }

        .inquiries-management-page .header-filter-form {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .inquiries-management-page .header-search-wrap {
            width: 220px !important;
        }
    </style>
    <div class="card-header card-header-flex">
        <h3 style="margin: 0;">Customer Inquiries</h3>
        <div class="card-header-actions">
            <form id="inquiryFilterForm" action="{{ route('admin.inquiries') }}" method="GET" class="header-filter-form">
                <div class="header-search-wrap" style="position: relative;">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search inquiries..." class="header-search-input" id="inquirySearchInput">
                </div>
                
                <select name="status" class="select2" data-placeholder="Select Status" onchange="this.form.submit()" style="min-width: 140px;">
                    <option value="">All Status</option>
                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                    <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied</option>
                </select>

                @if(count(request()->all()) > 0)
                    <a href="{{ route('admin.inquiries') }}" class="admin-btn">CLEAR</a>
                @endif
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table inquiries-table">

            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
        <tbody>
            @forelse ($inquiries as $inquiry)
                @php
                    $status = strtolower($inquiry->status);
                    $badgeClass = 'status-warning';
                    if ($status === 'replied') {
                        $badgeClass = 'status-success';
                    } elseif ($status === 'closed') {
                        $badgeClass = 'status-danger';
                    }
                @endphp
                <tr>
                    <td>{{ ($inquiries->currentPage() - 1) * $inquiries->perPage() + $loop->iteration }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ $inquiry->name }}</div>
                        <div style="font-size: 12px; color: #666;">{{ $inquiry->email }}</div>
                    </td>
                    <td class="text-nowrap">{{ $inquiry->phone ?? 'N/A' }}</td>
                    <td class="text-nowrap">{{ $inquiry->subject ?? 'General' }}</td>
                    <td class="cell-wrap">{{ $inquiry->message }}</td>
                    <td class="text-nowrap"><span class="status-badge {{ $badgeClass }}">{{ ucfirst($inquiry->status) }}</span></td>
                    <td class="text-nowrap">{{ optional($inquiry->created_at)->format('M d, Y') }}</td>
                    <td>
                        <div class="action-flex">
                            <a href="{{ route('admin.inquiries.edit', $inquiry) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="action-btn delete-confirm" type="submit" title="Delete" data-item-name="{{ $inquiry->name }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #888; padding: 30px;">
                        @if(request('search') || request('status'))
                            No inquiries found matching your criteria.
                        @else
                            No inquiries yet.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>

    <div style="padding: 20px 30px; border-top: 1px solid rgba(0, 66, 0, 0.05); display: flex; justify-content: space-between; align-items: center;">
        <div style="color: var(--text-muted); font-size: 14px;">
            Showing {{ $inquiries->firstItem() ?? 0 }} to {{ $inquiries->lastItem() ?? 0 }} of {{ $inquiries->total() }} entries
        </div>
        <div>
            {{ $inquiries->links('pagination.admin') }}
        </div>
    </div>
</div>
@endsection
