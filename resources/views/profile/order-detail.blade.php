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
        <h2>Order Detail #{{ $trx->id }}</h2>

        <div class="order-box">
            <p><strong>Tanggal:</strong> {{ $trx->tanggal }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($trx->total,0,',','.') }}</p>
            <p><strong>Grand Total:</strong> Rp {{ number_format($trx->grand_total,0,',','.') }}</p>
            <p><strong>Paid:</strong> Rp {{ number_format($trx->paid,0,',','.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($trx->status) }}</p>
            <p><strong>Payment Method:</strong> {{ $trx->payment_method }}</p>

            <a href="{{ route('profile.orders') }}" class="btn-detail" style="background:#6c757d;">Kembali</a>
            <a href="{{ route('profile.orders.invoice', $trx->id) }}" class="btn-detail" style="background:#198754;">Download Invoice (PDF)</a>
        </div>

        <h3>Detail Barang</h3>
        <table class="table table-bordered" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trx->detail as $item)
                <tr>
                    <td>{{ $item->id_barang }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->harga_satuan,0,',','.') }}</td>
                    <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<style>
.profile-container { display:flex; padding:20px; background:#f7f7f7; min-height:80vh; }
.sidebar { width:200px; background:#e6e6e6; padding:20px; }
.sidebar a { display:block; padding:10px; margin-bottom:5px; text-decoration:none; color:#000; font-weight:bold; }
.sidebar a.active { background:#000; color:#fff; }
.content { flex:1; background:#fff; padding:30px; margin-left:20px; border-radius:4px; }
.order-box { border:1px solid #ddd; padding:15px; border-radius:5px; margin-bottom:15px; }
.btn-detail { display:inline-block; margin-top:10px; padding:6px 12px; color:#fff; text-decoration:none; border-radius:5px; font-size:13px; }
</style>
