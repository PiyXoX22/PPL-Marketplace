<style>
    body {
        font-family: Arial, sans-serif;
        background: #f1f2f4;
        margin: 0;
        padding: 20px;
    }

    .container {
        display: flex;
        gap: 20px;
    }

    /* --- LEFT CONTENT (LIST PRODUK) --- */
    .cart-box {
        background: white;
        padding: 20px;
        border-radius: 8px;
        flex: 1;
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
        background: #ececec;
        padding: 12px;
        font-weight: bold;
        text-align: left;
        border-radius: 4px;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .img-box {
        width: 70px;
        height: 70px;
        background: #ccc;
        border-radius: 6px;
    }

    /* --- SUMMARY BOX (KANAN) --- */
    .summary-box {
        width: 320px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        height: fit-content;
    }

    .summary-title {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 15px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 15px;
    }

    .btn-buy {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background: #03ac0e;
        color: white;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn-buy:hover {
        background: #02920c;
    }

</style>

<div class="container">

    <!-- LEFT PRODUCT TABLE -->
    <div class="cart-box">
        <div class="cart-title">Keranjang</div>

        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><div class="img-box"></div></td>
                    <td>Morris Grey 100ml</td>
                    <td>Rp 37.740</td>
                    <td>1</td>
                    <td>Rp 37.740</td>
                </tr>

                <tr>
                    <td><div class="img-box"></div></td>
                    <td>Produk Lain</td>
                    <td>Rp 50.000</td>
                    <td>2</td>
                    <td>Rp 100.000</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- SUMMARY BOX -->
    <div class="summary-box">
        <div class="summary-title">Ringkasan Belanja</div>

        <div class="summary-row">
            <span>Total</span>
            <span>Rp 137.740</span>
        </div>

        <button class="btn-buy">Beli (2)</button>
    </div>

</div>
