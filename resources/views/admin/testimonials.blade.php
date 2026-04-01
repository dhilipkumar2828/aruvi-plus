@extends('layouts.admin')

@section('page_title', 'Testimonials Management')

@section('content')
<div class="content-card testimonials-management-page" style="overflow: auto">
    <style>
        /* Specific styles for Testimonial Page only */
        .testimonials-management-page .admin-btn {
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
        
        .testimonials-management-page .admin-btn:hover {
            background: #ff6d00 !important;
            color: #fff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(255, 109, 0, 0.2) !important;
        }

        .testimonials-management-page .admin-btn-primary {
            background: linear-gradient(135deg, #ff6d00 0%, #ff9100 100%) !important;
            border: none !important;
            color: #fff !important;
        }
        
        .testimonials-management-page .header-filter-form {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .testimonials-management-page .header-search-wrap {
            width: 220px !important;
        }
    </style>
    <div class="card-header card-header-flex">
        <h3 style="margin: 0;">Client Testimonials</h3>
        <div class="card-header-actions">
            <form id="testimonialFilterForm" action="{{ route('admin.testimonials') }}" method="GET" class="header-filter-form">
                <div class="header-search-wrap" style="position: relative;">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search testimonials..." class="header-search-input">
                </div>
                @if(count(request()->all()) > 0)
                    <a href="{{ route('admin.testimonials') }}" class="admin-btn">CLEAR</a>
                @endif
            </form>
            <a href="{{ route('admin.testimonials.create') }}" class="admin-btn admin-btn-primary" style="white-space: nowrap;">
                <i class="fas fa-plus"></i> Add Testimonial
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Rating</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($testimonials as $testimonial)
                    <tr>
                        <td>{{ ($testimonials->currentPage() - 1) * $testimonials->perPage() + $loop->iteration }}</td>
                        <td>
                            <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden; background: var(--glass); display: flex; align-items: center; justify-content: center; color: var(--primary);">
                                @if($testimonial->image)
                                    <img src="{{ asset($testimonial->image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="fas fa-image"></i>
                                @endif
                            </div>
                        </td>
                        <td class="text-nowrap">{{ $testimonial->name }}</td>
                        <td>{{ $testimonial->designation }}</td>
                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star" style="color: {{ $i <= $testimonial->rating ? '#ff9100' : '#ddd' }}; font-size: 10px;"></i>
                            @endfor
                        </td>
                        <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Str::limit($testimonial->content, 50) }}</td>
                        <td>
                            @if ($testimonial->is_active)
                                <span class="status-badge status-success">Active</span>
                            @else
                                <span class="status-badge status-warning">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-flex">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="action-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-btn delete-confirm" type="submit" title="Delete" data-item-name="{{ $testimonial->name }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="padding: 30px; text-align: center; color: #888;">
                            @if(request('search'))
                                No testimonials found matching your search.
                            @else
                                No testimonials found. Create your first testimonial.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 20px 30px; border-top: 1px solid rgba(194, 24, 91, 0.05); display: flex; justify-content: space-between; align-items: center;">
        <div style="color: var(--text-muted); font-size: 14px;">
            Showing {{ $testimonials->firstItem() ?? 0 }} to {{ $testimonials->lastItem() ?? 0 }} of {{ $testimonials->total() }} entries
        </div>
        <div>
            {{ $testimonials->links('pagination.admin') }}
        </div>
    </div>
</div>
@endsection
