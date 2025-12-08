<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Pending</title>
    <style>
        body { font-family: Arial; background: #fff5d1; padding: 40px; }
        .box {
            max-width: 450px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #ffe08a;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            background: #ffae00;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>⏳ Pembayaran Pending</h2>
    <p>Order ID: <b>{{ $trx->id }}</b></p>
    <p>Silakan selesaikan pembayaran melalui metode yang kamu pilih.</p>

    <a href="/" class="btn">Kembali ke Beranda</a>
</div>

</body>
</html>
