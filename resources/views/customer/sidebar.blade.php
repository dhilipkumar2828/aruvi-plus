<div class="account-sidebar">
    <div class="user-sidebar-info">
        <div class="user-sidebar-avatar">
            @if(Auth::user()->profile_image)
                <img src="{{ asset(Auth::user()->profile_image) }}">
            @else
                <div class="user-sidebar-initial">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
        </div>
        <h5 class="user-sidebar-name">{{ Auth::user()->name }}</h5>
        <div class="user-sidebar-email">{{ Auth::user()->email }}</div>
    </div>
    {{-- <h4 class="sidebar-title">NAVIGATION</h4> --}}
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('customer.dashboard') }}" class="{{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('customer.orders') }}" class="{{ request()->routeIs('customer.orders*') ? 'active' : '' }}">
                <i class="fas fa-box-open"></i> Orders
            </a>
        </li>
        <li>
            <a href="{{ route('customer.address') }}" class="{{ request()->routeIs('customer.address') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i> Address
            </a>
        </li>
        <li>
            <a href="{{ route('customer.details') }}" class="{{ request()->routeIs('customer.details') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i> Account Details
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</div>

<style>
.account-sidebar {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 30px;
}

.user-sidebar-info {
    text-align: center;
    padding-bottom: 25px;
    border-bottom: 1px dashed #eee;
    margin-bottom: 25px;
}

.user-sidebar-avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 15px;
    border: 4px solid #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    position: relative;
    background: #f9f9f9;
}

.user-sidebar-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-sidebar-initial {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--icon-gradient);
    color: #fff;
    font-size: 28px;
    font-weight: 800;
}

.user-sidebar-name {
    margin: 0;
    font-weight: 800;
    color: #1a1a1a;
    font-size: 18px;
}

.user-sidebar-email {
    font-size: 13px;
    color: #888;
    margin-top: 5px;
}

.sidebar-title {
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
    color: #bbb;
    margin: 0 0 15px 10px;
    text-transform: uppercase;
}

.sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-nav li {
    margin-bottom: 15px;
}

.sidebar-nav li:last-child {
    margin-bottom: 0;
}

.sidebar-nav a {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    background: #f8f9fa;
    border-radius: 10px;
    color: #444;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 15px;
}

.sidebar-nav a i {
    width: 30px;
    margin-right: 15px;
    text-align: center;
    color: inherit;
    font-size: 18px;
}

.sidebar-nav a:hover, .sidebar-nav a.active {
    background: linear-gradient(90deg, #ff9800 0%, #ff5722 33%, #f44336 66%, #c2185b 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(244, 67, 54, 0.25);
}
</style>
