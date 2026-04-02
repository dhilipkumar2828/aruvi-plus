@extends('layouts.admin')

@section('page_title', 'Category Management')

@section('content')
<div class="content-card categories-management-page" style="overflow: auto">
    <style>
        /* Specific styles for Categories Page only */
        .categories-management-page .admin-btn {
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
        
        .categories-management-page .admin-btn:hover {
            background: var(--primary) !important;
            color: #fff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(255, 109, 0, 0.2) !important;
        }

        .categories-management-page .admin-btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary) 100%) !important;
            border: none !important;
            color: #fff !important;
        }
        
        .categories-management-page .header-filter-form {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .categories-management-page .header-search-wrap {
            width: 220px !important;
        }
    </style>
    <div class="card-header card-header-flex">
        <h3 style="margin: 0;">All Categories</h3>
        <div class="card-header-actions">
            <form id="categoryFilterForm" action="{{ route('admin.categories') }}" method="GET" class="header-filter-form">
                <div class="header-search-wrap" style="position: relative;">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories..." class="header-search-input" id="categorySearchInput">
                </div>
                <select name="status" class="select2" data-placeholder="Select Status" onchange="this.form.submit()" style="min-width: 150px;">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @if(count(request()->all()) > 0)
                    <a href="{{ route('admin.categories') }}" class="admin-btn">CLEAR</a>
                @endif
            </form>
            <a href="{{ route('admin.categories.create') }}" class="admin-btn admin-btn-primary" style="white-space: nowrap;">
                <i class="fas fa-plus"></i> Add New Category
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table">

            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                        <td>
                            <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden; background: var(--glass); display: flex; align-items: center; justify-content: center; color: var(--primary);">
                                @if($category->image)
                                    @if(Str::startsWith($category->image, 'uploads/'))
                                        <img src="{{ asset($category->image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <img src="{{ Storage::url($category->image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                @else
                                    <i class="fas fa-folder-open"></i>
                                @endif
                            </div>
                        </td>
                        <td class="text-nowrap">
                            <div style="font-weight: 600;">{{ $category->name }}</div>
                        </td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @if ($category->status === 'active')
                                <span class="status-badge status-success">Active</span>
                            @else
                                <span class="status-badge status-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-flex">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="action-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-btn delete-confirm" type="submit" title="Delete" data-item-name="{{ $category->name }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 30px; text-align: center; color: #888;">
                            @if(request('status') || request('search'))
                                @if(request('status') == 'inactive')
                                    No inactive categories found.
                                @elseif(request('status') == 'active')
                                    No active categories found.
                                @elseif(request('search'))
                                    No categories found for "{{ request('search') }}".
                                @else
                                    No categories found matching your search.
                                @endif
                            @else
                                No categories yet. Create your first category.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 20px 30px; border-top: 1px solid rgba(0, 66, 0, 0.05); display: flex; justify-content: space-between; align-items: center;">
        <div style="color: var(--text-muted); font-size: 14px;">
            Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} entries
        </div>
        <div>
            {{ $categories->links('pagination.admin') }}
        </div>
    </div>
</div>
@endsection
