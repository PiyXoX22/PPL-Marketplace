<x-headersite/>

<style>

body{
background:linear-gradient(180deg,#f8fafc,#eef2ff);
transition:.3s;
}

.dark body{
background:#0f172a;
color:white;
}

/* CONTAINER */

.profile-container{
display:flex;
padding:20px;
min-height:80vh;
}

/* SIDEBAR */

.sidebar{
width:200px;
background:#f1f5f9;
padding:20px;
border-radius:10px;
}

.dark .sidebar{
background:#1e293b;
}

.sidebar a{
display:block;
padding:10px;
margin-bottom:6px;
text-decoration:none;
color:#1e293b;
font-weight:bold;
border-radius:8px;
transition:.2s;
}

.dark .sidebar a{
color:#cbd5f5;
}

/* 🔥 HOVER JADI BIRU */
.sidebar a:hover{
background:#dbeafe;
color:#1d4ed8;
}

.dark .sidebar a:hover{
background:#334155;
}

/* 🔥 ACTIVE BIRU (GANTI HITAM) */
.sidebar a.active{
background:#3b82f6;
color:#fff;
}

.dark .sidebar a.active{
background:#3b82f6;
color:white;
}

/* CONTENT */

.content{
flex:1;
background:white;
padding:30px;
margin-left:20px;
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.dark .content{
background:#1e293b;
box-shadow:0 10px 25px rgba(0,0,0,.5);
}

/* FORM */

.form-group{
margin-bottom:15px;
}

label{
display:block;
font-weight:bold;
margin-bottom:5px;
color:#1e293b;
}

.dark label{
color:#e2e8f0;
}

input[type="text"],
input[type="email"],
input[type="password"]{
width:100%;
padding:10px;
border:1px solid #ccc;
border-radius:8px;
background:white;
transition:.2s;
}

/* 🔥 FOCUS BIRU */
input:focus{
outline:none;
border:1px solid #3b82f6;
box-shadow:0 0 0 2px rgba(59,130,246,0.2);
}

.dark input{
background:#0f172a;
border:1px solid #334155;
color:white;
}

/* GRID */

.row{
display:flex;
gap:20px;
}

.col{
flex:1;
}

/* BUTTON 🔥 GANTI HITAM JADI BIRU */

.btn-submit{
padding:10px 20px;
background:#3b82f6;
color:#fff;
border:none;
border-radius:8px;
cursor:pointer;
transition:.2s;
}

.btn-submit:hover{
background:#2563eb;
}

.dark .btn-submit{
background:#3b82f6;
}

.dark .btn-submit:hover{
background:#2563eb;
}

/* AVATAR */

.avatar-box{
text-align:center;
margin-bottom:20px;
}

.avatar-img{
width:120px;
height:120px;
background:#e2e8f0;
border-radius:10px;
margin:0 auto;
}

.dark .avatar-img{
background:#334155;
}

</style>


<div class="profile-container">

{{-- SIDEBAR --}}
<div class="sidebar">

<a href="{{ route('profile.index') }}"
class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
PROFILE
</a>

<a href="{{ route('profile.address.index') }}"
class="{{ request()->routeIs('profile.address.*') ? 'active' : '' }}">
ADDRESSES
</a>

<a href="{{ route('profile.orders') }}"
class="{{ request()->routeIs('profile.orders') ? 'active' : '' }}">
ORDERS
</a>

<a href="{{ route('logout') }}">
LOGOUT
</a>

</div>


{{-- CONTENT --}}
<div class="content">

<h2 class="text-xl font-bold mb-4">
User Profile
</h2>

<div class="avatar-box">
<div class="avatar-img"></div>
<button class="btn-submit" style="margin-top:10px;">
Remove Image
</button>
</div>


<form action="{{ route('profile.update') }}" method="POST">
@csrf

<div class="row">

<div class="col">

<div class="form-group">
<label>First Name</label>
<input type="text" name="first_name" value="{{ $user->first_name }}">
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" value="{{ $user->email }}">
</div>

<div class="form-group">
<label>Password (optional)</label>
<input type="password" name="password">
</div>

<div class="form-group">
<label>Receive Email</label>
<input type="text" value="Yes" readonly>
</div>

</div>


<div class="col">

<div class="form-group">
<label>Last Name</label>
<input type="text" name="last_name" value="{{ $user->last_name }}">
</div>

<div class="form-group">
<label>Phone Number</label>
<input type="text" name="phone" value="{{ $user->phone }}">
</div>

<div class="form-group">
<label>Re-Password</label>
<input type="password" name="password_confirmation">
</div>

</div>

</div>

<button class="btn-submit">
Save Changes
</button>

</form>

</div>

</div>

<x-footersite/>