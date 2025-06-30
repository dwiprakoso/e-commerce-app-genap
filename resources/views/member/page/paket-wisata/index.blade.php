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

    <!-- Filter Section -->
    <section class="bg-white py-8 border-b">
        <div class="container mx-auto px-4">
            <form method="GET" action="{{ route('member.paket-wisata.index') }}"
                class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <label class="text-gray-700 font-medium">Filter:</label>
                    <select name="status"
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="publish" {{ request('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Tanggal Mulai">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari paket wisata..."
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-600">{{ $paketWisata->count() }} paket tersedia</span>
                </div>
            </form>
        </div>
    </section>

    <!-- Paket Wisata Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            @if ($paketWisata->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($paketWisata as $paket)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                            <!-- Image Placeholder -->
                            <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500 relative">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i class="fas fa-mountain text-white text-4xl opacity-50"></i>
                                </div>
                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4">
                                    @if ($paket->status == 'publish')
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                            Draft
                                        </span>
                                    @endif
                                </div>

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
                                    @if ($paket->status == 'publish')
                                        <button
                                            class="flex-1 bg-green-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-green-700 transition duration-200">
                                            <i class="fas fa-shopping-cart mr-2"></i>
                                            Pesan
                                        </button>
                                    @else
                                        <button
                                            class="flex-1 bg-gray-400 text-white py-2 px-4 rounded-lg font-medium cursor-not-allowed"
                                            disabled>
                                            <i class="fas fa-ban mr-2"></i>
                                            Draft
                                        </button>
                                    @endif
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
