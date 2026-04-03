@extends('layouts.admin')

@section('page_title', 'Admin Profile')

@section('styles')
<style>
    .profile-card .card-header {
        align-items: flex-start;
        gap: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .profile-card .card-subtitle {
        margin: 6px 0 0;
        font-size: 13px;
        color: #888;
    }

    .profile-form {
        padding: 30px;
    }

    .section-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .section-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f9f9f9;
    }

    .section-title h4 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--primary-dark);
    }

    .section-hint {
        font-size: 11px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 500;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 20px;
    }

    .field label {
        font-size: 12px;
        color: #000000; /* Main text color */
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .field input {
        width: 100%;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 14px 18px;
        color: #333;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .field input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(0, 66, 0, 0.1);
    }

    .field input[readonly] {
        background: #fdfdfd;
        color: #777;
    }

    .form-actions {
        display: flex;
        justify-content: center;
        gap: 12px;
        padding-top: 10px;
    }

    .error-msg {
        color: #d32f2f;
        font-size: 11px;
        margin-top: 4px;
        font-weight: 500;
    }

    .profile-image-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
        padding: 40px;
        background: #fff8e1; /* Light Orange background */
        border-radius: 20px;
        border: 1px dashed #ffe0b2; /* Orange dashed border */
    }

    .current-profile-img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #fff;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        background: #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 48px;
        font-weight: 700;
    }

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .upload-btn {
        border: 1px solid var(--primary);
        color: var(--primary);
        background-color: #fff;
        padding: 10px 25px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 66, 0, 0.1);
    }

    .upload-btn:hover {
        background-color: var(--primary);
        color: #fff;
        transform: translateY(-2px);
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
    }

    .profile-tabs {
        display: flex;
        gap: 15px;
        margin: 0 30px 25px;
        border-bottom: 1px solid #eee;
        padding-bottom: 0;
    }

    .tab-btn {
        background: none;
        border: none;
        padding: 15px 30px;
        font-size: 14px;
        font-weight: 800;
        color: #777;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
    }

    .tab-btn i {
        font-size: 16px;
        color: #999;
    }

    .tab-btn.active {
        color: var(--primary);
    }

    .tab-btn.active i {
        color: var(--primary);
    }

    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary);
        border-radius: 10px 10px 0 0;
    }

    .tab-pane {
        display: none;
        animation: tabFadeIn 0.4s ease forwards;
    }

    .tab-pane.active {
        display: block;
    }

    @keyframes tabFadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 900px) {
        .profile-tabs {
            margin: 0 15px 20px;
            overflow-x: auto;
            white-space: nowrap;
        }
        .tab-btn {
            padding: 10px 15px;
            font-size: 12px;
        }
    }
</style>
@endsection

