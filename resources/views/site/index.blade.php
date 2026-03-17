{{-- Header --}}
<x-headersite/>

<script>
document.getElementById('menu-toggle')?.addEventListener('click', function () {
    document.getElementById('mobile-menu')?.classList.toggle('hidden');
});
</script>

<style>

/* GLOBAL */
body{
background:linear-gradient(180deg,#f8fafc,#eef2ff);
transition:.3s;
}

.dark body{
background:#0f172a;
color:white;
}

/* BANNER */

.banner-slider{
position:relative;
max-width:1200px;
margin:auto;
overflow:hidden;
border-radius:20px;
box-shadow:0 10px 40px rgba(0,0,0,.15);
}

.banner-track{
display:flex;
transition:transform .6s ease;
}

.banner-slide{
min-width:100%;
height:420px;
display:flex;
align-items:center;
padding:60px;
position:relative;
color:white;
background-size:cover;
background-position:center;
}

.banner-slide::after{
content:'';
position:absolute;
inset:0;
background:linear-gradient(90deg,rgba(0,0,0,.6),rgba(0,0,0,.15));
}

.banner-left{
position:relative;
z-index:2;
max-width:480px;
animation:fadeUp .8s ease;
}

.banner-left h2{
font-size:38px;
font-weight:800;
margin-bottom:10px;
}

.banner-left p{
font-size:18px;
opacity:.9;
}

/* DOT */

.banner-nav{
position:absolute;
bottom:20px;
left:50%;
transform:translateX(-50%);
display:flex;
gap:10px;
z-index:5;
}

.dot{
width:12px;
height:12px;
border-radius:50%;
background:#ccc;
cursor:pointer;
transition:.3s;
}

.dot.active{
background:#22c55e;
}

/* ARROW */

.arrow{
position:absolute;
top:50%;
transform:translateY(-50%);
background:rgba(0,0,0,.4);
color:white;
font-size:20px;
padding:12px;
border-radius:50%;
cursor:pointer;
z-index:5;
}

.arrow-left{ left:15px }
.arrow-right{ right:15px }

/* SEARCH */

.search-box{
background:white;
border-radius:50px;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,.1);
}

.dark .search-box{
background:#1e293b;
}

/* KATEGORI */

.kategori-scroll{
display:flex;
gap:22px;
overflow-x:auto;
padding:10px 4px;
margin-bottom:30px;
scrollbar-width:none;
}

.kategori-scroll::-webkit-scrollbar{
display:none;
}

.kategori-item{
text-align:center;
flex-shrink:0;
width:90px;
cursor:pointer;
text-decoration:none;
}

.kategori-icon{
width:70px;
height:70px;
border-radius:50%;
display:flex;
justify-content:center;
align-items:center;
margin:auto;
overflow:hidden;
background:linear-gradient(145deg,#f1f5f9,#e2e8f0);
transition:.3s;
box-shadow:0 6px 12px rgba(0,0,0,.1);
}

.dark .kategori-icon{
background:#1f2937;
}

.kategori-item:hover .kategori-icon{
transform:translateY(-6px) scale(1.05);
box-shadow:0 10px 20px rgba(0,0,0,.25);
}

.kategori-title{
font-size:14px;
font-weight:600;
margin-top:6px;
}

/* PRODUK CARD */

.product-card{
background:white;
border-radius:16px;
overflow:hidden;
transition:.35s;
box-shadow:0 6px 16px rgba(0,0,0,.08);
}

.dark .product-card{
background:#1e293b;
}

.product-card:hover{
transform:translateY(-6px);
box-shadow:0 20px 30px rgba(0,0,0,.25);
}

.product-img{
height:240px;
object-fit:cover;
width:100%;
transition:.5s;
}

.product-card:hover .product-img{
transform:scale(1.05);
}

.product-btn{
margin-top:12px;
width:100%;
padding:10px;
border-radius:10px;
background:linear-gradient(90deg,#3b82f6,#6366f1);
color:white;
transition:.3s;
}

.product-btn:hover{
background:linear-gradient(90deg,#6366f1,#3b82f6);
}

/* ANIMATION */

@keyframes fadeUp{
from{
opacity:0;
transform:translateY(30px);
}
to{
opacity:1;
transform:translateY(0);
}
}

</style>


{{-- HERO BANNER --}}
<section style="padding:40px 0">

<div class="banner-slider">

<div class="arrow arrow-left" onclick="prevBanner()">❮</div>
<div class="arrow arrow-right" onclick="nextBanner()">❯</div>

<div id="bannerTrack" class="banner-track">

@foreach($banners as $banner)

<div class="banner-slide"
style="background-image:url('{{ asset($banner->gambar) }}')">

<div class="banner-left">
<h2>{{ $banner->judul }}</h2>
<p>{{ $banner->subjudul }}</p>
</div>

</div>

@endforeach

</div>

<div class="banner-nav">

@foreach($banners as $key=>$banner)

<div class="dot {{ $key==0 ? 'active':'' }}"
onclick="goToBanner({{ $key }})"></div>

@endforeach

</div>

</div>

</section>


{{-- SEARCH --}}
<div class="container mx-auto px-4 mt-8">

<form action="{{ route('filter') }}" method="GET"
class="flex items-center max-w-xl mx-auto search-box">

<input
type="text"
name="search"
placeholder="Cari produk..."
class="flex-1 px-4 py-3 bg-transparent outline-none dark:text-white">

<button
class="px-6 py-3 text-white"
style="background:linear-gradient(90deg,#3b82f6,#6366f1)">
Cari
</button>

</form>

</div>


{{-- KATEGORI --}}
<div class="kategori-scroll">

@foreach ($kategoriList as $k)

<a href="{{ route('filter',['kategori'=>$k->kategori]) }}"
class="kategori-item">

<div class="kategori-icon">

@if($k->gambar)
<img src="{{ asset($k->gambar) }}"
style="width:100%;height:100%;object-fit:cover">
@else
<span style="font-size:28px">📦</span>
@endif

</div>

<div class="kategori-title">
{{ $k->kategori }}
</div>

</a>

@endforeach

</div>


{{-- PRODUK --}}
<main class="container mx-auto px-4 py-12">

<h3 class="text-2xl font-bold mb-8">
Produk Terbaru
</h3>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

@forelse ($produk as $item)

<div class="product-card">

<img
src="{{ $item->gambar ? asset($item->gambar->gambar) : 'https://via.placeholder.com/300x200' }}"
class="product-img">

<div class="p-4">

<h4 class="font-semibold text-lg">
{{ $item->nama_produk }}
</h4>

<p class="text-gray-500 dark:text-gray-400 mt-1">
Rp {{ number_format($item->harga->harga ?? 0,0,',','.') }}
</p>

<a href="{{ route('produk.show',$item->id) }}">

<button class="product-btn">
Lihat Barang
</button>

</a>

</div>

</div>

@empty

<p class="text-gray-500">
Tidak ada produk tersedia
</p>

@endforelse

</div>

</main>


<x-chat/>
<x-footersite/>


<script>

let bIndex = 0

const track = document.getElementById("bannerTrack")
const dots = document.querySelectorAll(".dot")
const total = track.children.length

function updateBanner(){

track.style.transform =
`translateX(-${bIndex*100}%)`

dots.forEach((d,i)=>
d.classList.toggle("active",i===bIndex)
)

}

function nextBanner(){
bIndex = (bIndex+1)%total
updateBanner()
}

function prevBanner(){
bIndex = (bIndex-1+total)%total
updateBanner()
}

function goToBanner(i){
bIndex=i
updateBanner()
}

setInterval(nextBanner,4000)

</script>