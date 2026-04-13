@extends('layouts.admin')

@section('page_title', 'Edit User')

@section('content')
<div class="content-card animate-fade">
    <div class="card-header" style="justify-content: space-between;">
        <h3 style="color: var(--primary); font-family: 'Playfair Display', serif;">Edit User Details</h3>
        <a href="{{ route('admin.users') }}" class="admin-btn admin-btn-ghost" style="padding: 8px 20px; font-size: 11px;">
            <i class="fas fa-arrow-left"></i> BACK TO LIST
        </a>
    </div>
    
    <div class="p-responsive">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="admin-form-grid">
                <div class="admin-form-group">
                    <label class="admin-form-label">Full Name</label>
                    <input type="text" name="name" class="admin-input" value="{{ old('name', $user->name) }}" required 
                        pattern="[A-Za-z\s]+" 
                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" 
                        title="Only alphabets and spaces are allowed">
                    @error('name') <small style="color: red;">{{ $message }}</small> @enderror
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Email Address</label>
                    <input type="email" name="email" class="admin-input" value="{{ old('email', $user->email) }}" required>
                    @error('email') <small style="color: red;">{{ $message }}</small> @enderror
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="admin-input" value="{{ old('phone', $user->phone) }}" 
                        maxlength="10" 
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10)" 
                        pattern="[0-9]{10}"
                        title="Please enter exactly 10 digits">
                    @error('phone') <small style="color: red;">{{ $message }}</small> @enderror
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Role</label>
                    <input type="text" class="admin-input" value="{{ ucfirst($user->role ?? 'Customer') }}" readonly>
                    <small style="color: #888;">Role cannot be changed from this screen.</small>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Account Status</label>
                    <select name="status" class="admin-select">
                        <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>ACTIVE</option>
                        <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>INACTIVE</option>
                    </select>
                    @error('status') <small style="color: red;">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div style="margin-top: 30px; display: flex; justify-content: flex-end;">
                <button type="submit" class="admin-btn" style="background: var(--primary); color: #fff; border: none; padding: 12px 30px; font-weight: 700; border-radius: 12px; box-shadow: 0 5px 15px rgba(0, 66, 0, 0.2);">
                    <i class="fas fa-lock-open"></i> UPDATE USER
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
