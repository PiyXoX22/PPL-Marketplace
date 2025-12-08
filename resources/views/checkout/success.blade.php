<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Berhasil</title>
    <style>
        body { font-family: Arial; background: #eaffea; padding: 40px; }
        .box {
            max-width: 450px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #b5e7b5;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            background: #03ac0e;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>🎉 Pembayaran Berhasil!</h2>
    <p>Order ID: <b>{{ $trx->id }}</b></p>
    <p>Total: <b>Rp{{ number_format($trx->grand_total,0,',','.') }}</b></p>
    <a href="/" class="btn">Kembali ke Beranda</a>
</div>

</body>
</html>
