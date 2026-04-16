@extends('layouts.auri')

@section('title', 'Forgot Password | Auvri Plus')

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
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .auth-header h2 {
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

        .input-wrap i {
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
        }

        .auth-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 0.9rem;
            color: #555;
        }

        .success-box {
            background: #f0fdf4;
            color: #166534;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            border: 1px solid #bbf7d0;
        }

        @media (max-width: 1060px) {
            .auth-section {
                padding: 70px 20px 60px;
            }
        }
    </style>
@endsection

@section('content')
    <section class="auth-section">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <h2>Reset Password</h2>
                    <p>Enter your email address and we'll send you a link to reset your password.</p>
                </div>

                @if (session('success'))
                    <div class="success-box">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <div class="input-wrap">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" class="form-input" placeholder="Enter your email address"
                                value="{{ old('email') }}" required autofocus>
                        </div>
                        @error('email')
                            <div style="color: #dc3545; font-size: 12px; margin-top: 6px; padding-left: 10px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="auth-btn">
                        <span>SEND RESET LINK</span>
                    </button>
                </form>

                <div class="auth-footer">
                    <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 700;">Back to Login</a>
                </div>
            </div>
        </div>
    </section>
@endsection