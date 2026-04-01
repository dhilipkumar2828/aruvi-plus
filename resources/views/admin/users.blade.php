@extends('layouts.admin')

@section('page_title', 'Users Management')

@section('content')
<div class="content-card" style="overflow: auto">
    <div class="card-header" style="flex-wrap: wrap; gap: 20px;">
        <h3>User List</h3>
        <div style="display: flex; gap: 15px; align-items: center; width: 100%; max-width: 250px;">
            <form action="{{ route('admin.users') }}" method="GET" style="display: flex; gap: 10px; align-items: center; width: 100%;">
                <div style="position: relative; flex: 1;">
                    <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #888; font-size: 13px;"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." style="padding: 8px 15px 8px 38px; border-radius: 50px; border: 1px solid #ddd; outline: none; background: #fff; width: 100%; font-size: 13px;">
                </div>
                @if(request('search'))
                    <a href="{{ route('admin.users') }}" class="admin-btn" style="background: #fff; color: #ff6d00; border: 1px solid #ff6d00; padding: 6px 18px; font-weight: 800; text-transform: uppercase; font-size: 11px; height: auto; display: inline-flex; align-items: center; letter-spacing: 0.5px; box-shadow: 0 2px 6px rgba(255, 109, 0, 0.1);">CLEAR</a>
                @endif
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="admin-table">

        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Role</th>
                <th>Joined Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                    <td class="text-nowrap" style="font-weight: 600;">{{ $user->name }}</td>
                    <td class="text-nowrap">{{ $user->email }}</td>
                    <td class="text-nowrap">{{ $user->phone ?? '-' }}</td>
                    <td>
                        <span class="status-badge status-warning">{{ ucfirst($user->role ?? 'Customer') }}</span>
                    </td>
                    <td>{{ optional($user->created_at)->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #888; padding: 30px;">
                        @if(request('search'))
                            No users found matching your search.
                        @else
                            No users yet.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>

    <div style="padding: 20px 30px; border-top: 1px solid rgba(194, 24, 91, 0.05); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div style="color: var(--text-muted); font-size: 14px; white-space: nowrap;">
            Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} entries
        </div>
        <div>
            {{ $users->links('pagination.admin') }}
        </div>
    </div>
</div>
@endsection
