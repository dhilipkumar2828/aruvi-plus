@extends('layouts.admin')

@section('page_title', 'View User Details')

@section('content')
<div class="content-card animate-fade">
    <div class="card-header" style="justify-content: space-between;">
        <h3 style="color: var(--primary); font-family: 'Playfair Display', serif;">User Profile Information</h3>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.users') }}" class="admin-btn admin-btn-ghost" style="padding: 8px 20px; font-size: 11px;">
                <i class="fas fa-arrow-left"></i> BACK TO LIST
            </a>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="admin-btn admin-btn-primary" style="padding: 8px 20px; font-size: 11px; background: #4CAF50;">
                <i class="fas fa-edit"></i> EDIT USER
            </a>
        </div>
    </div>
    
    <div class="p-responsive">
        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label class="admin-form-label">Full Name</label>
                <input type="text" class="admin-input" value="{{ $user->name }}" readonly>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Email Address</label>
                <input type="text" class="admin-input" value="{{ $user->email }}" readonly>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Phone Number</label>
                <input type="text" class="admin-input" value="{{ $user->phone ?? 'N/A' }}" readonly>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Role</label>
                <div style="margin-top: 5px;">
                    <span class="status-badge status-warning" style="background: rgba(255, 152, 0, 0.1); color: #ef6c00;">{{ ucfirst($user->role ?? 'Customer') }}</span>
                </div>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Joined On</label>
                <input type="text" class="admin-input" value="{{ optional($user->created_at)->format('M d, Y H:i:s') }}" readonly>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Last Updated</label>
                <input type="text" class="admin-input" value="{{ optional($user->updated_at)->format('M d, Y H:i:s') }}" readonly>
            </div>
        </div>
    </div>
</div>
@endsection
