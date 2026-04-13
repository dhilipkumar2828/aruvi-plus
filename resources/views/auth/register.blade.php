@extends('layouts.auri')

@section('title', 'Create Account | Auvri Plus')

@section('extra_css')
<style>
    .auth-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 120px 20px 60px;
        background: linear-gradient(rgba(233, 236, 233, 0.8), rgba(0, 66, 0, 0.9)), url('{{ asset('auri-images/background-main.png') }}');
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .auth-container {
        width: 100%;
        max-width: 550px;
        position: relative;
        z-index: 2;
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
        margin-bottom: 10px;
        text-align: center;
    }

    .auth-header p {
        color: #666;
        text-align: center;
        margin-bottom: 35px;
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

    .form-input {
        width: 100%;
        padding: 14px 15px 14px 45px;
        border-radius: 50px;
        border: 1px solid #ddd;
        font-size: 1rem;
        transition: 0.3s;
    }

    .form-input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 4px rgba(0, 66, 0, 0.1);
    }

    .auth-btn {
        width: 100%;
        background: var(--primary);
        color: white;
        padding: 16px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        border: none;
        margin-top: 20px;
        box-shadow: 0 10px 20px rgba(0, 66, 0, 0.2);
        transition: 0.3s;
        cursor: pointer;
    }

    .auth-btn:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 15px 25px rgba(0, 66, 0, 0.3);
    }

    .auth-footer {
        margin-top: 25px;
        text-align: center;
        font-size: 0.9rem;
        color: #555;
    }

    .auth-footer a {
        color: var(--primary);
        font-weight: 700;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--primary);
        opacity: 0.5;
    }

    .error-box {
        background: #fff5f5;
        color: #c62828;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid #ffcdd2;
    }

    .input-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 576px) {
        .input-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }
</style>
@endsection

