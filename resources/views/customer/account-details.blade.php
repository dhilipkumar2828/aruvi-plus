@extends('layouts.auri')

@section('title', 'Account Details | Bogar Siddha Peedam - Bogar Alchemist LLP')

@section('styles')
<style>
    .profile-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
        border-bottom: 1px solid #eee;
        padding-bottom: 0;
    }

    .tab-btn {
        background: none;
        border: none;
        padding: 12px 24px;
        font-size: 13px;
        font-weight: 700;
        color: #777;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
    }

    .tab-btn i {
        font-size: 14px;
    }

    .tab-btn.active {
        color: var(--primary-color);
    }

    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--primary-color);
        border-radius: 3px 3px 0 0;
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

    .account-section {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 20px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f9f9f9;
    }

    .section-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #333;
    }

    .section-tag {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #999;
    }

    .form-field {
        margin-bottom: 20px;
    }

    .form-field label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #c2185b; /* Changed from blue to maroon to match admin theme */
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .form-field input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #eee;
        border-radius: 10px;
        background: #fdfdfd;
        font-size: 14px;
        color: #333;
        transition: all 0.3s ease;
    }

    .form-field input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(194, 24, 91, 0.05);
    }

    .form-field input[readonly] {
        background: #f9f9f9;
        cursor: not-allowed;
    }

    .submit-btn {
        padding: 12px 35px;
        background: linear-gradient(90deg, #ff9800 0%, #ff5722 33%, #f44336 66%, #c2185b 100%);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(244, 67, 54, 0.3);
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(244, 67, 54, 0.4);
        filter: brightness(1.1);
    }

    .error-text {
        color: #d32f2f;
        font-size: 11px;
        margin-top: 5px;
    }
</style>
@endsection

@section('content')
<section class="hero-small" style="background-image: url('{{ asset('images/sage_bg_full.jpg') }}'); margin-bottom: 0;">
    <div class="hero-overlay"></div>
    <div class="container">
        <h1 class="page-title" style="color: #fff; position: relative; z-index: 2;">My Account</h1>
        <div class="breadcrumb" style="position: relative; z-index: 2;">
            <a href="{{ url('/') }}" style="color: #eee;">Home</a> <span style="color: #ccc;">/</span> <strong style="color: #fff;">Account Details</strong>
        </div>
    </div>
</section>

<main class="main-content" style="padding-top: 0;">

    <div class="container account-container">
        <div class="account-layout">
            <div class="account-sidebar-col">
                @include('customer.sidebar')
            </div>
            <div class="account-main-content">
                
                <div class="profile-tabs">
                    <button type="button" class="tab-btn active" data-tab="personal">
                        <i class="fas fa-user"></i> Personal Info
                    </button>
                    <button type="button" class="tab-btn" data-tab="security">
                        <i class="fas fa-shield-alt"></i> Security
                    </button>
                </div>

                <div class="tab-content">
                    {{-- Personal Info Tab --}}
                    <div class="tab-pane active" id="personal">
                        <form action="{{ route('customer.details.update') }}" method="POST" enctype="multipart/form-data" id="personalInfoForm" novalidate>
                            @csrf
                            <div class="profile-image-upload-wrapper" style="margin-bottom: 30px; background: #fff8f9; padding: 40px; border-radius: 20px; border: 1px dashed #ffd1dc; text-align: center;">
                                <div style="width: 130px; height: 130px; border-radius: 50%; overflow: hidden; border: 5px solid #fff; box-shadow: 0 10px 25px rgba(194, 24, 91, 0.1); margin: 0 auto 20px; background: #fff; display: flex; align-items: center; justify-content: center;">
                                    @if($user->profile_image)
                                        <img id="preview-img" src="{{ asset($user->profile_image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div id="initials-placeholder" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #fdf2f4; color: #c2185b; font-size: 48px; font-weight: 700;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <img id="preview-img" src="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                                    @endif
                                </div>
                                <div style="position: relative; overflow: hidden; display: inline-block;">
                                    <button type="button" class="upload-btn" style="background: #fff; border: 1px solid #c2185b; color: #c2185b; padding: 10px 35px; border-radius: 50px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(194, 24, 91, 0.05);">
                                        Change Photo
                                    </button>
                                    <input type="file" name="profile_image" id="profile_image_input" accept="image/*" style="font-size: 100px; position: absolute; left: 0; top: 0; opacity: 0; cursor: pointer;">
                                </div>
                                <p style="margin-top: 15px; color: #a0a0a0; font-size: 12px; margin-bottom: 0;">JPG, PNG or GIF. Max size 2MB.</p>
                                @error('profile_image') <div class="error-text">{{ $message }}</div> @enderror
                            </div>

                            <div class="account-section">
                                <div class="section-header">
                                    <h4 class="section-title">Personal Information</h4>
                                    <span class="section-tag">Identity</span>
                                </div>
                                
                                <div class="grid-2">
                                    <div class="form-field">
                                        <label>First Name <span style="color: red;">*</span></label>
                                        <input type="text" name="first_name" value="{{ old('first_name', explode(' ', $user->name)[0] ?? '') }}" class="form-control" required>
                                        @error('first_name') <div class="error-text">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-field">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" value="{{ old('last_name', explode(' ', $user->name)[1] ?? '') }}" class="form-control">
                                        @error('last_name') <div class="error-text">{{ $message }}</div> @enderror
                                    </div>
                                </div>



                                <div class="form-field">
                                    <label>Email Address <span style="color: red;">*</span></label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                                    @error('email') <div class="error-text">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-field">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Your phone number">
                                    @error('phone') <div class="error-text">{{ $message }}</div> @enderror
                                </div>

                                <div style="text-align: right; margin-top: 20px;">
                                    <button type="submit" class="btn-premium">
                                        <i class="fas fa-save"></i> SAVE INFORMATION
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Security Tab --}}
                    <div class="tab-pane" id="security">
                        <form action="{{ route('customer.password.update') }}" method="POST" id="securityForm" novalidate>
                            @csrf
                            <div class="account-section">
                                <div class="section-header">
                                    <h4 class="section-title">Security Settings</h4>
                                    <span class="section-tag">Password</span>
                                </div>

                                <div class="form-field">
                                    <label>Current Password <span style="color: red;">*</span></label>
                                    <div style="position: relative;">
                                        <input type="password" name="current_password" id="current_password" required placeholder="Enter current password" style="padding-right: 45px;">
                                        <i class="fas fa-eye shadow-sm toggle-pass" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #c2185b; opacity: 0.6;" data-target="current_password"></i>
                                    </div>
                                    @error('current_password') <div class="error-text">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-field">
                                    <label>New Password <span style="color: red;">*</span></label>
                                    <div style="position: relative;">
                                        <input type="password" name="password" id="new_password" required placeholder="Minimum 8 characters" style="padding-right: 45px;">
                                        <i class="fas fa-eye shadow-sm toggle-pass" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #c2185b; opacity: 0.6;" data-target="new_password"></i>
                                    </div>
                                    @error('password') <div class="error-text">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-field">
                                    <label>Confirm New Password <span style="color: red;">*</span></label>
                                    <div style="position: relative;">
                                        <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirm new password" style="padding-right: 45px;">
                                        <i class="fas fa-eye shadow-sm toggle-pass" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #c2185b; opacity: 0.6;" data-target="password_confirmation"></i>
                                    </div>
                                </div>

                                <div style="background: #fff8f9; padding: 15px; border-radius: 12px; font-size: 13px; color: #666; display: flex; gap: 10px; align-items: flex-start;">
                                    <i class="fas fa-info-circle" style="color: #c2185b; margin-top: 3px;"></i>
                                    <span>To update your password, you must provide your current password for security verification.</span>
                                </div>

                                <div style="text-align: right; margin-top: 30px;">
                                    <button type="submit" class="btn-premium">
                                        <i class="fas fa-key"></i> UPDATE PASSWORD
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        // Validation Common Options
        const validationOptions = {
            ignore: [],
            errorElement: "div",
            errorPlacement: function(error, element) {
                // Match the inline style of the address form
                error.css({"color": "#d32f2f", "font-size": "13px", "margin-top": "6px", "font-weight": "400", "display": "block", "text-align": "left"});
                
                // Special handling for password fields with toggle icon
                if (element.parent().css('position') === 'relative') {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        };

        // Personal Info Validation
        $("#personalInfoForm").validate({
            ...validationOptions,
            rules: {
                first_name: "required",
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                first_name: "Please enter your first name",
                email: "Please enter a valid email address"
            }
        });

        // Security Validation
        $("#securityForm").validate({
            ...validationOptions,
            rules: {
                current_password: "required",
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#new_password"
                }
            },
            messages: {
                current_password: "Please enter your current password",
                password: {
                    required: "Please enter a new password",
                    minlength: "Password must be at least 8 characters long"
                },
                password_confirmation: {
                    required: "Please confirm your new password",
                    equalTo: "Passwords do not match"
                }
            }
        });

        // Auto-switch to security tab if there are password errors
        @if($errors->has('current_password') || $errors->has('password'))
            $('.tab-btn[data-tab="security"]').click();
        @endif

        // Tab Switching
        $('.tab-btn').on('click', function() {
            const target = $(this).data('tab');
            
            $('.tab-btn').removeClass('active');
            $(this).addClass('active');
            
            $('.tab-pane').removeClass('active');
            $('#' + target).addClass('active');
        });

        // Image Preview
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

