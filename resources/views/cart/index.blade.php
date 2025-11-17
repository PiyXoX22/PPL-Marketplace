<style>
    .cart-container {
        padding: 30px;
        background: #f7f7f7;
        min-height: 90vh;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    th {
        background: #dcdcdc;
        padding: 12px;
        text-align: left;
        font-weight: bold;
    }

    td {
        padding: 12px;
        vertical-align: middle;
        border-bottom: 1px solid #eee;
    }

    .img-box {
        width: 70px;
        height: 70px;
        background: #ccc;
        border-radius: 4px;
    }

    .summary-box {
        width: 260px;
        background: #fff;
        padding: 20px;
        border-radius: 4px;
        float: right;
        margin-top: 40px;
    }

    .summary-header {
        background: #d1d1d1;
        padding: 8px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 15px;
        border-radius: 4px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 15px;
    }
</style>

<div class="cart-container">

    {{-- TABEL PRODUK --}}
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
                <td>XX</td>
                <td>Rp. 1.500.000,00</td>
                <td>1</td>
                <td>Rp. 1.500.000,00</td>
            </tr>

            <tr>
                <td><div class="img-box"></div></td>
                <td>XXX</td>
                <td>Rp. 3.500.000,00</td>
                <td>5</td>
                <td>Rp. 17.500.000,00</td>
            </tr>
        </tbody>
    </table>

    {{-- SUMMARY --}}
    <div class="summary-box">
        <div class="summary-header">Total Keranjang</div>

        <div class="summary-row">
            <span>Sub Total</span>
            <span>Rp 19.000.000,00</span>
        </div>

        <div class="summary-row">
            <span>Ongkir</span>
            <span>Rp 10.000,00</span>
        </div>

        <div class="summary-row">
            <span>Diskon</span>
            <span>10%</span>
        </div>

        <div class="summary-row">
            <span>&nbsp;</span>
            <span>Rp 1.900.000,00</span>
        </div>

        <hr>

        <div class="summary-row" style="font-weight: bold;">
            <span>Total</span>
            <span>Rp 17.100.000,00</span>
        </div>
    </div>

</div>

