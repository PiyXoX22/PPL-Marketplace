<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            margin: 0;
            padding-top: 0px;
        }

        /* WRAPPER */
        .payment-page {
            padding: 40px 20px;
        }

        /* CARD */
        .payment-page .box {
            max-width: 600px;
            margin: 80px auto;
            background: white;
            padding: 80px 50px; /* 🔥 tambah tinggi */
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);

            min-height: 350px; /* 🔥 bikin ke bawah */
            display: flex;
            flex-direction: column;
            justify-content: center; /* isi ke tengah */
        }

        /* BUTTON */
        .payment-page .btn {
            margin-top: 40px;
            width: 100%;
            padding: 14px;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            background: #03ac0e;
            color: #fff;
            cursor: pointer;
            transition: 0.2s;
        }

        .payment-page .btn:hover {
            background: #029c0c;
        }
        /* ================= TEXT ================= */

/* JUDUL */
.payment-page h2 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #111827;
}

/* LABEL */
.payment-page p {
    font-size: 15px;
    color: #6b7280;
    margin: 6px 0;
}

/* VALUE (biar beda dari label) */
.payment-page p b {
    color: #111827;
    font-weight: 600;
}

/* TOTAL HARGA (🔥 highlight) */
.payment-page p:last-of-type {
    font-size: 18px;
    font-weight: bold;
    color: #16a34a;
    margin-top: 10px;
}
        </style>
</head>
<body>
    <x-headersite/>

    <div class="payment-page">

        <div class="box">
            <h2>Transaksi Berhasil Dibuat</h2>
            <p><b>ID Transaksi:</b> {{ $trx->id }}</p>
            <p><b>Total Pembayaran:</b> Rp{{ number_format($trx->grand_total,0,',','.') }}</p>

            <button id="pay-button" class="btn">Bayar Sekarang</button>
        </div>

    </div>

    <x-footersite/>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

<script>
document.getElementById('pay-button').addEventListener('click', function (event) {

    event.preventDefault(); // ⛔ Mencegah reload / submit ulang

    let btn = document.getElementById('pay-button');
    btn.disabled = true;
    btn.innerText = "Memproses...";

    fetch("{{ route('checkout.midtrans') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            trx_id: "{{ $trx->id }}"
        })
    })
    .then(res => res.json())
    .then(data => {

        if (!data.success) {
            alert("Gagal mengambil Snap Token");
            btn.disabled = false;
            btn.innerText = "Bayar Sekarang";
            return;
        }

        snap.pay(data.snap_token, {
            onSuccess: function(result){
                window.location.href = "/checkout/success?order_id=" + result.order_id;
            },
            onPending: function(result){
                window.location.href = "/checkout/pending?order_id=" + result.order_id;
            },
            onError: function(result){
                window.location.href = "/checkout/failed?order_id=" + result.order_id;
            },
            onClose: function(){
                // Jika popup ditutup → tombol aktif lagi
                btn.disabled = false;
                btn.innerText = "Bayar Sekarang";
            }
        });

    })
    .catch(err => {
        console.error(err);
        btn.disabled = false;
        btn.innerText = "Bayar Sekarang";
    });

});
</script>
</body>
</html>
