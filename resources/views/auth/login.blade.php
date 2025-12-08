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

            .login-container {
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
        </style>
    </head>
    <body>
<x-headersite/>

        <div class="login-container">
            <div class="left">
                <h1>Jadilah Penjual Terbaik!</h1>
                <p>Kelola toko Anda secara efisien di E-Blox dengan E-Blox Seller Center</p>
                <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" alt="Ilustrasi">
            </div>

            <div class="right">
                <div class="login-box">
                    <h2>Login</h2>

                    <form method="POST" action="{{ route('login.process') }}">
                        @csrf

                        <input type="text" name="email" placeholder="Email atau Username" value="{{ old('email') }}" required autofocus>
                        <input type="password" name="password" placeholder="Password" required>

                        @if ($errors->any())
                            <div style="color:red; font-size:13px; margin-bottom:10px;">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        {!! NoCaptcha::display() !!}

                        @if ($errors->has('g-recaptcha-response'))
                            <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                        @endif

                        <button type="submit">LOGIN</button>
                    </form>

                    <p style="margin-top:15px; font-size:14px; text-align:center;">
                        Belum punya akun?
                        <a href="{{ route('register') }}" style="color:#2d70ee; font-weight:bold;">Daftar</a>
                        <a href="http://localhost/register">Daftar</a>

                    </p>
                </div>
            </div>
        </div>

<x-footersite/>
        {!! NoCaptcha::renderJs() !!}
    </body>
    </html>
