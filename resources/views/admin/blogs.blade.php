@extends('layouts.admin')

@section('page_title', 'Blogs Management')

@section('content')
<div class="content-card blogs-management-page" style="overflow: auto">
    <style>
        /* Specific styles for Blog Page only */
        .blogs-management-page .admin-btn {
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
        
        .blogs-management-page .admin-btn:hover {
            background: #ff6d00 !important;
            color: #fff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(255, 109, 0, 0.2) !important;
        }

        .blogs-management-page .admin-btn-primary {
            background: linear-gradient(135deg, #ff6d00 0%, #ff9100 100%) !important;
            border: none !important;
            color: #fff !important;
        }
        
        .blogs-management-page .header-filter-form {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .blogs-management-page .header-search-wrap {
            width: 220px !important;
        }
    </style>
    <div class="card-header card-header-flex">
        <h3 style="margin: 0;">Blog Posts</h3>
        <div class="card-header-actions">
            <form id="blogFilterForm" action="{{ route('admin.blogs') }}" method="GET" class="header-filter-form">
                <div class="header-search-wrap" style="position: relative;">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search blogs..." class="header-search-input">
                </div>
                <select name="status" class="select2" data-placeholder="Select Status" onchange="this.form.submit()" style="min-width: 140px;">
                    <option value="">All Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                @if(count(request()->all()) > 0)
                    <a href="{{ route('admin.blogs') }}" class="admin-btn">CLEAR</a>
                @endif
            </form>
            <a href="{{ route('admin.blogs.create') }}" class="admin-btn admin-btn-primary" style="white-space: nowrap;">
                <i class="fas fa-plus"></i> Add Blog
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table">


            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Excerpt</th>
                    <th>Status</th>
                    <th>Published Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr>
                        <td>{{ ($blogs->currentPage() - 1) * $blogs->perPage() + $loop->iteration }}</td>
                        <td>
                            <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden; background: var(--glass); display: flex; align-items: center; justify-content: center; color: var(--primary);">
                                @if($blog->image)
                                    <img src="{{ asset($blog->image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="fas fa-image"></i>
                                @endif
                            </div>
                        </td>
                        <td class="text-nowrap" style="max-width: 250px; overflow: hidden; text-overflow: ellipsis;">{{ $blog->title }}</td>
                        <td>{{ $blog->author }}</td>
                        <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Str::limit($blog->excerpt, 50) }}</td>
                        <td>
                            @if ($blog->is_published)
                                <span class="status-badge status-success">Published</span>
                            @else
                                <span class="status-badge status-warning">Draft</span>
                            @endif
                        </td>
                        <td>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : '-' }}</td>
                        <td>
                            <div class="action-flex">
                                <a href="{{ route('admin.blogs.edit', $blog) }}" class="action-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-btn delete-confirm" type="submit" title="Delete" data-item-name="{{ $blog->title }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="padding: 30px; text-align: center; color: #888;">
                            @if(request('search') || request('status'))
                                No blogs found matching your criteria.
                            @else
                                No blogs found. Create your first blog post.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 20px 30px; border-top: 1px solid rgba(194, 24, 91, 0.05); display: flex; justify-content: space-between; align-items: center;">
        <div style="color: var(--text-muted); font-size: 14px;">
            Showing {{ $blogs->firstItem() ?? 0 }} to {{ $blogs->lastItem() ?? 0 }} of {{ $blogs->total() }} entries
        </div>
        <div>
            {{ $blogs->links('pagination.admin') }}
        </div>
    </div>
</div>
@endsection
