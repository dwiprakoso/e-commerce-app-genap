@extends('member.layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-600 to-blue-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Berita Terkini</h1>
            <p class="text-xl mb-6 max-w-2xl mx-auto">
                Ikuti berita dan update terbaru seputar dunia pariwisata Indonesia
            </p>
        </div>
    </section>
    <!-- Berita Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            @if ($berita->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($berita as $item)
                        <article
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                            <!-- Image Placeholder -->
                            <div class="h-48 bg-gradient-to-r from-green-400 to-blue-500 relative overflow-hidden">
                                @if ($item->image_url)
                                    <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i class="fas fa-newspaper text-white text-4xl opacity-50"></i>
                                    </div>
                                @endif
                                <!-- Date Badge -->
                                <div class="absolute bottom-4 left-4">
                                    <span class="bg-white text-blue-600 px-3 py-2 rounded-lg font-bold text-sm shadow-md">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ $item->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($item->content), 150) }}
                                </p>

                                <!-- Meta Info -->
                                <div class="flex items-center text-sm text-gray-500 mb-6">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('member.berita.show', $item->id) }}"
                                    class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded-lg font-medium hover:bg-blue-700 transition duration-200">
                                    <i class="fas fa-eye mr-2"></i>
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mb-6">
                        <i class="fas fa-newspaper text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">Belum Ada Berita</h3>
                    <p class="text-gray-500 mb-6">
                        @if (request('search'))
                            Tidak ditemukan berita dengan kata kunci "{{ request('search') }}"
                        @else
                            Maaf, saat ini belum ada berita yang tersedia.
                        @endif
                    </p>
                    @if (request('search'))
                        <a href="{{ route('member.berita.index') }}"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                            Lihat Semua Berita
                        </a>
                    @else
                        <a href="{{ route('member.home') }}"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                            Kembali ke Beranda
                        </a>
                    @endif
                </div>
            @endif
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

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
