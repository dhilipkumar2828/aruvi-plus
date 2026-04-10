@extends('layouts.auri')

@section('title', 'Set New Password | Auvri Plus')

@section('extra_css')
<style>
    .auth-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 120px 20px 60px;
        background: linear-gradient(rgba(240, 243, 240, 0.8), rgba(0, 66, 0, 0.9)), url('{{ asset('auri-images/background-main.png') }}');
        background-size: cover;
        background-position: center;
    }

    .auth-container {
        width: 100%;
        max-width: 450px;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        padding: 50px 40px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(212, 175, 55, 0.3);
    }

    .auth-header h2 {
        font-family: 'Playfair Display', serif;
        color: var(--primary) !important;
        font-size: 2.2rem;
        margin-bottom: 35px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--primary);
        margin-bottom: 8px;
        display: block;
    }

    .input-wrap {
        position: relative;
    }

    .input-wrap i:not(.fa-eye):not(.fa-eye-slash) {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary);
        opacity: 0.5;
    }

    .toggle-password {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--primary);
        opacity: 0.6;
        z-index: 10;
    }

    .form-input {
        width: 100%;
        padding: 14px 15px 14px 45px;
        border-radius: 50px;
        border: 1px solid #ddd;
        font-size: 1rem;
    }

    .auth-btn {
        width: 100%;
        background: var(--primary);
        color: white;
        padding: 16px;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        margin-top: 20px;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<section class="auth-section">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>New Password</h2>
            </div>

            <form method="POST" action="{{ route('password.update') }}" id="resetPasswordForm" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" class="form-input" placeholder="Enter your email address" value="{{ old('email', request()->email) }}" required autofocus>
                    </div>
                    @error('email')
                        <div style="color: #dc3545; font-size: 12px; margin-top: 6px; font-weight: 500;">
                            <i class="fas fa-info-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" class="form-input" placeholder="Enter new password" required>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                    @error('password')
                        <div style="color: #dc3545; font-size: 12px; margin-top: 6px; font-weight: 500;">
                            <i class="fas fa-info-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Confirm your new password" required>
                        <i class="fas fa-eye toggle-password" id="togglePasswordConfirm"></i>
                    </div>
                </div>

                <button type="submit" class="auth-btn">
                    RESET PASSWORD
                </button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('extra_js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle Password Logic
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');
        if(togglePassword && passwordField) {
            togglePassword.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
        const passwordConfirmField = document.querySelector('#password_confirmation');
        if(togglePasswordConfirm && passwordConfirmField) {
            togglePasswordConfirm.addEventListener('click', function() {
                const type = passwordConfirmField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmField.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        // jQuery Validation
        $("#resetPasswordForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                email: {
                    required: "Email is required",
                    email: "Enter a valid email address"
                },
                password: {
                    required: "Password is required",
                    minlength: "Password must be at least 6 characters"
                },
                password_confirmation: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.css({
                    "color": "#dc3545",
                    "font-size": "12px",
                    "margin-top": "5px",
                    "margin-left": "10px",
                    "font-weight": "500"
                });
                error.insertAfter(element.parent());
            },
            highlight: function(element) {
                $(element).css("border-color", "#dc3545");
            },
            unhighlight: function(element) {
                $(element).css("border-color", "#ddd");
            }
        });
    });
</script>
@endsection
