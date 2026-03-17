<x-headersite />

<style>

body{
background:linear-gradient(180deg,#f8fafc,#eef2ff);
transition:.3s;
}

.dark body{
background:#0f172a;
color:white;
}

/* CARD TEAM */

.dev-card{
background:white;
border-radius:16px;
padding:24px;
text-align:center;
border:1px solid #e5e7eb;
box-shadow:0 10px 25px rgba(0,0,0,.08);
transition:.35s;
}

.dark .dev-card{
background:#1e293b;
border-color:#334155;
}

.dev-card:hover{
transform:translateY(-6px);
box-shadow:0 20px 35px rgba(0,0,0,.2);
}

.dev-card h3{
color:#111827;
}

.dark .dev-card h3{
color:#f9fafb;
}

.dev-role{
color:#6b7280;
}

.dark .dev-role{
color:#94a3b8;
}

.dev-desc{
color:#4b5563;
}

.dark .dev-desc{
color:#cbd5f5;
}

</style>


<div class="max-w-5xl mx-auto px-4 py-12">

<h1 class="text-3xl font-bold mb-8 text-center">
Tim Pengembang — E-Blox Store
</h1>

<p class="text-center max-w-2xl mx-auto mb-12 text-gray-600 dark:text-gray-300">
Tim pengembang E-Blox Store terdiri dari individu profesional yang berpengalaman di bidang teknologi
dan pengembangan aplikasi web. Berikut adalah orang-orang hebat yang berada di balik platform ini:
</p>

<!-- GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

<!-- CARD 1 -->
<div class="dev-card">

<img src="{{ asset('uploads/dev/ilham.jpg') }}"
class="w-24 h-24 mx-auto mb-4 rounded-full object-cover">

<h3 class="text-lg font-semibold">
Ilham Andika Putra
</h3>

<p class="dev-role text-sm mb-3">
Full Stack Developer
</p>

<p class="dev-desc text-sm">
Fokus pada perancangan sistem, pengembangan fitur utama, API,
serta keamanan dan performa server.
</p>

</div>


<!-- CARD 2 -->
<div class="dev-card">

<img src="{{ asset('uploads/dev/izza.jpg') }}"
class="w-24 h-24 mx-auto mb-4 rounded-full object-cover">

<h3 class="text-lg font-semibold">
Izza Arya Wibowo
</h3>

<p class="dev-role text-sm mb-3">
Back End Developer
</p>

<p class="dev-desc text-sm">
Fokus dalam pengelolaan database dan arsitektur sistem
serta skalabilitas sistem.
</p>

</div>


<!-- CARD 3 -->
<div class="dev-card">

<img src="{{ asset('uploads/dev/ammar.jpg') }}"
class="w-24 h-24 mx-auto mb-4 rounded-full object-cover">

<h3 class="text-lg font-semibold">
Ammar Syauqi Firdaus
</h3>

<p class="dev-role text-sm mb-3">
Front End Developer
</p>

<p class="dev-desc text-sm">
Mengembangkan tampilan antarmuka, desain responsif,
dan memastikan pengalaman pengguna yang optimal.
</p>

</div>

</div>

</div>

<x-footersite />