<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - E-Blox Store</title>

<style>

body{
font-family: Arial, sans-serif;
margin:0;
background:linear-gradient(180deg,#f8fafc,#eef2ff);
color:#333;
transition:.3s;
}

.dark body{
background:#0f172a;
color:white;
}

/* CONTAINER */

.login-container{
display:flex;
justify-content:center;
align-items:center;
min-height:90vh;
padding:20px;
flex-wrap:wrap;
}

/* LEFT */

.left{
flex:1;
text-align:center;
padding:20px;
}

.left h1{
color:#2d70ee;
font-size:28px;
margin-bottom:10px;
}

.dark .left h1{
color:#60a5fa;
}

.left p{
color:#555;
margin-bottom:20px;
font-size:15px;
}

.dark .left p{
color:#cbd5f5;
}

.left img{
max-width:350px;
}

/* RIGHT */

.right{
flex:1;
display:flex;
justify-content:center;
padding:20px;
}

/* REGISTER BOX */

.register-box{
width:420px;
padding:40px 30px;
border-radius:14px;
background:white;
box-shadow:0 10px 30px rgba(0,0,0,.15);
display:flex;
flex-direction:column;
align-items:center;
transition:.3s;
}

.dark .register-box{
background:#1e293b;
box-shadow:0 10px 30px rgba(0,0,0,.6);
}

.register-box h2{
font-size:22px;
margin-bottom:25px;
text-align:center;
color:#2d70ee;
}

.dark .register-box h2{
color:#60a5fa;
}

/* INPUT */

.register-box input{
width:90%;
padding:12px;
margin:10px 0;
border:1px solid #ddd;
border-radius:6px;
font-size:14px;
text-align:center;
background:white;
}

.dark .register-box input{
background:#0f172a;
border:1px solid #334155;
color:white;
}

/* BUTTON */

.register-box button{
width:95%;
padding:12px;
background:#2d70ee;
color:white;
border:none;
border-radius:6px;
font-size:16px;
cursor:pointer;
margin-top:15px;
}

.register-box button:hover{
background:#1f55bb;
}

/* LOGIN LINK */

.login-link{
margin-top:12px;
font-size:14px;
}

.login-link a{
color:#2d70ee;
font-weight:bold;
text-decoration:none;
}

.dark .login-link a{
color:#60a5fa;
}

</style>

</head>
<body>

<x-headersite/>

<div class="login-container">

<div class="left">
<h1>Jelajahi Toko Kami Sekarang!</h1>
<p>Gabung menjadi bagian dari E-Blox Store dan nikmati layanan belanja online kami.</p>
<img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png">
</div>

<div class="right">

<div class="register-box">

<h2>Register</h2>

@if ($errors->any())
<div style="color:red; text-align:center; margin-bottom: 15px;">
@foreach ($errors->all() as $error)
<div>{{ $error }}</div>
@endforeach
</div>
@endif

<form action="{{ route('register.process') }}" method="POST">
@csrf

<input type="text" name="first_name" placeholder="Nama Depan" required>
<input type="text" name="last_name" placeholder="Nama Belakang" required>
<input type="text" name="username" placeholder="Nama Pengguna" required>
<input type="email" name="email" placeholder="Email Address" required>
<input type="text" name="phone" placeholder="Nomor Telepon" required>
<input type="password" name="password" placeholder="Password" required>
<input type="password" name="password_confirmation" placeholder="Confirm Password" required>

<button type="submit">REGISTER</button>

</form>

<p class="login-link">
Sudah punya akun?
<a href="{{ route('login') }}">Login</a>
</p>

</div>

</div>

</div>

<x-footersite/>

</body>
</html>