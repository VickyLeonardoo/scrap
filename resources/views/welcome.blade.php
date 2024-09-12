<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScrapeToko - Solusi Scraping Tokopedia Terbaik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-red-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                    </svg>
                    ScrapeToko
                </a>
                <div>
                    @guest
                        <a href="{{ route('login') }}" class="bg-red-600 text-white px-4 py-2 rounded-full hover:bg-red-700 transition duration-300">
                            Masuk
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-red-600 hover:text-red-700 transition duration-300">
                            Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-red-600 text-white relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://plus.unsplash.com/premium_photo-1687463804174-c74e82681ac9?q=80&w=2532&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Background" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="container mx-auto px-4 py-24 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        Scraping Toko <span class="text-yellow-300">Mudah</span> dan <span class="text-yellow-300">Efisien</span>
                    </h1>
                    <p class="text-xl mb-8">
                        Otomatisasi pengumpulan data produk dari Tokopedia untuk analisis yang lebih cepat dan akurat.
                    </p>
                    <a href="{{ route('login') }}" class="bg-white text-red-600 px-8 py-3 rounded-full text-lg font-semibold hover:bg-yellow-300 transition duration-300 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Mulai Sekarang
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-16 text-center text-gray-800">Fitur Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="bg-red-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Scraping Cepat</h3>
                    <p class="text-gray-600">Kumpulkan data produk dari Tokopedia dengan kecepatan tinggi.</p>
                </div>
                <div class="bg-red-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Analisis Data</h3>
                    <p class="text-gray-600">Dapatkan insight berharga dari data yang telah dikumpulkan.</p>
                </div>
                <div class="bg-red-50 p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Kustomisasi</h3>
                    <p class="text-gray-600">Sesuaikan parameter scraping sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between items-center">
                <div class="w-full md:w-1/3 mb-8 md:mb-0">
                    <h3 class="text-2xl font-bold mb-4">ScrapeToko</h3>
                    <p class="text-gray-400">Solusi scraping terbaik untuk Tokopedia</p>
                </div>
                <div class="w-full md:w-1/3 mb-8 md:mb-0">
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Layanan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Kontak</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/3">
                    <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                    <p class="text-gray-400 mb-2">Email: info@scrapetoko.com</p>
                    <p class="text-gray-400">Telepon: (021) 1234-5678</p>
                </div>
            </div>
            <hr class="border-gray-700 my-8">
            <p class="text-center text-gray-400">&copy; 2024 ScrapeToko. Hak cipta dilindungi undang-undang.</p>
        </div>
    </footer>
</body>
</html>