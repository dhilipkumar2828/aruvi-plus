@extends('layouts.auri')

@section('title', 'Welcome Back | Auvri Plus')

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
        position: relative;
    }

    .auth-container {
        width: 100%;
        max-width: 450px;
        position: relative;
        z-index: 2;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        padding: 50px 40px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(212, 175, 55, 0.3); /* Gold border */
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
                <h2>Welcome Back</h2>
                <p>Continue your spiritual journey with us.</p>
            </div>

            @if ($errors->any())
                <div class="error-box">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" id="loginForm" novalidate>
                @csrf
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-input" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" class="form-input" placeholder="••••••••" required autocomplete="current-password">
                        <i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--primary); opacity: 0.6; z-index: 10;"></i>
                    </div>
                </div>  

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const togglePassword = document.querySelector('#togglePassword');
                        const password = document.querySelector('#password');

                        togglePassword.addEventListener('click', function (e) {
                            // toggle the type attribute
                            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                            password.setAttribute('type', type);
                            // toggle the eye / eye-slash icon
                            this.classList.toggle('fa-eye');
                            this.classList.toggle('fa-eye-slash');
                        });
                    });
                </script>

                {{-- <div class="remember-flex">
                    <label class="remember-label">
                        <input type="checkbox" name="remember">
                        <span>Keep me logged in</span>
                    </label>
                    <a href="#" class="forgot-link">Forgot?</a>
                </div> --}}

                <button type="submit" class="auth-btn">
                    <span>SIGN IN</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
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

        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Email is Required",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Password is Required"
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
