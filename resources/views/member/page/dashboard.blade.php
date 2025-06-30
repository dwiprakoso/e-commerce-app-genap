<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Nusantara - Jelajahi Keindahan Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-mountain text-blue-600 text-2xl"></i>
                    <span class="text-xl font-bold text-gray-800">Wisata Nusantara</span>
                </div>

                <div class="hidden md:flex space-x-6">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 transition">Beranda</a>
                    <a href="#paket" class="text-gray-700 hover:text-blue-600 transition">Paket Wisata</a>
                    <a href="#gallery" class="text-gray-700 hover:text-blue-600 transition">Galeri</a>
                    <a href="#berita" class="text-gray-700 hover:text-blue-600 transition">Berita</a>
                </div>

                <div class="flex space-x-3">
                    @guest('member')
                        <a href="{{ route('member.login') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Masuk
                        </a>
                        <a href="{{ route('member.register') }}"
                            class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition">
                            Daftar
                        </a>
                    @else
                        <div class="flex items-center space-x-3">
                            <span class="text-gray-700">Halo, {{ Auth::guard('member')->user()->name }}!</span>
                            <a href="{{ route('member.dashboard') }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Dashboard
                            </a>
                            <form action="{{ route('member.logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-red-600 transition">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">Jelajahi Keindahan Indonesia</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Temukan destinasi wisata terbaik di Nusantara dengan paket wisata yang menarik dan terpercaya
            </p>
            <div class="space-x-4">
                <a href="#paket"
                    class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Lihat Paket Wisata
                </a>
                <a href="#gallery"
                    class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                    Lihat Galeri
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Mengapa Memilih Kami?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan layanan terbaik untuk pengalaman wisata yang tak terlupakan
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-lg border hover:shadow-lg transition">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marked-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Destinasi Terpilih</h3>
                    <p class="text-gray-600">Destinasi wisata pilihan terbaik di seluruh Indonesia dengan pemandangan
                        yang menakjubkan</p>
                </div>

                <div class="text-center p-6 rounded-lg border hover:shadow-lg transition">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Pemandu Berpengalaman</h3>
                    <p class="text-gray-600">Tim pemandu wisata profesional dan berpengalaman untuk memberikan
                        pengalaman terbaik</p>
                </div>

                <div class="text-center p-6 rounded-lg border hover:shadow-lg transition">
                    <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-yellow-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Pelayanan Terbaik</h3>
                    <p class="text-gray-600">Layanan 24/7 dengan kepuasan pelanggan sebagai prioritas utama kami</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Siap Memulai Petualangan?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan wisatawan yang telah mempercayai kami untuk pengalaman wisata terbaik
            </p>
            @guest('member')
                <a href="{{ route('member.register') }}"
                    class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Daftar Sekarang
                </a>
            @else
                <a href="{{ route('member.dashboard') }}"
                    class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Lihat Paket Wisata
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-mountain text-blue-400 text-2xl"></i>
                        <span class="text-xl font-bold">Wisata Nusantara</span>
                    </div>
                    <p class="text-gray-400">
                        Menjelajahi keindahan Indonesia dengan pengalaman wisata yang tak terlupakan
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Menu</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#home" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#paket" class="hover:text-white transition">Paket Wisata</a></li>
                        <li><a href="#gallery" class="hover:text-white transition">Galeri</a></li>
                        <li><a href="#berita" class="hover:text-white transition">Berita</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-phone mr-2"></i> +62 123 456 789</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@wisatanusantara.com</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Wisata Nusantara. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
