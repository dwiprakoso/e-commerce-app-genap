@extends('member.layouts.app')
@section('content')
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
                <a href="#"
                    class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Lihat Paket Wisata
                </a>
            @endguest
        </div>
    </section>
@endsection
