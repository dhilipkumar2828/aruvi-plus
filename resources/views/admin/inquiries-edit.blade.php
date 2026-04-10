@extends('layouts.admin')

@section('page_title', 'Customer Inquiries Management')

@section('content')
<div class="content-card" style="overflow: auto">
    <div class="card-header">
        <div>
            <h3>Review Customer Inquiry</h3>
            <p style="margin: 6px 0 0; font-size: 13px; color: var(--text-muted);">Inquiry content is locked for archival integrity. Update status below.</p>
        </div>
        <a href="{{ route('admin.inquiries') }}" class="admin-btn admin-btn-ghost">
            <i class="fas fa-arrow-left"></i> Back to Inquiries
        </a>
    </div>

    <form action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST" style="padding: 40px;">
        @csrf
        @method('PUT')
        
        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label class="admin-form-label">Customer Name</label>
                <input type="text" value="{{ $inquiry->name }}" readonly class="admin-input">
            </div>
            
            <div class="admin-form-group">
                <label class="admin-form-label">Email Address</label>
                <input type="email" value="{{ $inquiry->email }}" readonly class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Phone Number</label>
                <input type="text" value="{{ $inquiry->phone ?? 'N/A' }}" readonly class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Subject</label>
                <input type="text" value="{{ $inquiry->subject ?? 'General' }}" readonly class="admin-input">
            </div>

            <div class="admin-form-group" style="grid-column: span 2;">
                <label class="admin-form-label" style="display: flex; justify-content: space-between; align-items: center;">
                    Admin Response
                    @if($inquiry->replied_at)
                        <span style="font-size: 11px; color: var(--primary); font-weight: 700;">
                            LAST REPLIED: {{ $inquiry->replied_at->format('d M, Y h:i A') }}
                        </span>
                    @endif
                </label>
                <textarea name="admin_reply" rows="6" class="admin-textarea" placeholder="Type your response here... This will be sent as an email to the customer." style="border-color: var(--primary); background: #fdfdfd;">{{ old('admin_reply', $inquiry->admin_reply) }}</textarea>
                <p style="margin-top: 8px; font-size: 12px; color: #666; font-style: italic;">
                    <i class="fas fa-info-circle"></i> Updating this field will automatically send an email to the customer.
                </p>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label" style="color: var(--primary);">Status</label>
                <select name="status" class="admin-select" style="border-color: var(--primary);">
                    @foreach (['new' => 'New', 'replied' => 'Replied', 'closed' => 'Closed'] as $value => $label)
                        <option value="{{ $value }}" {{ old('status', $inquiry->status) === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 20px; padding-top: 30px; border-top: 1px solid rgba(0, 66, 0, 0.1);">
            {{-- <a href="{{ route('admin.inquiries') }}" class="admin-btn admin-btn-ghost">Discard Changes</a> --}}
            <button type="submit" class="admin-btn admin-btn-primary">
                <i class="fas fa-save"></i> Update Inquiry
            </button>
        </div>
    </form>
</div>
@endsection
