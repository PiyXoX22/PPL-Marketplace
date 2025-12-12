<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $trx->id }}</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 13px;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .invoice-box {
            width: 100%;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        h2, h3 {
            margin: 0 0 10px 0;
            font-weight: 700;
        }

        .logo {
            width: 120px;
            margin-bottom: 10px;
        }

        .header-title {
            font-size: 20px;
            font-weight: bold;
        }

        .section {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background: #f5f5f5;
            font-weight: bold;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .summary-table td {
            border: none;
            padding: 4px 0;
        }

        .total-box {
            margin-top: 15px;
            width: 300px;
        }

        .total-box td {
            padding: 5px 0;
        }

        .grand-total {
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

    </style>
</head>
<body>

<div class="invoice-box">

    <div style="text-align:center; margin-bottom:25px;">
        {{-- LOGO --}}
        <img src="{{ public_path('uploads/logo.png') }}" style="width:120px;">

        <div class="header-title">INVOICE E-Blox Store</div>
        <small>ID Transaksi: <strong>{{ $trx->id }}</strong></small>
    </div>

    {{-- Informasi Transaksi --}}
    <div class="section">
        <h3>Informasi Transaksi</h3>
        <table class="summary-table">
            <tr>
                <td><strong>Tanggal</strong></td>
                <td>: {{ $trx->tanggal }}</td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>: {{ ucfirst($trx->status) }}</td>
            </tr>
            <tr>
                <td><strong>Metode Pembayaran</strong></td>
                <td>: {{ $trx->payment_method }}</td>
            </tr>
        </table>
    </div>

    {{-- Detail Barang --}}
    <div class="section">
        <h3>Detail Barang</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama / ID Barang</th>
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
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Total --}}
    <div class="section">
        <table class="total-box">
            <tr>
                <td><strong>Total Harga:</strong></td>
                <td>Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Grand Total:</strong></td>
                <td class="grand-total">Rp {{ number_format($trx->grand_total, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

</div>

<div class="footer">
    Terima kasih telah berbelanja di E-Blox Store.<br>
    Invoice ini sah dan diproses otomatis oleh sistem.
</div>

</body>
</html>
