@extends('layouts.auri')

@section('title', 'My Orders | Auvri Plus')

@section('content')
<div class="luxury-account-page">
    <div class="container">
        <!-- Page Header -->
        <div class="account-page-header">
            <h1 class="account-title">My Orders</h1>
            <div class="account-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <i class="fas fa-chevron-right separator"></i>
                <a href="{{ route('customer.dashboard') }}">Account</a>
                <i class="fas fa-chevron-right separator"></i>
                <span>Orders</span>
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
                        <h3 class="premium-section-title">Order History</h3>
                        <span class="order-count">{{ $orders->total() }} Total Orders</span>
                    </div>

                    @if($orders->count() > 0)
                        <div class="luxury-table-wrapper">
                            <table class="luxury-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td><span class="order-id">#{{ $order->order_number }}</span></td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <span class="pmt-badge {{ strtolower($order->payment_status) == 'paid' ? 'pmt-paid' : 'pmt-unpaid' }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
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

                        <!-- Pagination -->
                        <div class="luxury-pagination">
                            {{ $orders->links('pagination::bootstrap-4') }}
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-box-open"></i></div>
                            <p>You haven't placed any orders yet.</p>
                            <a href="{{ route('shop') }}" class="btn btn-premium">Start Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Orders Page Specific Styles */
.luxury-account-page {
    background: var(--beige-light);
    padding: 60px 0 100px;
    min-height: 80vh;
}

.account-page-header {
    margin-bottom: 40px;
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
}

.account-breadcrumb .separator {
    font-size: 10px;
    opacity: 0.5;
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
}

.section-header-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    border-bottom: 1px solid var(--beige-light);
    padding-bottom: 20px;
}

.premium-section-title {
    font-size: 24px;
    color: var(--primary);
    margin: 0;
}

.order-count {
    font-size: 14px;
    color: #888;
    background: var(--beige-light);
    padding: 5px 15px;
    border-radius: 50px;
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

.pmt-badge {
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

.pmt-paid { background: #e8f5e9; color: #2e7d32; }
.pmt-unpaid { background: #fff3e0; color: #ef6c00; }

.status-badge {
    padding: 6px 12px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 700;
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

/* Pagination */
.luxury-pagination {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-icon {
    font-size: 80px;
    color: var(--beige-dark);
    margin-bottom: 25px;
}

.btn-premium {
    background: var(--primary);
    color: #fff;
    padding: 15px 40px;
    border-radius: 50px;
    font-weight: 600;
    margin-top: 25px;
    display: inline-block;
}

@media (max-width: 991px) {
    .account-grid {
        grid-template-columns: 1fr;
    }
    
    .account-title {
        font-size: 32px;
    }
}
</style>
@endsection
