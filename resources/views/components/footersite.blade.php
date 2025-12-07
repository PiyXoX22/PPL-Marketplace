<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="container mx-auto px-4 text-center">

        <p class="mb-4">&copy; {{ date('Y') }} E-Blox Store. Hak Cipta Dilindungi.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mt-6">

            {{-- KIRI: Metode Pembayaran + Jelajahi Kami + Lokasi Kami --}}
            <div>
                <h3 class="font-semibold text-lg mb-2">Metode Pembayaran</h3>
                <div class="flex justify-center gap-4">
                    <img src="https://1000logos.net/wp-content/uploads/2017/06/VISA-Logo-2006.png" class="h-8">
                    <img src="https://w7.pngwing.com/pngs/169/96/png-transparent-logo-mastercard-graphics-font-visa-mastercard-text-label-logo.png" class="h-8">
                    <img src="https://www.vectorlogo.zone/logos/paypal/paypal-icon.svg" class="h-6">
                    <img src="https://i.pinimg.com/474x/06/bd/ea/06bdea70eb048176056881cad078453a.jpg" class="h-8">
                    <img src="https://i.pinimg.com/1200x/02/2e/98/022e9877180fdc3ef50f973e7620547d.jpg" class="h-8">
                </div>

                <h3 class="font-semibold text-lg mt-6 mb-2">Jelajahi Kami</h3>
                <a href="/about" class="hover:underline block">Tentang Kami</a>
                <a href="/privacy" class="hover:underline block">Kebijakan Dan Privasi</a>
                <a href="/developer" class="hover:underline block">Tim Pengembang</a>
                <a href="/blog" class="hover:underline block">Blog</a>

                {{-- Lokasi Kami --}}
                <h3 class="font-semibold text-lg mt-6 mb-2">Lokasi Kami</h3>
                <p class="text-gray-300">
                    Yogyakarta, Indonesia
                    <div class="mt-4 ml-20">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d790.9419351095371!2d110.3703977!3d-7.822984699999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57a69855edb3%3A0x41eb9794274b2092!2sSTMIK%20EL%20RAHMA!5e1!3m2!1sid!2sid!4v1732172789995!5m2!1sid!2sid"
                            width="50%"
                            height="150"
                            style="border:0; border-radius: 8px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </p>

            </div>

            {{-- KANAN: Jasa Pengiriman + Sosial Media + QR Download --}}
            <div>
                <h3 class="font-semibold text-lg mb-2">Jasa Pengiriman</h3>
                <div class="flex justify-center gap-4">
                    <img src="https://p7.hiclipart.com/preview/963/726/406/jne-margonda-jalur-nugraha-ekakurir-business-jne-bale-endah-courier-business.jpg" class="h-8">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUde2rd0WVTmwMAf-PJk-BrxsOdz-DzQCaGw&s" class="h-8">
                    <img src="https://1000logos.net/wp-content/uploads/2022/08/JT-Express-Logo.png" class="h-8">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtsKUl2eXFCxNAra3HPdvMZuItRBg7vksbUQ&s" class="h-8">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhyQDuujSmDAkPW3GoCII4rd9zIq7bC-BD1RB4xOVdj-HGXQCaxnJdI63n6YbsTYpE9QxQ5EsWWCSrotHoxGXBqOXfEbjHGMaflvceUxue7jqH9rRl6evQSoXn2dYPBH8VHmrwqo_TsKCC7odhZkIXn9F6D7FWSE0cqhXJIwAyvR6a6RijBepjAfbJR/s320/GKL24_GoSend%20-%20Koleksilogo.com.jpg" class="h-8">
                </div>

                {{-- Social Media --}}
                <h3 class="font-semibold text-lg mt-6 mb-2">Sosial Media</h3>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
                <div class="flex justify-center gap-6 text-4xl">
                    <a href="https://facebook.com" class="text-blue-400"><i class="bi bi-facebook"></i></a>
                    <a href="https://instagram.com" class="text-pink-500"><i class="bi bi-instagram"></i></a>
                    <a href="https://twitter.com" class="text-sky-400"><i class="bi bi-twitter"></i></a>
                    <a href="https://youtube.com" class="text-red-500"><i class="bi bi-youtube"></i></a>
                </div>

                {{-- QR Download App --}}
                <h3 class="font-semibold text-lg mt-6 mb-2">Download Aplikasi E-Blox Store</h3>
                <img
                    src="https://qr.scanned.page/uploads/qr_codes/0SLj6V.svg?1763658253"
                    class="h-40 mx-auto mt-2"
                >
            </div>

        </div>
    </div>
</footer>