@section('content')
<div class="content-card profile-card">
    <div class="card-header">
        <div>
            <h3>Admin Profile</h3>
            <p class="card-subtitle">Update your personal information and security settings separately.</p>
        </div>
    </div>


    <div class="profile-tabs" style="margin-top: 30px;">
        <button type="button" class="tab-btn {{ !session('active_tab') || session('active_tab') == 'personal' ? 'active' : '' }}" data-tab="personal">
            <i class="fas fa-user"></i> Personal Info
        </button>
        {{-- <button type="button" class="tab-btn {{ session('active_tab') == 'address' ? 'active' : '' }}" data-tab="address">
            <i class="fas fa-map-marker-alt"></i> Address
        </button> --}}
        <button type="button" class="tab-btn {{ session('active_tab') == 'security' ? 'active' : '' }}" data-tab="security">
            <i class="fas fa-shield-alt"></i> Security
        </button>
    </div>

    <div class="tab-content" style="padding: 0;">
        <div class="tab-pane {{ !session('active_tab') || session('active_tab') == 'personal' ? 'active' : '' }}" id="personal">
            <form class="profile-form" id="personalForm" action="{{ route('admin.profile.personal') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile-image-section">
                    <div class="current-profile-img">
                        @if($user->profile_image)
                            <img id="preview-img" src="{{ asset($user->profile_image) }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                        @else
                            <span id="initials-placeholder">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                            <img id="preview-img" src="" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; display: none;">
                        @endif
                    </div>
                    <div class="upload-btn-wrapper">
                        <button type="button" class="upload-btn">Change Photo</button>
                        <input type="file" name="profile_image" id="profile_image_input" accept="image/*">
                    </div>
                    @error('profile_image') <div class="error-msg" style="text-align: center;">{{ $message }}</div> @enderror
                    <p style="font-size: 11px; color: #888; margin: 0;">JPG, PNG or GIF. Max size 2MB.</p>
                </div>

                <section class="section-card" style="margin: 0 30px;">
                    <div class="section-title">
                        <h4>Personal Information</h4>
                        <span class="section-hint">Identity</span>
                    </div>
                    
                    <div class="field">
                        <label for="name">Full Name <span style="color: red;">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email Address <span style="color: red;">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="phone">Phone Number <span style="color: red;">*</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                        @error('phone') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </section>

                <div class="form-actions" style="margin: 30px 30px 10px;">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fas fa-save" style="margin-right: 8px;"></i> Save Information
                    </button>
                </div>
            </form>
        </div>

        <div class="tab-pane {{ session('active_tab') == 'address' || $errors->hasAny(['address_line1', 'city', 'state', 'postal_code', 'country']) ? 'active' : '' }}" id="address">
            <form class="profile-form" id="addressForm" action="{{ route('admin.profile.address') }}" method="POST">
                @csrf

                <section class="section-card" style="margin: 0 30px;">
                    <div class="section-title">
                        <h4>Address Details</h4>
                        <span class="section-hint">Location</span>
                    </div>
                    
                    <div class="field">
                        <label for="address_line1">Address Line 1 <span style="color: red;">*</span></label>
                        <input type="text" id="address_line1" name="address_line1" value="{{ old('address_line1', $user->address_line1) }}" placeholder="Street address, P.O. box, etc." required>
                        @error('address_line1') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="address_line2">Address Line 2</label>
                        <input type="text" id="address_line2" name="address_line2" value="{{ old('address_line2', $user->address_line2) }}" placeholder="Apartment, suite, unit, etc. (optional)">
                        @error('address_line2') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="field">
                            <label for="city">City <span style="color: red;">*</span></label>
                            <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}" required>
                            @error('city') <div class="error-msg">{{ $message }}</div> @enderror
                        </div>
                        <div class="field">
                            <label for="state">State / Province <span style="color: red;">*</span></label>
                            <input type="text" id="state" name="state" value="{{ old('state', $user->state) }}" required>
                            @error('state') <div class="error-msg">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="field">
                            <label for="postal_code">Postal / Zip Code <span style="color: red;">*</span></label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" required>
                            @error('postal_code') <div class="error-msg">{{ $message }}</div> @enderror
                        </div>
                        <div class="field">
                            <label for="country">Country <span style="color: red;">*</span></label>
                            <input type="text" id="country" name="country" value="{{ old('country', $user->country) }}" required>
                            @error('country') <div class="error-msg">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </section>

                <div class="form-actions" style="margin: 30px 30px 10px;">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fas fa-save" style="margin-right: 8px;"></i> Save Address
                    </button>
                </div>
            </form>
        </div>

        <div class="tab-pane {{ session('active_tab') == 'security' || $errors->has('password') ? 'active' : '' }}" id="security">
            <form class="profile-form" action="{{ route('admin.profile.password') }}" method="POST">
                @csrf
                <section class="section-card" style="margin: 0 30px;">
                    <div class="section-title">
                        <h4>Security Settings</h4>
                        <span class="section-hint">Password</span>
                    </div>
                    
                    <div class="field">
                        <label for="password">New Password</label>
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" required placeholder="Minimum 8 characters" style="padding-right: 45px;">
                            <i class="fas fa-eye toggle-pass" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--primary); opacity: 0.6;" data-target="password"></i>
                        </div>
                        @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="password_confirmation">Confirm New Password</label>
                        <div style="position: relative;">
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your new password" style="padding-right: 45px;">
                            <i class="fas fa-eye toggle-pass" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--primary); opacity: 0.6;" data-target="password_confirmation"></i>
                        </div>
                    </div>

                    <div style="margin-top: 10px; padding: 12px; background: #fff8e1; border-radius: 12px; font-size: 12px; color: #666; display: flex; gap: 10px; align-items: flex-start;">
                        <i class="fas fa-info-circle" style="color: var(--primary); margin-top: 2px;"></i>
                        <span>Passwords must be at least 8 characters long and match the confirmation.</span>
                    </div>
                </section>

                <div class="form-actions" style="margin: 30px 30px 10px;">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fas fa-key" style="margin-right: 8px;"></i> Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        // Custom validation method for valid phone (no letters)
        $.validator.addMethod("validPhone", function(value, element) {
            return this.optional(element) || /^[0-9+\-\(\) ]+$/.test(value);
        }, "Phone number cannot contain letters");
        
        // Real-time format validation
        $('#name').on('input', function() {
            let val = $(this).val();
            let clean = val.replace(/[^A-Za-z\s]/g, '');
            if (val !== clean) $(this).val(clean);
        });

        $('#phone').on('input', function() {
            let val = $(this).val();
            let clean = val.replace(/\D/g, '');
            if (clean.length > 10) clean = clean.substring(0, 10);
            $(this).val(clean);
            
            let $el = $(this);
            let $error = $el.siblings('.error-msg-realtime');
            if ($error.length === 0) {
                $error = $('<div class="error-msg-realtime" style="color: #dc3545; font-size: 11px; margin-top: 4px;"></div>');
                $el.after($error);
            }
            if (clean.length > 0 && clean.length < 10) {
                $error.text('Phone number must be 10 digits').show();
            } else {
                $error.hide();
            }
        });

        $('#postal_code').on('input', function() {
            let val = $(this).val();
            let clean = val.replace(/\D/g, '');
            if (clean.length > 6) clean = clean.substring(0, 6);
            $(this).val(clean);

            let $el = $(this);
            let $error = $el.siblings('.error-msg-realtime');
            if ($error.length === 0) {
                $error = $('<div class="error-msg-realtime" style="color: #dc3545; font-size: 11px; margin-top: 4px;"></div>');
                $el.after($error);
            }
            if (clean.length > 0 && clean.length < 6) {
                $error.text('Postal code must be 6 digits').show();
            } else {
                $error.hide();
            }
        });

        // Validate Personal Info Form
        $("#personalForm").validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    validPhone: true
                }
            },
            messages: {
                name: "Please enter your full name",
                email: "Please enter a valid email address",
                phone: {
                    required: "Please enter your phone number",
                    validPhone: "Please enter a valid phone number"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("error-msg");
                error.insertAfter(element);
            }
        });

        // Validate Address Form
        $("#addressForm").validate({
            rules: {
                address_line1: "required",
                city: "required",
                state: "required",
                postal_code: "required",
                country: "required"
            },
            messages: {
                address_line1: "Please enter your address",
                city: "Please enter your city",
                state: "Please enter your state",
                postal_code: "Please enter your postal code",
                country: "Please enter your country"
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("error-msg");
                error.insertAfter(element);
            }
        });
        // Keep active tab on reload if there are errors
        @if($errors->has('password'))
            $('.tab-btn[data-tab="security"]').click();
        @elseif($errors->hasAny(['address_line1', 'city', 'state', 'postal_code', 'country']))
            $('.tab-btn[data-tab="address"]').click();
        @endif

        // Tab Switching Logic
        $('.tab-btn').on('click', function() {
            const target = $(this).data('tab');
            
            // Update buttons
            $('.tab-btn').removeClass('active');
            $(this).addClass('active');
            
            // Update panes
            $('.tab-pane').removeClass('active');
            $('#' + target).addClass('active');
        });

        // Profile Image Preview
        $('#profile_image_input').on('change', function() {
            const [file] = this.files;
            if (file) {
                const preview = $('#preview-img');
                const placeholder = $('#initials-placeholder');
                
                preview.attr('src', URL.createObjectURL(file));
                preview.show();
                if (placeholder.length) placeholder.hide();
            }
        });

        // Password Visibility Toggle
        $('.toggle-pass').on('click', function() {
            const targetId = $(this).data('target');
            const input = $('#' + targetId);
            
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
@endsection
