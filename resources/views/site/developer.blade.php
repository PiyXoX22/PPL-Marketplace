<x-headersite />

<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-8 text-center">Tim Pengembang — E-Blox Store</h1>

    <p class="text-gray-700 text-center max-w-2xl mx-auto mb-10">
        Tim pengembang E-Blox Store terdiri dari individu profesional yang berpengalaman di bidang teknologi
        dan pengembangan aplikasi web. Berikut adalah orang-orang hebat yang berada di balik platform ini:
    </p>

    <!-- Grid Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Card 1 -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200">
            <img src="{{ asset('uploads/dev/ilham.jpg') }}"
                 class="w-24 h-24 mx-auto mb-4 rounded-full object-cover" alt="Ilham Andika Putra">
            <h3 class="text-lg font-semibold">Ilham Andika Putra</h3>
            <p class="text-gray-500 text-sm mb-3">Full Stack Developer</p>
            <p class="text-gray-600 text-sm">
                Fokus pada perancangan sistem, pengembangan fitur utama, API, serta keamanan dan performa server.
            </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200">
            <img src="{{ asset('uploads/dev/izza.jpg') }}"
                 class="w-24 h-24 mx-auto mb-4 rounded-full object-cover" alt="Izza Arya Wibowo">
            <h3 class="text-lg font-semibold">Izza Arya Wibowo</h3>
            <p class="text-gray-500 text-sm mb-3">Back End Developer</p>
            <p class="text-gray-600 text-sm">
                Fokus dalam pengelolaan database dan arsitektur sistem serta skalabilitas sistem.
            </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200">
            <img src="{{ asset('uploads/dev/ammar.jpg') }}"
                 class="w-24 h-24 mx-auto mb-4 rounded-full object-cover" alt="Ammar Syauqi Firdaus">
            <h3 class="text-lg font-semibold">Ammar Syauqi Firdaus</h3>
            <p class="text-gray-500 text-sm mb-3">Front End Developer</p>
            <p class="text-gray-600 text-sm">
                Mengembangkan tampilan antarmuka, desain responsif, dan memastikan pengalaman pengguna yang optimal.
            </p>
        </div>

    </div>
</div>

<x-footersite />
