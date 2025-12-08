<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 40px; }
        .box {
            max-width: 450px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
        }
        .btn {
            width: 100%;
            padding: 14px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            background: #03ac0e;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Transaksi Berhasil Dibuat</h2>
    <p><b>ID Transaksi:</b> {{ $trx->id }}</p>
    <p><b>Total Pembayaran:</b> Rp{{ number_format($trx->grand_total,0,',','.') }}</p>

<button id="pay-button" class="btn">Bayar Sekarang</button>

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
