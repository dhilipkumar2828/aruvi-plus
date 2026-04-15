@extends('layouts.auri')

@section('title', 'My Account | Auvri Plus')

@section('content')
<div class="luxury-account-page">
    <div class="container">
        <!-- Dashboard Hero -->
        <div class="dashboard-hero" style="margin-top: 60px">
            <div class="dashboard-hero-content">
                <span class="welcome-text">Welcome back,</span>
                <h1 class="user-name">{{ $user->name }}</h1>
                <p class="dashboard-intro">From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>
            </div>
            <div class="dashboard-stats">
                <div class="stat-item">
                    <span class="stat-value">{{ $user->orders()->count() }}</span>
                    <span class="stat-label">Total Orders</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">{{ $user->wishlist()->count() ?? 0 }}</span>
                    <span class="stat-label">Wishlist</span>
                </div>
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
                    <div class="section-header-flex">
                        <h3 class="premium-section-title">Recent Orders</h3>
                        <a href="{{ route('customer.orders') }}" class="view-all-link">View All <i class="fas fa-arrow-right"></i></a>
                    </div>

                    @if($recentOrders->count() > 0)
                        <div class="luxury-table-wrapper">
                            <table class="luxury-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        <tr>
                                            <td><span class="order-id">#{{ $order->order_number }}</span></td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <span class="status-badge status-{{ strtolower($order->status) }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="order-total">₹{{ number_format($order->amount, 2) }}</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="{{ route('customer.orders.show', $order) }}" class="icon-btn" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('customer.orders.download', $order) }}" class="icon-btn" title="Download Invoice">
                                                        <i class="fas fa-file-download"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-shopping-bag"></i></div>
                            <p>You haven't placed any orders yet.</p>
                            <a href="{{ route('shop') }}" class="btn btn-premium">Start Shopping</a>
                        </div>
                    @endif
                </div>

                <!-- Quick Links -->
                {{-- <div class="quick-links-grid">
                    <a href="{{ route('customer.address') }}" class="quick-link-card">
                        <div class="link-icon"><i class="fas fa-map-marked-alt"></i></div>
                        <div class="link-info">
                            <h4>Shipping Address</h4>
                            <p>Update your delivery details</p>
                        </div>
                        <i class="fas fa-chevron-right arrow"></i>
                    </a>
                    <a href="{{ route('wishlist.index') }}" class="quick-link-card">
                        <div class="link-icon"><i class="fas fa-heart"></i></div>
                        <div class="link-info">
                            <h4>My Wishlist</h4>
                            <p>View your saved products</p>
                        </div>
                        <i class="fas fa-chevron-right arrow"></i>
                    </a>
                    <a href="{{ route('customer.details') }}" class="quick-link-card">
                        <div class="link-icon"><i class="fas fa-user-cog"></i></div>
                        <div class="link-info">
                            <h4>Account Settings</h4>
                            <p>Change password & profile</p>
                        </div>
                        <i class="fas fa-chevron-right arrow"></i>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Specific Styles */
.luxury-account-page {
    background: var(--beige-light);
    padding: 60px 0 100px;
    min-height: 80vh;
}

.dashboard-hero {
    background: linear-gradient(135deg, var(--primary) 0%, #006400 100%);
    border-radius: 25px;
    padding: 50px;
    color: #fff;
    margin-bottom: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 15px 40px rgba(0, 66, 0, 0.15);
}

.welcome-text {
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 2px;
    opacity: 0.8;
}

.dashboard-hero .user-name {
    font-size: 42px;
    margin: 10px 0 15px;
    color: #fff;
}

.dashboard-intro {
    max-width: 500px;
    font-size: 15px;
    opacity: 0.9;
    line-height: 1.6;
}

.dashboard-stats {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.stat-item {
    width: 180px;
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    padding: 20px 10px;
    border-radius: 20px;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.stat-value {
    display: block;
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.8;
}

/* Layout Grid */
.account-grid {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 40px;
    align-items: start;
}

/* Section Card */
.section-card {
    background: #fff;
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--beige-soft);
    margin-bottom: 30px;
}

.section-header-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.premium-section-title {
    font-size: 24px;
    color: var(--primary);
    margin: 0;
}

.view-all-link {
    color: var(--primary);
    font-weight: 600;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Luxury Table */
.luxury-table-wrapper {
    overflow-x: auto;
}

.luxury-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}

.luxury-table th {
    padding: 15px 20px;
    text-align: left;
    color: #999;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    border-bottom: 1px solid var(--beige-light);
}

.luxury-table td {
    padding: 20px;
    background: var(--luxury-green-soft);
    font-size: 15px;
    color: #444;
}

.luxury-table tr td:first-child { border-radius: 12px 0 0 12px; }
.luxury-table tr td:last-child { border-radius: 0 12px 12px 0; }

.order-id {
    font-weight: 700;
    color: var(--primary);
}

.status-badge {
    padding: 6px 12px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-pending { background: #fff8e1; color: #ffa000; }
.status-completed { background: #e8f5e9; color: #2e7d32; }
.status-shipped { background: #e3f2fd; color: #1976d2; }
.status-cancelled { background: #ffebee; color: #d32f2f; }

.order-total {
    font-weight: 700;
}

.action-btns {
    display: flex;
    gap: 10px;
}

.icon-btn {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    border: 1px solid var(--beige-soft);
    transition: all 0.3s ease;
}

.icon-btn:hover {
    background: var(--primary);
    color: #fff;
    transform: translateY(-3px);
}

/* Quick Links Grid */
.quick-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

.quick-link-card {
    background: #fff;
    padding: 25px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--beige-soft);
    text-decoration: none;
    transition: all 0.3s ease;
}

.quick-link-card:hover {
    transform: translateY(-5px);
    border-color: var(--primary);
}

.link-icon {
    width: 50px;
    height: 50px;
    background: var(--luxury-green-soft);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 20px;
}

.link-info h4 {
    margin: 0;
    font-size: 17px;
    color: var(--primary);
}

.link-info p {
    margin: 5px 0 0;
    font-size: 13px;
    color: #888;
}

.quick-link-card .arrow {
    margin-left: auto;
    color: #ccc;
    font-size: 14px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-icon {
    font-size: 60px;
    color: var(--beige-dark);
    margin-bottom: 20px;
}

.btn-premium {
    background: var(--primary);
    color: #fff;
    padding: 15px 35px;
    border-radius: 50px;
    font-weight: 600;
    margin-top: 20px;
    display: inline-block;
}

@media (max-width: 991px) {
    .dashboard-hero {
        flex-direction: column;
        text-align: center;
        padding: 40px 20px;
    }
    
    .dashboard-hero .user-name {
        font-size: 32px;
    }
    
    .dashboard-stats {
        margin-top: 30px;
        gap: 15px;
    }
    
    .account-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-links-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
