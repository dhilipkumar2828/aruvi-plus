<div class="account-sidebar">
    <div class="user-sidebar-info">
        <div class="user-sidebar-avatar">
            @if(Auth::user()->profile_image)
                <img src="{{ asset(Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}">
            @else
                <div class="user-sidebar-initial">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
        </div>
        <h5 class="user-sidebar-name">{{ Auth::user()->name }}</h5>
        <div class="user-sidebar-email">{{ Auth::user()->email }}</div>
    </div>
    
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('customer.dashboard') }}" class="{{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('customer.orders') }}" class="{{ request()->routeIs('customer.orders*') ? 'active' : '' }}">
                <i class="fas fa-shopping-bag"></i> My Orders
            </a>
        </li>
        <li>
            <a href="{{ route('customer.address') }}" class="{{ request()->routeIs('customer.address') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i> Saved Address
            </a>
        </li>
        <li>
            <a href="{{ route('wishlist.index') }}" class="{{ request()->routeIs('wishlist.index') ? 'active' : '' }}">
                <i class="fas fa-heart"></i> My Wishlist
            </a>
        </li>
        <li>
            <a href="{{ route('customer.details') }}" class="{{ request()->routeIs('customer.details') ? 'active' : '' }}">
                <i class="fas fa-user-edit"></i> Account Details
            </a>
        </li>
        <li class="nav-logout-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>

<style>
/* Sidebar Container */
.account-sidebar {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--beige-soft);
    position: sticky;
    top: 100px;
}

/* User Info Section */
.user-sidebar-info {
    text-align: center;
    padding-bottom: 30px;
    margin-bottom: 25px;
    border-bottom: 1px solid var(--beige-light);
}

.user-sidebar-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto 15px;
    padding: 5px;
    background: linear-gradient(135deg, var(--primary) 0%, #006400 100%);
    box-shadow: 0 8px 20px rgba(0, 66, 0, 0.15);
}

.user-sidebar-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #fff;
}

.user-sidebar-initial {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    color: var(--primary);
    font-size: 32px;
    font-weight: 700;
    border-radius: 50%;
}

.user-sidebar-name {
    margin: 0;
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    color: var(--primary);
    font-size: 20px;
}

.user-sidebar-email {
    font-size: 14px;
    color: #888;
    margin-top: 5px;
}

/* Navigation List */
.sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-nav li {
    margin-bottom: 10px;
}

.sidebar-nav a {
    display: flex;
    align-items: center;
    padding: 14px 20px;
    color: #444;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 500;
    font-size: 15px;
    transition: all 0.3s ease;
    background: transparent;
}

.sidebar-nav a i {
    width: 25px;
    margin-right: 15px;
    font-size: 18px;
    color: var(--primary);
    transition: all 0.3s ease;
}

.sidebar-nav a:hover {
    background: var(--luxury-green-soft);
    color: var(--primary);
    transform: translateX(5px);
}

.sidebar-nav a.active {
    background: var(--primary);
    color: #fff;
    box-shadow: 0 5px 15px rgba(0, 66, 0, 0.2);
}

.sidebar-nav a.active i {
    color: #fff;
}

/* Logout Special Treatment */
.nav-logout-item a {
    margin-top: 20px;
    border-top: 1px solid var(--beige-light);
    border-radius: 0;
    padding-top: 25px;
    color: #d32f2f;
}

.nav-logout-item a i {
    color: #d32f2f;
}

.nav-logout-item a:hover {
    background: rgba(211, 47, 47, 0.05);
    color: #b71c1c;
}

@media (max-width: 991px) {
    .account-sidebar {
        margin-bottom: 40px;
        position: relative;
        top: 0;
    }
}
</style>
