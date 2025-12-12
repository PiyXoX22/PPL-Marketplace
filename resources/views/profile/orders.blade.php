<x-headersite/>

<div class="profile-container">

    {{-- Sidebar --}}
    <div class="sidebar">
        <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
            PROFILE
        </a>
        <a href="{{ route('profile.address.index') }}" class="{{ request()->routeIs('profile.address.*') ? 'active' : '' }}">
            ADDRESSES
        </a>
        <a href="{{ route('profile.orders') }}" class="{{ request()->routeIs('profile.orders') ? 'active' : '' }}">
            ORDERS
        </a>
        <a href="{{ route('logout') }}">LOGOUT</a>
    </div>

    {{-- Content --}}
    <div class="content">
        <h2>My Orders</h2>

        @forelse($orders as $order)
        <div class="order-box">
            <div class="order-header">
                <span>Order #{{ $order->id }}</span>
                <span class="status {{ $order->status }}">{{ ucfirst($order->status) }}</span>
            </div>
            <p><strong>Total:</strong> Rp {{ number_format($order->grand_total,0,',','.') }}</p>
            <p><strong>Date:</strong> {{ $order->tanggal }}</p>
            <a href="{{ route('profile.orders.detail', $order->id) }}" class="btn-detail">View Details</a>
        </div>
        @empty
        <p>Tidak ada transaksi.</p>
        @endforelse
    </div>

</div>

<style>
.profile-container { display: flex; padding: 20px; background: #f7f7f7; min-height: 80vh; }
.sidebar { width: 200px; background: #e6e6e6; padding: 20px; }
.sidebar a { display: block; padding: 10px; margin-bottom: 5px; text-decoration: none; color: #000; font-weight: bold; }
.sidebar a.active { background: #000; color: #fff; }
.content { flex: 1; background: #fff; padding: 30px; margin-left: 20px; border-radius: 4px; }
.order-box { border: 1px solid #ddd; padding: 15px; border-radius: 5px; margin-bottom: 15px; }
.order-header { display: flex; justify-content: space-between; font-weight: bold; margin-bottom: 5px; }
.status { padding: 3px 8px; border-radius: 5px; font-size: 12px; font-weight: bold; }
/* Pending = Kuning */
.pending {
    background:#fff3cd;
    color:#b38300;
}

/* Terbayar = Hijau */
.terbayar {
    background:#d1e7dd;
    color:#0f5132;
}

/* Dikemas = Biru */
.dikemas {
    background:#cfe2ff;
    color:#084298;
}

/* Dalam Pengantaran = Ungu */
.dalam_pengantaran {
    background:#e2d9f3;
    color:#44307a;
}

/* Gagal = Merah */
.gagal {
    background:#f8d7da;
    color:#842029;
}

/* Cancel = Abu */
.cancel {
    background:#e2e3e5;
    color:#41464b;
}

.btn-detail { display: inline-block; margin-top: 10px; padding: 6px 12px; background: #2d70ee; color: #fff; text-decoration: none; border-radius: 5px; font-size: 13px; }
</style>