@section('content')
<section class="auth-section">
    <div class="particles" id="particles"></div>
    <div class="page-bg-overlay"></div>
    <div class="auth-blob blob-1"></div>
    <div class="auth-blob blob-2"></div>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Create Account</h2>
                <p>Join the Auvri Plus community.</p>
            </div>

            {{-- @if ($errors->any())
                <div class="error-box">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif --}}

            <form method="POST" action="{{ route('register.submit') }}" id="registerForm" novalidate>
                @csrf
                <div class="form-group">
                    <label class="form-label">Full Name<span class="text-danger" style="color: #dc3545;">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" class="form-input" placeholder="Enter your full name" value="{{ old('name') }}" required autocomplete="name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                    </div>
                    @error('name')
                        <div class="field-error" style="color: #dc3545; font-size: 12px; margin-top: 6px; padding-left: 10px; font-weight: 500;">
                            <i class="fas fa-info-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address<span class="text-danger" style="color: #dc3545;">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-input" placeholder="Enter your email address" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    @error('email')
                        <div class="field-error" style="color: #dc3545; font-size: 12px; margin-top: 6px; padding-left: 10px; font-weight: 500;">
                            <i class="fas fa-info-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number<span class="text-danger" style="color: #dc3545;">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-phone-alt"></i>
                        <input type="text" name="phone" id="reg_phone" class="form-input" placeholder="Enter your phone number" value="{{ old('phone') }}" required autocomplete="tel" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    @error('phone')
                        <div class="field-error" style="color: #dc3545; font-size: 12px; margin-top: 6px; padding-left: 10px; font-weight: 500;">
                            <i class="fas fa-info-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input-row">
                    <div class="form-group">
                        <label class="form-label">Password<span class="text-danger" style="color: #dc3545;">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" class="form-input" placeholder="Enter password" required autocomplete="new-password">
                            <i class="fas fa-eye toggle-password" data-target="password" style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--primary-color); opacity: 0.6; z-index: 10;"></i>
                        </div>
                        @error('password')
                            <div class="field-error" style="color: #dc3545; font-size: 12px; margin-top: 6px; padding-left: 10px; font-weight: 500;">
                                <i class="fas fa-info-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm Password<span class="text-danger" style="color: #dc3545;">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-shield-alt"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Confirm password" required autocomplete="new-password">
                            <i class="fas fa-eye toggle-password" data-target="password_confirmation" style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--primary-color); opacity: 0.6; z-index: 10;"></i>
                        </div>
                        @error('password_confirmation')
                            <div class="field-error" style="color: #dc3545; font-size: 12px; margin-top: 6px; padding-left: 10px; font-weight: 500;">
                                <i class="fas fa-info-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const toggles = document.querySelectorAll('.toggle-password');
                        toggles.forEach(toggle => {
                            toggle.addEventListener('click', function() {
                                const targetId = this.getAttribute('data-target');
                                const input = document.getElementById(targetId);
                                if (input) {
                                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                                    input.setAttribute('type', type);
                                    this.classList.toggle('fa-eye');
                                    this.classList.toggle('fa-eye-slash');
                                }
                            });
                        });
                    });
                </script>

                <button type="submit" class="auth-btn">
                    <span>CREATE ACCOUNT</span>
                    <i class="fas fa-user-plus"></i>
                </button>
            </form>

            <div class="auth-footer" style="margin-top: 25px; text-align: center; color: #666; font-size: 0.9rem;">
                Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 700; text-decoration: none; border-bottom: 2px solid rgba(0, 66, 0, 0.1);">Sign In</a>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        // Particles System
        function createParticles() {
            const container = document.getElementById('particles');
            const particleCount = 20;
            
            for(let i = 0; i < particleCount; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                
                const size = Math.random() * 4 + 1;
                const left = Math.random() * 100;
                const duration = Math.random() * 15 + 10;
                const delay = Math.random() * 10;
                
                p.style.width = `${size}px`;
                p.style.height = `${size}px`;
                p.style.left = `${left}%`;
                p.style.bottom = `-10px`;
                p.style.animationDuration = `${duration}s`;
                p.style.animationDelay = `${delay}s`;
                p.style.background = Math.random() > 0.5 ? 'rgba(255, 215, 0, 0.3)' : 'rgba(255, 255, 255, 0.2)';
                
                container.appendChild(p);
            }
        }
        createParticles();

        // Custom validation method for no numbers
        $.validator.addMethod("noNumbers", function(value, element) {
            return this.optional(element) || /^[^0-9]*$/.test(value);
        }, "Name cannot contain numbers");

        // Custom validation method for valid phone (only digits)
        $.validator.addMethod("validPhone", function(value, element) {
            return this.optional(element) || /^[0-9]+$/.test(value);
        }, "Phone number must contain only digits");

        $.validator.addMethod("exactLength", function(value, element, param) {
            return this.optional(element) || value.length == param;
        }, "Please enter exactly {0} digits.");

        $("#registerForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    noNumbers: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    exactLength: 10,
                    validPhone: true
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
                name: {
                    required: "Name is Required",
                    minlength: "Name must be at least 2 characters"
                },
                email: {
                    required: "Email is Required",
                    email: "Please enter a valid email address"
                },
                phone: {
                    required: "Phone Number is Required",
                    exactLength: "Phone number must be exactly 10 digits",
                    validPhone: "Only numeric digits are allowed"
                },
                password: {
                    required: "Password is Required",
                    minlength: "Password must be at least 6 characters"
                },
                password_confirmation: {
                    required: "Confirm Password is Required",
                    equalTo: "Passwords do not match"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                error.css({
                    "color": "var(--primary)",
                    "font-size": "12px",
                    "margin-top": "5px",
                    "margin-left": "6px",
                    "font-weight": "500",
                    "text-align": "left"
                });
                error.insertAfter(element.parent());
            },
            highlight: function(element, errorClass, validClass) {
                $(element).css("border-color", "var(--primary)");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).css("border-color", "rgba(0,0,0,0.08)");
            }
        });
    });
</script>
@endsection
