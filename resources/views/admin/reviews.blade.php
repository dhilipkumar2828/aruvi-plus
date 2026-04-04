@extends('layouts.admin')

@section('page_title', 'Product Reviews Management')

@section('content')
<div class="content-card reviews-management-page" style="overflow: auto">
    <style>
        .reviews-management-page .admin-btn {
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
            box-shadow: 0 2px 8px rgba(0, 66, 0, 0.08) !important;
            transition: all 0.3s ease !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            cursor: pointer !important;
            text-decoration: none !important;
        }
        
        .reviews-management-page .admin-btn:hover {
            background: var(--primary) !important;
            color: #fff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(0, 66, 0, 0.15) !important;
        }

        .reviews-management-page .admin-btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary) 100%) !important;
            border: none !important;
            color: #fff !important;
        }

        .reviews-management-page .admin-btn-success {
            background: #28a745 !important;
            border-color: #28a745 !important;
            color: #fff !important;
        }
        
        .reviews-management-page .header-filter-form {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .reviews-management-page .header-search-wrap {
            width: 250px !important;
        }
    </style>
    <div class="card-header card-header-flex">
        <h3 style="margin: 0;">Product Reviews</h3>
        <div class="card-header-actions">
            <form id="reviewFilterForm" action="{{ route('admin.reviews') }}" method="GET" class="header-filter-form">
                <select name="status" class="header-filter-select" onchange="this.form.submit()" style="height: 42px; border-radius: 50px; border: 1px solid #eee; padding: 0 15px; font-size: 13px; color: #555;">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Approval</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                </select>
                <div class="header-search-wrap" style="position: relative;">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search reviews/products..." class="header-search-input">
                </div>
                @if(count(request()->all()) > 0)
                    <a href="{{ route('admin.reviews') }}" class="admin-btn">CLEAR</a>
                @endif
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Product</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                    <tr>
                        <td>{{ ($reviews->currentPage() - 1) * $reviews->perPage() + $loop->iteration }}</td>
                        <td class="text-nowrap">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; border-radius: 4px; overflow: hidden; background: #f5f5f5;">
                                    @if($review->product->primary_image)
                                        <img src="{{ asset($review->product->primary_image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #ccc;"><i class="fas fa-box" style="font-size: 12px;"></i></div>
                                    @endif
                                </div>
                                <span style="font-weight: 600; font-size: 13px;">{{ $review->product->name }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="line-height: 1.2;">
                                <div style="font-weight: 600; font-size: 13px;">{{ $review->name }}</div>
                                <div style="font-size: 11px; color: #888;">{{ $review->email }}</div>
                            </div>
                        </td>
                        <td>
                            <div style="color: #ffc107; font-size: 12px; white-space: nowrap;">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star" style="color: {{ $i <= $review->rating ? '#ffc107' : '#ddd' }};"></i>
                                @endfor
                            </div>
                        </td>
                        <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $review->comment }}">
                            {{ Str::limit($review->comment, 60) }}
                        </td>
                        <td style="font-size: 12px; color: #666;">
                            {{ $review->created_at->format('d M, Y') }}<br>
                            <span style="font-size: 10px; opacity: 0.7;">{{ $review->created_at->diffForHumans() }}</span>
                        </td>
                        <td>
                            @if ($review->is_approved)
                                <span class="status-badge" style="background: #e8f5e9; color: #2e7d32; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;">Approved</span>
                            @else
                                <span class="status-badge" style="background: #fff3e0; color: #ef6c00; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-flex" style="gap: 8px;">
                                @if (!$review->is_approved)
                                    <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button class="action-btn" type="submit" title="Approve" style="color: #28a745; border-color: #28a745;">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-btn delete-confirm" type="submit" title="Delete" data-item-name="Review by {{ $review->name }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="padding: 40px; text-align: center; color: #888;">
                            @if(request('search') || request('status'))
                                No reviews found matching your filters.
                            @else
                                No product reviews have been submitted yet.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 20px 30px; border-top: 1px solid rgba(0, 66, 0, 0.05); display: flex; justify-content: space-between; align-items: center;">
        <div style="color: var(--text-muted); font-size: 14px;">
            Showing {{ $reviews->firstItem() ?? 0 }} to {{ $reviews->lastItem() ?? 0 }} of {{ $reviews->total() }} entries
        </div>
        <div>
            @if($reviews->hasPages())
                {{ $reviews->links('pagination.admin') }}
            @endif
        </div>
    </div>
</div>
@endsection
