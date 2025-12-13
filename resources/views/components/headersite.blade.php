<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Blox Store | Situs Marketplace Indonesia</title>

    <!-- INIT THEME (WAJIB PALING ATAS) -->
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 transition-colors duration-300">

<header class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50 transition-colors">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img src="{{ asset('uploads/logo.png') }}" class="w-16 h-16 object-contain">
            <span class="text-2xl font-extrabold text-blue-600 dark:text-blue-400">
                E-Blox Store
            </span>
        </a>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex space-x-6 font-medium items-center">

            <a href="{{ route('home') }}"
               class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition">
               Home
            </a>

            <a href="#produk"
               class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition">
               Produk
            </a>

            <a href="{{ route('filter') }}"
               class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition">
               Kategori
            </a>

            @guest
                <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition">Register</a>
            @endguest

            @auth
                <a href="{{ route('cart.index') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <a href="{{ Auth::user()->role_id == 1 ? route('admin.profile.index') : route('profile.index') }}"
                   class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition">
                    <i class="fas fa-user"></i>
                </a>

                @if (Auth::user()->role_id == 1)
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition">
                        <i class="fas fa-tachometer-alt"></i>
                    </a>
                @endif
            @endauth

            <!-- Dark Toggle -->
            <button id="themeToggle" class="ml-4 text-xl">
                <i id="themeIcon" class="fas fa-moon"></i>
            </button>
        </nav>

        <!-- Mobile Button -->
        <button id="menuToggle" class="md:hidden text-xl">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t">
        <nav class="flex flex-col space-y-3 p-4">

            <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-200">Home</a>
            <a href="#produk" class="text-gray-700 dark:text-gray-200">Produk</a>
            <a href="{{ route('filter') }}" class="text-gray-700 dark:text-gray-200">Kategori</a>

            <button id="themeToggleMobile" class="text-left text-gray-700 dark:text-gray-200">
                <i class="fas fa-moon mr-2"></i> Dark Mode
            </button>
        </nav>
    </div>
</header>

<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const html = document.documentElement;
    const toggle = document.getElementById('themeToggle');
    const toggleMobile = document.getElementById('themeToggleMobile');
    const icon = document.getElementById('themeIcon');
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    function applyTheme(isDark) {
        html.classList.toggle('dark', isDark);
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
    }

    // Init
    applyTheme(localStorage.getItem('theme') === 'dark');

    toggle.addEventListener('click', () => {
        applyTheme(!html.classList.contains('dark'));
    });

    if (toggleMobile) {
        toggleMobile.addEventListener('click', () => {
            applyTheme(!html.classList.contains('dark'));
        });
    }

    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
});
</script>

</body>
</html>
