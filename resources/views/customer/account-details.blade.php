@extends('layouts.auri')

@section('title', 'Account Details | Auvri Plus')

@section('content')
    <div class="luxury-account-page">
        <div class="container">
            <!-- Page Header -->
            <div class="account-page-header">
                <h1 class="account-title">Account Details</h1>
                <div class="account-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <i class="fas fa-chevron-right separator"></i>
                    <a href="{{ route('customer.dashboard') }}">Account</a>
                    <i class="fas fa-chevron-right separator"></i>
                    <span>Details</span>
                </div>
            </div>

            <div class="account-grid">
                <!-- Sidebar -->
                <aside class="account-sidebar-col">
                    @include('customer.sidebar')
                </aside>

                <!-- Main Content -->
                <div class="account-main-content">
                    <div class="section-card">
                        @php
                            $securityErrors = $errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation');
                            $activeTab = $securityErrors ? 'security' : 'personal';
                        @endphp
                        <!-- Tab Navigation -->
                        <div class="premium-tabs">
                            <button type="button" class="luxury-tab-btn {{ $activeTab == 'personal' ? 'active' : '' }}"
                                data-tab="personal">
                                <i class="fas fa-user-circle"></i> Personal Information
                            </button>
                            <button type="button" class="luxury-tab-btn {{ $activeTab == 'security' ? 'active' : '' }}"
                                data-tab="security">
                                <i class="fas fa-shield-alt"></i>Password
                            </button>
                        </div>

                        <div class="tab-content-wrapper">
                            <!-- Personal Info Tab -->
                            <div class="luxury-tab-pane {{ $activeTab == 'personal' ? 'active' : '' }}" id="personal">
                                <form action="{{ route('customer.details.update') }}" method="POST"
                                    enctype="multipart/form-data" id="personalInfoForm" class="luxury-form">
                                    @csrf
                                    <div class="profile-upload-section">
                                        <div class="avatar-preview-container">
                                            @if($user->profile_image)
                                                <img id="preview-img" src="{{ asset($user->profile_image) }}"
                                                    class="avatar-img">
                                            @else
                                                <div id="initials-placeholder" class="avatar-initials">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <img id="preview-img" src="" class="avatar-img" style="display: none;">
                                            @endif
                                            <label class="upload-trigger">
                                                <i class="fas fa-camera"></i>
                                            </label>
                                        </div>
                                        <input type="file" name="profile_image" id="profile_image_input" accept="image/*"
                                            style="display: none;">
                                        <div class="upload-info">
                                            <h4>Profile Picture</h4>
                                            <p>Accepted formats: JPG, PNG. Max size 2MB.</p>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>First Name <span>*</span></label>
                                            <div class="input-with-icon no-icon">
                                                <input type="text" name="first_name"
                                                    value="{{ old('first_name', explode(' ', $user->name)[0] ?? '') }}"
                                                    placeholder="Enter first name"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                            </div>
                                            @error('first_name') <span class="error-msg">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name</label>
                                            <div class="input-with-icon no-icon">
                                                <input type="text" name="last_name"
                                                    value="{{ old('last_name', explode(' ', $user->name)[1] ?? '') }}"
                                                    placeholder="Enter last name"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                            </div>
                                            @error('last_name') <span class="error-msg">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Email Address <span>*</span></label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-envelope"></i>
                                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                                placeholder="your.email@example.com">
                                        </div>
                                        @error('email') <span class="error-msg">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-phone"></i>
                                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                                placeholder="10-digit mobile number" maxlength="10"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        </div>
                                        @error('phone') <span class="error-msg">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-luxury-submit">Save Personal
                                            Information</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Security Tab -->
                            <div class="luxury-tab-pane {{ $activeTab == 'security' ? 'active' : '' }}" id="security">
                                <form action="{{ route('customer.password.update') }}" method="POST" id="securityForm"
                                    class="luxury-form">
                                    @csrf
                                    <div class="security-intro">
                                        <i class="fas fa-lock"></i>
                                        <p>Ensure your account is using a long, random password to stay secure.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Current Password <span>*</span></label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-key"></i>
                                            <input type="password" name="current_password" id="current_password"
                                                placeholder="Enter current password">
                                            <i class="fas fa-eye toggle-visibility"
                                                onclick="togglePass('current_password', this)"></i>
                                        </div>
                                        @error('current_password') <span class="error-msg">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>New Password <span>*</span></label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-shield-alt"></i>
                                            <input type="password" name="password" id="new_password"
                                                placeholder="Minimum 8 characters">
                                            <i class="fas fa-eye toggle-visibility"
                                                onclick="togglePass('new_password', this)"></i>
                                        </div>
                                        @error('password') <span class="error-msg">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm New Password <span>*</span></label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-check-double"></i>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                placeholder="Confirm new password">
                                            <i class="fas fa-eye toggle-visibility"
                                                onclick="togglePass('password_confirmation', this)"></i>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-luxury-submit">Update My Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Account Details Redesign */
        .luxury-account-page {
            background: var(--beige-light);
            padding: 60px 0 100px;
            /* Reduced from 100px to avoid huge gap */
        }

        .account-page-header {
            margin-bottom: 40px;
            margin-top: 30px;
        }

        .account-title {
            font-size: 38px;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .account-breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #888;
        }

        .account-breadcrumb a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .account-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 40px;
        }

        .section-card {
            background: #fff;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--beige-soft);
        }

        /* Tab Styling */
        .premium-tabs {
            display: flex;
            gap: 30px;
            border-bottom: 1px solid var(--beige-light);
            margin-bottom: 40px;
        }

        .luxury-tab-btn {
            padding: 15px 0;
            background: none;
            border: none;
            font-size: 16px;
            font-weight: 600;
            color: #999;
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .luxury-tab-btn i {
            font-size: 20px;
        }

        .luxury-tab-btn.active {
            color: var(--primary);
        }

        .luxury-tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 60%;
            height: 3.5px;
            background: var(--primary);
            border-radius: 10px;
        }

        /* Tab Panes */
        .luxury-tab-pane {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .luxury-tab-pane.active {
            display: block;
        }

        /* Profile Upload */
        .profile-upload-section {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 40px;
            background: var(--luxury-green-soft);
            padding: 25px;
            border-radius: 20px;
        }

        .avatar-preview-container {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .avatar-initials {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 700;
            border: 3px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .upload-trigger {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 32px;
            height: 32px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
            color: var(--primary);
            transition: all 0.3s;
            z-index: 5;
            border: 1px solid #f0f0f0;
        }

        .upload-trigger:hover {
            transform: scale(1.1);
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .upload-trigger i {
            pointer-events: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .upload-info h4 {
            margin: 0;
            color: var(--primary);
        }

        .upload-info p {
            margin: 5px 0 0;
            font-size: 13px;
            color: #888;
        }

        /* Forms */
        .luxury-form {
            width: 100%;
        }

        .luxury-form .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 5px;
            flex-wrap: wrap;
        }

        .luxury-form .col-md-6 {
            flex: 1;
            min-width: calc(50% - 10px);
        }

        .luxury-form .form-group {
            margin-bottom: 25px;
        }

        .luxury-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 14px;
            color: #333;
        }

        .luxury-form label span {
            color: #d32f2f;
        }

        .input-with-icon {
            position: relative;
            width: 100%;
        }

        .input-with-icon i:first-child {
            position: absolute;
            left: 18px;
            top: 18px;
            color: var(--primary);
            font-size: 16px;
            transition: all 0.3s;
        }

        .input-with-icon input {
            padding: 16px 20px 16px 52px;
            width: 100%;
            border: 1px solid var(--beige-dark);
            border-radius: 12px;
            background: var(--beige-light);
            font-size: 16px;
            color: #333;
            transition: all 0.3s ease;
        }

        .input-with-icon.no-icon input {
            padding-left: 20px;
        }

        .input-with-icon input:focus {
            border-color: var(--primary);
            background: #fff;
            outline: none;
            box-shadow: 0 0 0 4px var(--luxury-green-soft);
        }

        .input-with-icon input:focus+i {
            color: var(--primary);
            opacity: 1;
        }

        .toggle-visibility {
            position: absolute;
            right: 18px;
            top: 18px;
            cursor: pointer;
            color: #aaa;
            font-size: 16px;
            transition: color 0.3s;
        }

        .toggle-visibility:hover {
            color: var(--primary);
        }

        .error-msg {
            color: #d32f2f;
            font-size: 12px;
            margin-top: 6px;
            font-weight: 600;
            display: block;
        }

        .btn-luxury-submit {
            background: var(--primary);
            color: #fff;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 800;
            width: 100%;
            margin-top: 10px;
            cursor: pointer;
            border: none;
            font-size: 17px;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 25px rgba(0, 66, 0, 0.2);
            transition: all 0.3s ease;
        }

        .btn-luxury-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 66, 0, 0.3);
            background: #003300;
        }

        /* Security Tab Intro */
        .security-intro {
            display: flex;
            align-items: center;
            gap: 15px;
            background: var(--luxury-green-soft);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            border-left: 4px solid var(--primary);
        }

        .security-intro i {
            font-size: 24px;
            color: var(--primary);
        }

        .security-intro p {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
            color: var(--primary);
            font-weight: 500;
        }

        @media (max-width: 1200px) {
            .account-grid {
                grid-template-columns: 280px 1fr;
                gap: 25px;
            }

            .section-card {
                padding: 25px;
            }

            .premium-tabs {
                gap: 20px;
            }
        }

        @media (max-width: 991px) {
            .account-grid {
                grid-template-columns: 1fr;
            }

            .premium-tabs {
                gap: 15px;
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 5px;
            }

            .luxury-tab-btn {
                font-size: 14px;
            }
        }

        @media (max-width: 600px) {
            .luxury-account-page {
                background: var(--beige-light);
                padding: 30px 0 100px;
                /* Reduced from 100px to avoid huge gap */
            }

            .profile-upload-section {
                flex-direction: column;
                text-align: center;
                gap: 20px;
                padding: 20px 15px;
            }

            .upload-info p {
                font-size: 12px;
            }

            .avatar-preview-container {
                margin: 0 auto;
            }

            .section-card {
                padding: 20px 15px;
            }

            .premium-tabs {
                gap: 10px;
                margin-bottom: 30px;
            }

            .luxury-tab-btn {
                font-size: 13px;
                padding: 10px 5px;
                flex: 1;
                justify-content: center;
            }

            .luxury-tab-btn i {
                font-size: 16px;
            }

            .btn-luxury-submit {
                padding: 15px 20px;
                font-size: 15px;
            }

            .luxury-account-page .container {
                width: 100% !important;
                max-width: 100% !important;
            }
        }

        @media (max-width: 480px) {
            .luxury-account-page .container {
                padding-left: 12px !important;
                padding-right: 12px !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            .account-grid {
                gap: 15px;
                width: 100% !important;
                display: flex !important;
                flex-direction: column !important;
            }

            .section-card {
                padding: 20px 12px !important;
            }

            .account-title {
                font-size: 26px;
            }

            .luxury-form label {
                font-size: 13px;
            }

            .input-with-icon input {
                padding: 14px 15px 14px 45px;
                font-size: 15px;
            }

            .input-with-icon.no-icon input {
                padding-left: 15px;
            }

            .input-with-icon i:first-child {
                left: 15px;
                top: 16px;
                font-size: 14px;
            }

            .toggle-visibility {
                right: 15px;
                top: 16px;
            }

            .luxury-form .col-md-6 {
                flex: 0 0 100%;
                min-width: 100%;
            }

            .luxury-form .form-row {
                gap: 0;
            }
        }

        @media (max-width: 380px) {
            .section-card {
                padding: 15px 10px !important;
            }

            .account-title {
                font-size: 22px !important;
                margin-bottom: 5px;
            }

            .input-with-icon input {
                padding: 12px 12px 12px 40px;
                font-size: 14px;
            }

            .luxury-form label {
                font-size: 12px;
                margin-bottom: 5px;
            }

            .profile-upload-section {
                padding: 15px 10px;
                margin-bottom: 25px;
            }

            .premium-tabs {
                margin-bottom: 20px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tab Switching
            const tabBtns = document.querySelectorAll('.luxury-tab-btn');
            const tabPanes = document.querySelectorAll('.luxury-tab-pane');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const target = btn.getAttribute('data-tab');

                    tabBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    tabPanes.forEach(pane => {
                        pane.classList.remove('active');
                        if (pane.id === target) pane.classList.add('active');
                    });
                });
            });

            // Image Preview
            const fileInput = document.getElementById('profile_image_input');
            const uploadTrigger = document.querySelector('.upload-trigger');

            if (uploadTrigger && fileInput) {
                uploadTrigger.addEventListener('click', function (e) {
                    // Manual trigger in case label for fails
                    fileInput.click();
                });
            }

            if (fileInput) {
                fileInput.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const previewImg = document.getElementById('preview-img');
                            const placeholder = document.getElementById('initials-placeholder');

                            if (previewImg) {
                                previewImg.setAttribute('src', e.target.result);
                                previewImg.style.display = 'block';
                            }
                            if (placeholder) {
                                placeholder.style.display = 'none';
                            }
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }
        });

        function togglePass(id, icon) {
            const input = document.getElementById(id);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.add('fa-eye');
                icon.classList.remove('fa-eye-slash');
            }
        }
    </script>
@endsection