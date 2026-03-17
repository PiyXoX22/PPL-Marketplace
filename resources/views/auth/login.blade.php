<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | E-Blox Store</title>

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

/* LAYOUT */

.login-container{
display:flex;
justify-content:center;
align-items:center;
min-height:90vh;
padding:20px;
flex-wrap:wrap;
}

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

/* LOGIN BOX */

.login-box{
width:400px;
padding:40px 30px;
border-radius:14px;
background:white;
box-shadow:0 10px 30px rgba(0,0,0,.15);
display:flex;
flex-direction:column;
align-items:center;
transition:.3s;
}

.dark .login-box{
background:#1e293b;
box-shadow:0 10px 30px rgba(0,0,0,.6);
}

.login-box h2{
font-size:22px;
margin-bottom:25px;
text-align:center;
color:#2d70ee;
}

.dark .login-box h2{
color:#60a5fa;
}

/* INPUT */

.login-box input{
width:90%;
padding:12px;
margin:10px 0;
border:1px solid #ddd;
border-radius:6px;
font-size:14px;
text-align:center;
background:white;
}

.dark .login-box input{
background:#0f172a;
border:1px solid #334155;
color:white;
}

/* BUTTON */

.login-box button{
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

.login-box button:hover{
background:#1f55bb;
}

/* SEPARATOR */

.separator{
width:100%;
display:flex;
align-items:center;
margin:20px 0;
}

.separator::before,
.separator::after{
content:"";
flex:1;
height:1px;
background:#ccc;
}

.dark .separator::before,
.dark .separator::after{
background:#475569;
}

.separator span{
margin:0 12px;
color:#777;
font-size:14px;
white-space:nowrap;
}

.dark .separator span{
color:#cbd5f5;
}

/* GOOGLE BUTTON */

.google-btn{
margin-top:10px;
width:95%;
display:flex;
align-items:center;
justify-content:center;
gap:10px;
padding:10px;
border-radius:8px;
border:1px solid #ddd;
background:white;
font-weight:600;
cursor:pointer;
}

.dark .google-btn{
background:#0f172a;
border:1px solid #334155;
color:white;
}

.google-btn:hover{
background:#f3f4f6;
}

.dark .google-btn:hover{
background:#1e293b;
}

/* REGISTER */

.register{
margin-top:15px;
font-size:14px;
text-align:center;
}

.register a{
color:#2d70ee;
font-weight:bold;
text-decoration:none;
}

</style>

</head>

<body>

<x-headersite/>

<div class="login-container">

<div class="left">
<h1>Jadilah Pembeli Terbaik!</h1>
<p>Nikmati layanan berbelanja online dengan fitur menakjubkan E-Blox Store</p>
<img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png">
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
<small style="color:red">
{{ $errors->first('g-recaptcha-response') }}
</small>
@endif

<button type="submit">LOGIN</button>

</form>


<div class="separator">
<span>Atau login dengan</span>
</div>


<a href="{{ route('google.login') }}" class="google-btn">
<img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20">
<span>Google</span>
</a>


<p class="register">
Belum punya akun?
<a href="{{ route('register') }}">Daftar</a>
</p>

</div>

</div>

</div>

<x-footersite/>

{!! NoCaptcha::renderJs() !!}

</body>
</html>