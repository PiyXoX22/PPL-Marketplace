<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E-Blox Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #fff;
            color: #333;
        }

        header {
            padding: 15px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 20px;
            font-weight: bold;
            color: #2d70ee;
            display: flex;
            align-items: center;
        }

        header .logo img {
            height: 24px;
            margin-right: 5px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            padding: 20px;
        }

        .left {
            flex: 1;
            text-align: center;
            padding: 20px;
        }

        .left h1 {
            color: #2d70ee;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .left p {
            color: #555;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .left img {
            max-width: 350px;
        }

        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .login-box {
            width: 400px;
            padding: 40px 30px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0px 6px 18px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-box h2 {
            font-size: 22px;
            margin-bottom: 25px;
            text-align: center;
            color: #2d70ee;
        }

        .login-box input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            text-align: center;
        }

        .login-box button {
            width: 95%;
            padding: 12px;
            background: #2d70ee;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }

        .login-box button:hover {
            background: #1f55bb;
        }

        .login-box .link {
            display: block;
            margin: 12px 0;
            font-size: 13px;
            color: #007bff;
            text-decoration: none;
            text-align: center;
        }

        footer {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/0f/Shopee_logo.svg" alt="Logo">
            E-Blox Store
        </div>
    </header>

    <div class="container">
        <div class="left">
            <h1>Jadilah Penjual Terbaik!</h1>
            <p>Kelola toko Anda secara efisien di E-Blox dengan E-Blox Seller Center</p>
            <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" alt="Ilustrasi">
        </div>
        <div class="right">
            <div class="login-box">
                <h2>Verifikasi Kode OTP</h2>

                {{-- Pesan --}}
                @if(session('success'))
                    <div style="background:#d4edda;padding:10px;margin:10px 0;border-radius:5px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div style="background:#f8d7da;padding:10px;margin:10px 0;border-radius:5px;">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST">
                    @csrf

                    {{-- Nomor --}}
                    <div style="margin-bottom:10px; display:flex; flex-direction:column;">
                        <label>Nomor</label>
                        <input type="text" name="nomor" class="form-control"
                            value="{{ session('nomor') }}"
                            style="padding:8px;border:2px solid lightgray;border-radius:5px;"
                            {{ session('nomor') ? 'readonly' : '' }}
                            required>
                    </div>

                    {{-- OTP --}}
                    @if(session('nomor'))
                    <div style="margin-bottom:10px; display:flex; flex-direction:column;">
                        <label>OTP</label>
                        <input type="text" name="otp" class="form-control"
                            style="padding:8px;border:2px solid lightgray;border-radius:5px;">
                    </div>
                    @endif


                    {{-- Tombol Request OTP --}}
                    @if(!session('nomor'))
                        <button formaction="{{ route('otp.request') }}" class="btn btn-warning">
                            Request OTP
                        </button>
                    @endif

                    {{-- Tombol Login --}}
                    @if(session('nomor'))
                        <button formaction="{{ route('otp.login') }}" class="btn btn-info">
                            Login
                        </button>
                    @endif

                </form>


                </p>
            </div>
        </div>
    </div>

    <footer>
        © E-Blox 2025. Hak Cipta Dilindungi
    </footer>
</body>
</html>
        <div style="max-width:600px;margin:80px auto;box-shadow:0 0 20px -5px lightgray;padding:20px;">

</div>

