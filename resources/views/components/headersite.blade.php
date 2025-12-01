<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Blox Store  | Situs Marketplace Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">

{{-- Navbar --}}
<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img src="{{ asset('uploads/logo.png') }}" alt="Logo E-Blox Store" class="w-16 h-16 object-contain">
            <span class="text-2xl font-extrabold text-blue-600">E-Blox Store</span>
        </a>
        <nav class="hidden md:flex space-x-6 font-medium">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition">Home</a>
            <a href="#produk" class="text-gray-700 hover:text-blue-600 transition">Produk</a>
            <a href="{{ route('filter') }}" class="text-gray-700 hover:text-blue-600 transition">Kategori</a>
{{-- Jika user belum login --}}
@guest
    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Login</a>
    <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
@endguest

{{-- Jika user sudah login --}}
@auth
    <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-600 transition flex items-center space-x-1">
        <i class="fas fa-shopping-cart fa-lg"></i>
    </a>
    <a href="{{ Auth::user()->role_id == 1 ? route('admin.profile.index') : route('profile.index') }}"
        class="text-gray-700 hover:text-blue-600 transition flex items-center space-x-1">
         <i class="fas fa-user fa-lg"></i>
     </a>
         {{-- Tombol Dashboard (Hanya muncul untuk Admin) --}}
    @if (Auth::user()->role_id == 1)
    <a href="{{ route('admin.dashboard') }}"
        class="text-gray-700 hover:text-blue-600 transition flex items-center space-x-1 ml-2">
        <i class="fas fa-tachometer-alt fa-lg"></i>
    </a>
@endif
@endauth

        </nav>
        <button id="menu-toggle" class="md:hidden text-gray-700 hover:text-blue-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
        <nav class="flex flex-col space-y-2 p-4 font-medium">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Home</a>
            <a href="#produk" class="text-gray-700 hover:text-blue-600">Produk</a>
            <a href="{{ route('filter') }}" class="text-gray-700 hover:text-blue-600">Kategori</a>
{{-- Jika user belum login --}}
@guest
    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Login</a>
    <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
@endguest

{{-- Jika user sudah login --}}
@auth
    <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-600 transition flex items-center space-x-1">
        <i class="fas fa-shopping-cart fa-lg"></i>
    </a>
    <a href="{{ route('profile.index') }}" class="text-gray-700 hover:text-blue-600 transition flex items-center space-x-1">
        <i class="fas fa-user fa-lg"></i>
    </a>
@endauth
        </nav>
    </div>
</header>