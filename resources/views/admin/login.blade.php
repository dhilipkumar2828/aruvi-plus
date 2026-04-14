<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auvri Plus | Admin Access</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Outfit:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('auri-images/logo.png') }}">

    <style>
        :root {
            --primary: #004200;
            --primary-rgb: 0, 66, 0;
            --gold: #d4af37;
            --gold-light: #f9d976;
            --accent: #006400;
            --bg-deep: #002200;
            --secondary: #d4af37;
        }

        #toast-container > .toast {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%) !important;
            opacity: 1 !important;
            box-shadow: 0 10px 30px rgba(0, 66, 0, 0.3) !important;
            border-radius: 16px !important;
            border: 1px solid rgba(212, 175, 55, 0.1) !important;
            padding: 15px 15px 15px 42px !important;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            cursor: default;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #002e00 0%, #004200 100%);
            height: 100vh;
            color: #fff;
            overflow: hidden;
            position: relative;
        }

        /* Particles Background */
        .particles {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            pointer-events: none;
            animation: float-particle linear infinite;
        }

        @keyframes float-particle {
            from { transform: translateY(0) scale(1); opacity: 0; }
            20% { opacity: 0.3; }
            80% { opacity: 0.3; }
            to { transform: translateY(-100vh) scale(0.5); opacity: 0; }
        }

        /* Full Screen Blurred Background Overlay */
        .page-bg-overlay {
            position: absolute;
            inset: 0;
            background: url('{{ asset('images/bg_texture.jpg') }}') center/cover;
            filter: blur(25px) brightness(1.2);
            opacity: 0.6;
            z-index: 0;
        }

        .split-layout {
            display: flex;
            width: 100%;
            height: 100vh;
            position: relative;
            z-index: 10;
        }

        /* Left Side: Branding */
        .left-pane {
            flex: 1.2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Bright Watermark */
        .left-pane::before {
            content: '';
            position: absolute;
            inset: 0;
            /* background: url('{{ asset('auri-images/logo.png') }}') no-repeat center center; */
            background-size: 80%;
            opacity: 0.4;
            z-index: 1;
        }

        .logo-content {
            position: relative;
            z-index: 5;
            text-align: center;
        }

        .logo-main {
            width: 380px;
            height: auto;
            filter: drop-shadow(0 0 40px rgba(255, 255, 255, 0.3));
            margin-bottom: 30px;
        }

        .brand-text-wrap {
            margin-top: 20px;
        }

        .brand-text-wrap h1 {
            font-size: 52px;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            background: linear-gradient(135deg, #ffffff 0%, var(--gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            line-height: 1.1;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }

        .brand-text-wrap p {
            font-size: 16px;
            font-weight: 700;
            color: #ffd700;
            letter-spacing: 12px;
            text-transform: uppercase;
            margin-top: 8px;
            opacity: 0.9;
        }

        .mantra-text {
            font-size: 18px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.8);
            letter-spacing: 3px;
            margin-top: 25px;
            font-style: italic;
            text-transform: lowercase;
        }

        /* Right Side: Form */
        .right-pane {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
        }

        .form-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 45px;
            padding: 60px 50px;
            box-shadow: 
                0 40px 100px -10px rgba(0, 0, 0, 0.4),
                0 20px 40px -5px rgba(0, 0, 0, 0.2);
            color: #000;
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--gold), var(--primary));
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-header h2 {
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            color: var(--primary);
        }

        .form-header p {
            color: #666;
            font-size: 15px;
        }

        /* Form Inputs */
        .field-group {
            margin-bottom: 25px;
        }

        .field-label {
            display: block;
            margin: 0 0 10px 4px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #555;
        }

        .input-wrap {
            position: relative;
            background: #f8f9fa;
            border: 1.5px solid #eee;
            border-radius: 18px;
            transition: all 0.3s ease;
        }

        .input-wrap i:not(.fas.fa-eye):not(.fas.fa-eye-slash) {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold);
            opacity: 0.7;
            font-size: 16px;
        }

        .input-box {
            width: 100%;
            padding: 18px 50px 18px 56px;
            background: transparent;
            border: none;
            color: #000; /* Solid Black text */
            font-family: inherit;
            font-size: 15px;
            font-weight: 500;
            outline: none;
        }

        .input-box::placeholder {
            color: #bbb;
        }

        .input-wrap:focus-within {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .actions-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0 35px;
        }

        .check-box {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 13px;
            cursor: pointer;
        }

        .link-access {
            color: var(--gold);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-submit {
            width: 100%;
            height: 64px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
            border: none;
            border-radius: 20px;
            color: #fff;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            box-shadow: 0 15px 35px rgba(0, 66, 0, 0.25);
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-4px) scale(1.02);
            filter: brightness(1.1);
            box-shadow: 0 20px 45px rgba(233, 30, 99, 0.45);
        }

        /* Error States */
        .err-msg {
            background: rgba(244, 67, 54, 0.12);
            border: 1px solid rgba(244, 67, 54, 0.2);
            border-radius: 15px;
            padding: 14px 20px;
            margin-bottom: 30px;
            color: #ff8a80;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        @media (max-width: 1024px) {
            .left-pane { display: none; }
            .right-pane { flex: 1; padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="particles" id="particles"></div>
    <div class="page-bg-overlay"></div>

    <div class="split-layout">
        <!-- Brand Side -->
        <div class="left-pane">
            <div class="logo-content">
                <img src="{{ asset('auri-images/logo.png') }}" alt="Auvri Plus Logo" class="logo-main">
                {{-- <div class="brand-text-wrap">
                    <h1>Auvri Plus</h1>
                    <p>Auvri Plus</p>
                </div>
                <div class="mantra-text">Mantra for Success</div> --}}
            </div>
        </div>

        <!-- Form Side -->
        <div class="right-pane">
            <div class="form-card">
                <div class="form-header">
                    <h2>Admin Portal</h2>
                    <p>Welcome back! Please sign in.</p>
                </div>

                <form action="{{ route('admin.authenticate') }}" method="POST" id="adminLoginForm" novalidate>
                    @csrf
                    
                    @if ($errors->any())
                        <div class="err-msg">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <div class="field-group">
                        <label class="field-label">Enter Email Address</label>
                        <div class="input-wrap">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" class="input-box" placeholder="Enter Email Address" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Enter Password</label>
                        <div class="input-wrap">
                            <i class="fas fa-key"></i>
                            <input type="password" name="password" id="adminPassword" class="input-box" placeholder="••••••••" required autocomplete="current-password">
                            <i class="fas fa-eye" id="toggleAdminPassword" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--primary); opacity: 0.6; z-index: 10;"></i>
                        </div>
                    </div>

                    {{-- <div class="actions-flex">
                        <label class="check-box">
                            <input type="checkbox" name="remember">
                            <span>Remember session</span>
                        </label>
                        <a href="#" class="link-access">Forgot password?</a>
                    </div> --}}

                    <button type="submit" class="btn-submit">
                        <span>Login</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            toastr.options = { "closeButton": true, "progressBar": true, "positionClass": "toast-top-right", "timeOut": "5000" };

            @if(Session::has('success')) toastr.success("{{ Session::get('success') }}"); @endif
            @if(Session::has('error')) toastr.error("{{ Session::get('error') }}"); @endif

            // Smooth Particles System
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

            const toggleAdminPassword = document.querySelector('#toggleAdminPassword');
            const adminPassword = document.querySelector('#adminPassword');

            if (toggleAdminPassword && adminPassword) {
                toggleAdminPassword.addEventListener('click', function () {
                    const type = adminPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                    adminPassword.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }

            $("#adminLoginForm").validate({
                rules: {
                    email: { required: true, email: true },
                    password: { required: true }
                },
                messages: {
                    email: { required: "Email is required", email: "Valid email needed" },
                    password: { required: "Password is required" }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    error.css({ "color": "#ff8a80", "font-size": "12px", "margin-top": "6px", "margin-left": "4px" });
                    error.insertAfter(element.parent());
                },
                highlight: function(element) { $(element).parent().css("border-color", "#f44336"); },
                unhighlight: function(element) { $(element).parent().css("border-color", "rgba(255, 255, 255, 0.1)"); }
            });
        });
    </script>
</body>
</html>
