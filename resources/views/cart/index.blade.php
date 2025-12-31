<x-headersite/>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f1f2f4;
        padding: 20px;
    }

    .container {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 20px;
        align-items: start;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,.05);
    }

    .cart-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #f5f5f5;
        padding: 12px;
        font-weight: bold;
        text-align: left;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    img {
        border-radius: 6px;
    }

    .btn {
        padding: 6px 10px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        font-size: 13px;
    }

    .btn-add { background: #007bff; color: #fff; }
    .btn-minus { background: #ff4d4f; color: #fff; }

    .qty-form {
        display: flex;
        gap: 5px;
        align-items: center;
    }

    input[type="number"], input[type="text"] {
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
        width: 70px;
        text-align: center;
    }

    /* SUMMARY */
    .summary-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 15px;
    }

    .summary-row.total {
        font-size: 18px;
        font-weight: bold;
        border-top: 1px solid #eee;
        padding-top: 10px;
    }

.coupon-box {
    margin-top: 30px;
    padding: 20px;
    border-top: 2px dashed #ddd;

    width: 100%;
    max-width: 100%;

    background: #fafafa;
    border-radius: 10px;
}


    .btn-buy {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        background: #007bff;
        color: #fff;
        font-size: 16px;
        border: none;
        margin-top: 15px;
        cursor: pointer;
    }

    .success { color: green; }
    .error { color: red; }
</style>

<div class="container">

    <!-- LEFT : CART -->
    <div class="card">
        <div class="cart-title">Keranjang</div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($cartItems as $item)
                <tr>
                    <td>
                        <div style="display:flex; gap:10px; align-items:center;">
                            <img src="{{ asset($item->product->gambar->gambar ?? '') }}" width="70">
                            <div>
                                <strong>{{ $item->product->nama_produk }}</strong>
                            </div>
                        </div>
                    </td>
                    <td>Rp {{ number_format($item->product->harga->harga ?? 0,0,',','.') }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="qty-form">
                            @csrf @method('PATCH')
                            <button name="action" value="decrease" class="btn btn-minus">-</button>
                            <input type="number" value="{{ $item->quantity }}" disabled>
                            <button name="action" value="increase" class="btn btn-add">+</button>
                        </form>
                    </td>
                    <td>
                        Rp {{ number_format(($item->product->harga->harga ?? 0) * $item->quantity,0,',','.') }}
                    </td>
                    <td>
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-minus">✕</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Keranjang kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- RIGHT : SUMMARY -->
    <div class="card">
        <div class="summary-title">Ringkasan Belanja</div>

        <div class="summary-row">
            <span>Subtotal</span>
            <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
        </div>

        <div class="total-label" id="view-total">
            Rp{{ number_format($total,0,',','.') }}
        </div>


        <div class="summary-row total">
            <span>Total</span>
            <span id="cart-total">Rp {{ number_format($total,0,',','.') }}</span>
        </div>

        <div class="coupon-box">
            <label><strong>Kode Kupon</strong></label>
            <input type="text" id="coupon-code" placeholder="Masukkan kode diskon">
            <button class="btn btn-add" style="width:100%; margin-top:10px;" onclick="applyCoupon()">
                Apply Coupon
            </button>
            <div id="coupon-msg"></div>
        </div>

        <form action="{{ route('checkout.show', auth()->id()) }}" method="GET">
            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
            <input type="hidden" name="discount" value="{{ $discount }}">
            <input type="hidden" name="total" value="{{ $total }}">

            <button type="submit" class="btn-buy">
                Checkout
            </button>
        </form>

    </div>

</div>

<script>
function applyCoupon() {
    fetch("{{ route('cart.applyCoupon') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            code: document.getElementById('coupon-code').value
        })
    })
    .then(res => res.json())
    .then(res => {
        const msg = document.getElementById('coupon-msg');

        if (!res.success) {
            msg.innerHTML = `<div class="error">${res.message}</div>`;
            return;
        }

        document.getElementById('cart-total').innerText =
            'Rp ' + res.total.toLocaleString('id-ID');

        msg.innerHTML = `<div class="success">Kupon berhasil digunakan</div>`;
    });
}
</script>
