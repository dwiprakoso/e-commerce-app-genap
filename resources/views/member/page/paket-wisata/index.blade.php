@extends('member.layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Paket Wisata Terbaik</h1>
            <p class="text-xl mb-6 max-w-2xl mx-auto">
                Pilih paket wisata impian Anda dan nikmati pengalaman tak terlupakan di Indonesia
            </p>
        </div>
    </section>


    <!-- Paket Wisata Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            @if ($paketWisata->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($paketWisata as $paket)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                            <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500 relative overflow-hidden">
                                @if ($paket->image_url)
                                    <img src="{{ asset('storage/' . $paket->image_url) }}" alt="{{ $paket->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-6xl text-white/50"></i>
                                    </div>
                                @endif

                                <!-- Price Badge -->
                                <div class="absolute bottom-4 left-4">
                                    <span class="bg-white text-blue-600 px-3 py-2 rounded-lg font-bold text-lg shadow-md">
                                        Rp {{ number_format($paket->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $paket->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ $paket->description }}</p>

                                <!-- Date Info -->
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>{{ \Carbon\Carbon::parse($paket->start_date)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($paket->end_date)->format('d M Y') }}</span>
                                </div>

                                <!-- Duration -->
                                <div class="flex items-center text-sm text-gray-500 mb-6">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>{{ \Carbon\Carbon::parse($paket->start_date)->diffInDays(\Carbon\Carbon::parse($paket->end_date)) + 1 }}
                                        Hari</span>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex space-x-3">
                                    <a href="{{ route('member.paket-wisata.show', $paket->id) }}"
                                        class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-700 transition duration-200 text-center">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Detail
                                    </a>
                                    <a href="{{ route('member.paket-wisata.pesan', $paket->id) }}"
                                        class="flex-1 bg-green-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-green-700 transition duration-200 text-center">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Pesan
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mb-6">
                        <i class="fas fa-map-marked-alt text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">Belum Ada Paket Wisata</h3>
                    <p class="text-gray-500 mb-6">Maaf, saat ini belum ada paket wisata yang tersedia.</p>
                    <a href="{{ route('member.home') }}"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                        Kembali ke Beranda
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
