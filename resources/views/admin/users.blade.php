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
                    <a href="{{ route('admin.users') }}" class="admin-btn" style="background: #fff; color: var(--primary); border: 1px solid var(--primary); padding: 6px 18px; font-weight: 800; text-transform: uppercase; font-size: 11px; height: auto; display: inline-flex; align-items: center; letter-spacing: 0.5px; box-shadow: 0 2px 6px rgba(255, 109, 0, 0.1);">CLEAR</a>
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
                <th>Status</th>
                <th>Joined Date</th>
                <th>Action</th>
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
                    <td>
                        <span class="status-badge {{ $user->status === 'active' ? 'status-success' : 'status-danger' }}">
                            {{ ucfirst($user->status ?? 'Active') }}
                        </span>
                    </td>
                    <td>{{ optional($user->created_at)->format('M d, Y') }}</td>
                    <td>
                        <div class="action-flex">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="action-btn" title="View"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="action-btn" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                            <a href="javascript:void(0)" onclick="openPasswordModal('{{ $user->id }}', '{{ $user->email }}', '{{ $user->name }}')" class="action-btn" title="Password"><i class="fas fa-key"></i> Password</a>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('{{ $user->id }}')" class="action-btn" title="Delete"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #888; padding: 30px;">
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

    <div style="padding: 20px 30px; border-top: 1px solid rgba(0, 66, 0, 0.05); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div style="color: var(--text-muted); font-size: 14px; white-space: nowrap;">
            Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} entries
        </div>
        <div>
            {{ $users->links('pagination.admin') }}
        </div>
    </div>
</div>
</div>

<!-- Change Password Modal -->
<div id="passwordModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); backdrop-filter: blur(5px);">
    <div class="modal-content" style="background-color: #fefefe; margin: 10% auto; padding: 40px; border: 1px solid #888; width: 100%; max-width: 500px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); position: relative;">
        <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="font-family: 'Playfair Display', serif; color: #333; margin-bottom: 5px;">Change Password</h2>
            <p id="passwordUserEmail" style="color: #666; font-size: 14px;">Update password for dhilipkumar</p>
        </div>
        
        <form id="passwordForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="passwordUserId" name="user_id">
            <div style="margin-bottom: 25px;">
                <input type="password" id="newPassword" name="password" placeholder="Enter new password (min 6 chars)" style="width: 100%; padding: 15px; border: 2px solid #e0e0e0; border-radius: 12px; font-size: 14px; outline: none; transition: border-color 0.3s;" required minlength="6">
            </div>
            
            <div style="display: flex; gap: 15px; justify-content: center;">
                <button type="submit" style="background: var(--primary); color: #fff; border: none; padding: 12px 30px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: transform 0.2s;">Update Now</button>
                <button type="button" onclick="closePasswordModal()" style="background: #6b7280; color: #fff; border: none; padding: 12px 30px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: transform 0.2s;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openPasswordModal(id, email, name) {
    document.getElementById('passwordUserId').value = id;
    document.getElementById('passwordUserEmail').innerText = 'Update password for ' + (name || email);
    document.getElementById('passwordModal').style.display = 'block';
    document.getElementById('newPassword').value = '';
}

function closePasswordModal() {
    document.getElementById('passwordModal').style.display = 'none';
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#F44336',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel',
        reverseButtons: true,
        background: '#fff',
        borderRadius: '20px',
        customClass: {
            title: 'playfair-font',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

document.getElementById('passwordForm').onsubmit = function(e) {
    e.preventDefault();
    const id = document.getElementById('passwordUserId').value;
    const password = document.getElementById('newPassword').value;
    
    const url = "{{ route('admin.users.password.update', ':id') }}".replace(':id', id);
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            _method: 'PUT',
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                timer: 2000,
                showConfirmButton: false
            });
            closePasswordModal();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: data.message || 'Something went wrong.'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An error occurred while updating the password.'
        });
    });
};

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target == document.getElementById('passwordModal')) {
        closePasswordModal();
    }
}
</script>
@endsection
