<x-headersite/>

<style>
    .profile-container {
        display: flex;
        padding: 20px;
        background: #f7f7f7;
        min-height: 80vh;
    }
    .sidebar {
        width: 200px;
        background: #e6e6e6;
        padding: 20px;
    }
    .sidebar a {
        display: block;
        padding: 10px;
        margin-bottom: 5px;
        text-decoration: none;
        color: #000;
        font-weight: bold;
    }
    .sidebar a.active {
        background: #000;
        color: #fff;
    }

    .content {
        flex: 1;
        background: #fff;
        padding: 30px;
        margin-left: 20px;
        border-radius: 4px;
    }

    .order-box {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .status {
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: bold;
    }

    .pending { background:#fff3cd; color:#b38300; }
    .paid { background:#d1e7dd; color:#0f5132; }
    .cancel { background:#f8d7da; color:#842029; }

    .btn-detail {
        display: inline-block;
        margin-top: 10px;
        padding: 6px 12px;
        background: #2d70ee;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 13px;
    }
</style>

<div class="profile-container">

{{-- Sidebar --}}
<div class="sidebar">
    <a href="{{ route('profile.index') }}"
       class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
        PROFILE
    </a>

    <a href="{{ route('profile.address.index') }}"
       class="{{ request()->routeIs('profile.address.*') ? 'active' : '' }}">
        ADDRESSES
    </a>

    <a href="{{ route('profile.orders') }}"
       class="{{ request()->routeIs('profile.orders') ? 'active' : '' }}">
        ORDERS
    </a>

    <a href="{{ route('logout') }}">
        LOGOUT
    </a>
</div>


    {{-- Content --}}
    <div class="content">
        <h2>My Orders</h2>

        <div class="order-box">
            <div class="order-header">
                <span>Order #ORD-001</span>
                <span class="status pending">Pending</span>
            </div>
            <p><strong>Total:</strong> Rp 150.000</p>
            <p><strong>Date:</strong> 2025-12-12</p>
            <a href="#" class="btn-detail">View Details</a>
        </div>

        <div class="order-box">
            <div class="order-header">
                <span>Order #ORD-002</span>
                <span class="status paid">Paid</span>
            </div>
            <p><strong>Total:</strong> Rp 220.000</p>
            <p><strong>Date:</strong> 2025-12-10</p>
            <a href="#" class="btn-detail">View Details</a>
        </div>

        <div class="order-box">
            <div class="order-header">
                <span>Order #ORD-003</span>
                <span class="status cancel">Cancel</span>
            </div>
            <p><strong>Total:</strong> Rp 90.000</p>
            <p><strong>Date:</strong> 2025-12-08</p>
            <a href="#" class="btn-detail">View Details</a>
        </div>

    </div>
</div>
