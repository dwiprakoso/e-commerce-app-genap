@extends('member.layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-purple-600 to-blue-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Pesanan Saya</h1>
            <p class="text-xl mb-6 max-w-2xl mx-auto">
                Kelola dan pantau status pesanan paket wisata Anda
            </p>
        </div>
    </section>

    <!-- Pesanan Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if ($pesanan->count() > 0)
                <div class="space-y-6">
                    @foreach ($pesanan as $pesan)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="md:flex">
                                <!-- Image -->
                                <div class="md:w-1/3 h-48 md:h-auto bg-gradient-to-r from-blue-400 to-purple-500 relative">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $pesan->paketWisata->image_url) }}"
                                            alt="{{ $pesan->paketWisata->image_url }}" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Status Badge -->
                                    <div class="absolute top-4 right-4">
                                        @if ($pesan->status == 'pending')
                                            <span
                                                class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                <i class="fas fa-clock mr-1"></i>Pending
                                            </span>
                                        @elseif ($pesan->status == 'dibatalkan')
                                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                <i class="fas fa-times mr-1"></i>Dibatalkan
                                            </span>
                                        @elseif ($pesan->status == 'selesai')
                                            <span
                                                class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                <i class="fas fa-check mr-1"></i>Selesai
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="md:w-2/3 p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-800 mb-2">
                                                {{ $pesan->paketWisata->title }}
                                            </h3>
                                            <p class="text-gray-600 text-sm mb-3">
                                                ID Pesanan: #{{ str_pad($pesan->id, 6, '0', STR_PAD_LEFT) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Detail Pesanan -->
                                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                                        <div class="space-y-2">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-calendar-alt mr-3 text-blue-500 w-4"></i>
                                                <span>{{ \Carbon\Carbon::parse($pesan->paketWisata->start_date)->format('d M Y') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($pesan->paketWisata->end_date)->format('d M Y') }}</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-users mr-3 text-blue-500 w-4"></i>
                                                <span>{{ $pesan->jumlah_orang }} Orang</span>
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-clock mr-3 text-blue-500 w-4"></i>
                                                <span>Dipesan: {{ $pesan->created_at->format('d M Y H:i') }}</span>
                                            </div>
                                            <div class="flex items-center text-lg font-bold text-green-600">
                                                <i class="fas fa-money-bill-wave mr-3 w-4"></i>
                                                <span>Rp {{ number_format($pesan->total_harga, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bukti Bayar -->
                                    @if ($pesan->bukti_bayar)
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-600 mb-2">
                                                <i class="fas fa-receipt mr-2"></i>Bukti Bayar:
                                            </p>
                                            <a href="{{ asset('storage/' . $pesan->bukti_bayar) }}" target="_blank"
                                                class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fas fa-eye mr-2"></i>
                                                Lihat Bukti Bayar
                                            </a>
                                        </div>
                                    @endif


                                    <!-- Actions -->
                                    <div class="flex space-x-3">
                                        <a href="{{ route('member.paket-wisata.show', $pesan->paketWisata->id) }}"
                                            class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition duration-200">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            Detail Paket
                                        </a>

                                        @if ($pesan->status == 'selesai')
                                            <button
                                                class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition duration-200">
                                                <i class="fas fa-star mr-2"></i>
                                                Beri Ulasan
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mb-6">
                        <i class="fas fa-shopping-cart text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">Belum Ada Pesanan</h3>
                    <p class="text-gray-500 mb-6">Anda belum memiliki pesanan paket wisata.</p>
                    <a href="{{ route('member.paket-wisata.index') }}"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                        <i class="fas fa-search mr-2"></i>
                        Jelajahi Paket Wisata
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
