@php
    // Determine which layout to use
    // If it's an admin route AND the user is logged in as admin, use the admin layout.
    // Otherwise, use the public website layout.
    $isAdminPath = request()->is('admin/*') || request()->is('admin');
    $isAdminLoggedIn = Auth::guard('admin')->check();
    
    $useAdminLayout = $isAdminPath && $isAdminLoggedIn;
    $layout = $useAdminLayout ? 'layouts.admin' : 'layouts.auri';
@endphp

@extends($layout)

@section('title', '404 - Page Not Found | Auvri Plus')

@section('content')
@if($useAdminLayout)
    <!-- Admin Content style for logged-in admins -->
    <div class="main-content" style="margin-left: 0; padding: 60px 40px; text-align: center; background: #fff;">
        <div class="content-card" style="padding: 100px 40px; box-shadow: none; border: 1px solid #eee;">
            <div style="font-size: 150px; font-weight: 800; color: #004200; opacity: 0.1; line-height: 1; margin-bottom: -50px;">404</div>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 40px; color: #004200; position: relative; z-index: 2;">Module Not Found</h1>
            <p style="color: #666; font-size: 16px; margin: 30px auto; max-width: 500px;">The administration page or data record you are looking for has been moved or does not exist.</p>
            <a href="{{ route('admin.dashboard') }}" class="admin-btn admin-btn-primary" style="padding: 15px 40px; font-weight: 700;">Return to Admin Dashboard</a>
        </div>
    </div>
@else
    <!-- Website Content style for public users and non-logged-in admins -->
    <div class="error-page-wrapper" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background: #f9fbf9; padding: 60px 20px; text-align: center;">
        <div class="error-content" style="max-width: 600px;">
            <div class="error-icon" style="font-size: 120px; color: #004200; font-weight: 800; line-height: 1; margin-bottom: 20px; opacity: 0.1; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none; z-index: 0;">404</div>
            <div style="position: relative; z-index: 1;">
                <div class="leaf-box" style="margin-bottom: 30px; display: inline-block;">
                    <i class="fas fa-leaf" style="font-size: 3rem; color: #81c784; transform: rotate(-45deg);"></i>
                </div>
                <h1 class="sec-title" style="font-size: 2.5rem; color: #004200; margin-bottom: 20px;">Lost Your Path?</h1>
                <p class="p-text" style="font-size: 1.2rem; color: #555; margin-bottom: 40px; line-height: 1.6;">The page you are looking for has wandered away from the wellness path. Let us help you find your way back.</p>
                <div class="action-btns">
                    <a href="{{ route('home') }}" class="btn btn-primary" style="padding: 15px 40px; border-radius: 50px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Go Back Home</a>
                    @if($isAdminPath)
                        <a href="{{ route('admin.login') }}" class="btn btn-outline" style="padding: 15px 40px; border-radius: 50px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px; margin-left: 15px; border: 2px solid #004200;">Admin Login</a>
                    @else
                        <a href="{{ route('shop') }}" class="btn btn-outline" style="padding: 15px 40px; border-radius: 50px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px; margin-left: 15px; border: 2px solid #004200;">Shop Products</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<style>
    @media (max-width: 600px) {
        .error-content h1 { font-size: 2rem !important; }
        .action-btns { display: flex; flex-direction: column; gap: 15px; }
        .btn-outline { margin-left: 0 !important; }
        .main-content { padding: 20px !important; }
    }
</style>
@endsection
