<style>
    body {
        font-family: Arial, sans-serif;
        background: #f1f2f4;
        margin: 0;
        padding: 20px;
    }
    .container { display: flex; gap: 20px; }
    .cart-box, .summary-box { background: white; padding: 20px; border-radius: 8px; }
    .cart-box { flex: 1; }
    .cart-title { font-size: 22px; font-weight: bold; margin-bottom: 15px; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #ececec; padding: 12px; font-weight: bold; text-align: left; border-radius: 4px; }
    td { padding: 12px; border-bottom: 1px solid #eee; }
    .img-box { width: 70px; height: 70px; background: #ccc; border-radius: 6px; }
    .summary-box { width: 320px; height: fit-content; }
    .summary-title { font-weight: bold; font-size: 18px; margin-bottom: 15px; }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 15px; }
    .btn { padding: 6px 10px; border: none; border-radius: 4px; cursor: pointer; }
    .btn-add { background: #03ac0e; color: white; }
    .btn-minus { background: #ff4d4f; color: white; }
    .btn-buy { width: 100%; padding: 12px; border: none; border-radius: 6px; background: #03ac0e; color: white; font-size: 16px; cursor: pointer; margin-top: 10px; }
    .btn-buy:hover { background: #02920c; }
    input[type="number"] { width: 60px; text-align: center; }
    input[type="text"] { width: 100%; padding: 6px; border-radius: 4px; border:1px solid #ccc; }
    </style>

    <div class="container">

        <!-- LEFT PRODUCT TABLE -->
        <div class="cart-box">
            <div class="cart-title">Keranjang</div>

            @if(session('success'))
                <div style="color:green; margin-bottom:10px;">{{ session('success') }}</div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr>
                        <td>
                            @if($item->product && $item->product->gambar)
                                <img src="{{ asset($item->product->gambar->gambar) }}" alt="produk" width="100px">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>

                        <td>{{ $item->product->nama_produk }}</td>
                        <td>Rp {{ number_format($item->product->harga->harga ?? 0,0,',','.') }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:flex; gap:5px; align-items:center;">
                                @csrf
                                @method('PATCH')
                                <button name="action" value="decrease" class="btn btn-minus">-</button>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                <button name="action" value="increase" class="btn btn-add">+</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format(($item->product->harga->harga ?? 0) * $item->quantity,0,',','.') }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-minus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- SUMMARY BOX -->
        <div class="summary-box">
            <div class="summary-title">Ringkasan Belanja</div>

            <div class="summary-row">
                <span>Total</span>
                <span>Rp {{ number_format($total,0,',','.') }}</span>
            </div>

            <form action="{{ route('checkout.show', Auth::user()->id) }}" method="GET">

                <div class="form-group">
                    <label>Diskon (kode / nominal)</label>
                    <input type="text" name="discount_code" placeholder="Masukkan kode diskon">
                </div>

                <button type="submit" class="btn-buy">
                    Beli Sekarang ({{ $cartItems->sum('quantity') }})
                </button>

            </form>


        </div>

    </div>
