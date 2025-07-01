@extends('member.layouts.app')
@section('content')
    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="text-sm">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="{{ route('member.home') }}" class="text-blue-600 hover:text-blue-800">Beranda</a>
                        <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ route('member.paket-wisata.index') }}" class="text-blue-600 hover:text-blue-800">Paket
                            Wisata</a>
                        <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                    </li>
                    <li class="text-gray-500">{{ $paket->title }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Detail Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Image Section -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="h-96 bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg relative overflow-hidden">
                        @if ($paket->image_url)
                            <img src="{{ asset('storage/' . $paket->image_url) }}" alt="{{ $paket->title }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-image text-6xl text-white/50"></i>
                            </div>
                        @endif
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            @if ($paket->status == 'publish')
                                <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Tersedia
                                </span>
                            @else
                                <span class="bg-yellow-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                                    <i class="fas fa-clock mr-1"></i>
                                    Draft
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Detail Information -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $paket->title }}</h1>
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="text-3xl font-bold text-blue-600">
                                Rp {{ number_format($paket->price, 0, ',', '.') }}
                            </div>
                            <div class="text-gray-500">per orang</div>
                        </div>
                    </div>

                    <!-- Info Cards -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <!-- Tanggal -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-alt text-blue-600 mr-3"></i>
                                <span class="font-semibold text-gray-700">Tanggal Keberangkatan</span>
                            </div>
                            <p class="text-gray-600">{{ \Carbon\Carbon::parse($paket->start_date)->format('d M Y') }}</p>
                        </div>

                        <!-- Tanggal Kembali -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-check text-blue-600 mr-3"></i>
                                <span class="font-semibold text-gray-700">Tanggal Kembali</span>
                            </div>
                            <p class="text-gray-600">{{ \Carbon\Carbon::parse($paket->end_date)->format('d M Y') }}</p>
                        </div>

                        <!-- Durasi -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-clock text-blue-600 mr-3"></i>
                                <span class="font-semibold text-gray-700">Durasi</span>
                            </div>
                            <p class="text-gray-600">
                                {{ \Carbon\Carbon::parse($paket->start_date)->diffInDays(\Carbon\Carbon::parse($paket->end_date)) + 1 }}
                                Hari</p>
                        </div>

                        <!-- Status -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                                <span class="font-semibold text-gray-700">Status</span>
                            </div>
                            <p class="text-gray-600 capitalize">{{ $paket->status }}</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi Paket</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $paket->description }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4">
                        <a href="{{ route('member.paket-wisata.pesan', $paket->id) }}"
                            class="flex-1 bg-green-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-green-700 transition duration-200 text-center">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Pesan
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Packages -->
    @if ($paketLainnya->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Paket Wisata Lainnya</h2>
                    <p class="text-gray-600">Pilihan paket wisata menarik lainnya untuk Anda</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach ($paketLainnya as $paketLain)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                            <!-- Image Placeholder -->
                            <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500 relative overflow-hidden">
                                @if ($paketLain->image_url)
                                    <img src="{{ asset('storage/' . $paketLain->image_url) }}"
                                        alt="{{ $paketLain->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-6xl text-white/50"></i>
                                    </div>
                                @endif

                                <!-- Price Badge -->
                                <div class="absolute bottom-4 left-4">
                                    <span class="bg-white text-blue-600 px-3 py-2 rounded-lg font-bold text-lg shadow-md">
                                        Rp {{ number_format($paketLain->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $paketLain->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($paketLain->description, 100) }}
                                </p>

                                <!-- Date Info -->
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>{{ \Carbon\Carbon::parse($paketLain->start_date)->format('d M Y') }}</span>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('member.paket-wisata.show', $paketLain->id) }}"
                                    class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded-lg font-medium hover:bg-blue-700 transition duration-200">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Contact Section -->
    <section class="bg-blue-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Butuh Bantuan?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Tim customer service kami siap membantu Anda 24/7
            </p>
            <div class="space-x-4">
                <a href="#"
                    class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    <i class="fas fa-phone mr-2"></i>
                    Hubungi Kami
                </a>
                <a href="#"
                    class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                    <i class="fas fa-whatsapp mr-2"></i>
                    WhatsApp
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
