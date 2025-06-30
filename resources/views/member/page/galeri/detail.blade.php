@extends('member.layouts.app')
@section('content')
    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="text-sm">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="{{ route('member.home') }}" class="text-purple-600 hover:text-purple-800">Beranda</a>
                        <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ route('member.gallery.index') }}"
                            class="text-purple-600 hover:text-purple-800">Galeri</a>
                        <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                    </li>
                    <li class="text-gray-500">{{ Str::limit($gallery->caption ?: 'Detail Foto', 50) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Image Detail Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <!-- Main Image -->
                <div class="mb-8">
                    <div class="bg-gray-100 rounded-lg overflow-hidden shadow-lg">
                        @if ($gallery->image_url)
                            <img src="{{ asset('storage/' . $gallery->image_url) }}" alt="{{ $gallery->caption }}"
                                class="w-full h-auto max-h-96 object-contain mx-auto">
                        @else
                            <div class="h-96 flex items-center justify-center bg-gradient-to-r from-purple-400 to-pink-500">
                                <i class="fas fa-image text-white text-6xl opacity-50"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Image Info -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                                {{ $gallery->caption ?: 'Foto Galeri' }}
                            </h1>
                            <div class="space-y-2 text-gray-600">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt mr-3 text-purple-600"></i>
                                    <span>Diunggah:
                                        {{ \Carbon\Carbon::parse($gallery->created_at)->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-3 text-purple-600"></i>
                                    <span>{{ \Carbon\Carbon::parse($gallery->created_at)->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col justify-center space-y-3">
                            <button onclick="downloadImage()"
                                class="bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition">
                                <i class="fas fa-download mr-2"></i>
                                Download Foto
                            </button>
                            <button onclick="shareImage()"
                                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                                <i class="fas fa-share mr-2"></i>
                                Bagikan
                            </button>
                            <a href="{{ route('member.gallery.index') }}"
                                class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition text-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali ke Galeri
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Images -->
    @if ($galleryLainnya->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Foto Lainnya</h2>
                    <p class="text-gray-600">Koleksi foto menarik lainnya di galeri kami</p>
                </div>

                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 max-w-6xl mx-auto">
                    @foreach ($galleryLainnya as $item)
                        <a href="{{ route('member.gallery.show', $item->id) }}" class="group block">
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform group-hover:scale-105">
                                <!-- Image -->
                                <div
                                    class="aspect-square bg-gradient-to-r from-pink-400 to-purple-500 relative overflow-hidden">
                                    @if ($item->image_url)
                                        <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->caption }}"
                                            class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <i class="fas fa-image text-white text-2xl opacity-50"></i>
                                        </div>
                                    @endif

                                    <!-- Overlay -->
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition duration-300 flex items-center justify-center">
                                        <div class="opacity-0 group-hover:opacity-100 transition duration-300">
                                            <i class="fas fa-eye text-white text-xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Caption -->
                                @if ($item->caption)
                                    <div class="p-3">
                                        <p class="text-gray-700 text-xs line-clamp-2">{{ $item->caption }}</p>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Call to Action -->
    <section class="bg-purple-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Suka dengan Foto Ini?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Jelajahi lebih banyak destinasi wisata Indonesia bersama kami
            </p>
            <div class="space-x-4">
                <a href="{{ route('member.paket-wisata.index') }}"
                    class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    <i class="fas fa-map-marked-alt mr-2"></i>
                    Lihat Paket Wisata
                </a>
                <a href="{{ route('member.gallery.index') }}"
                    class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">
                    <i class="fas fa-images mr-2"></i>
                    Galeri Lengkap
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

        .aspect-square {
            aspect-ratio: 1 / 1;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function downloadImage() {
            @if ($gallery->image_url)
                const link = document.createElement('a');
                link.href = '{{ asset('storage/' . $gallery->image_url) }}';
                link.download = '{{ $gallery->caption ?: 'foto-galeri' }}';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            @else
                alert('Foto tidak tersedia untuk diunduh');
            @endif
        }

        function shareImage() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $gallery->caption ?: 'Foto Galeri' }}',
                    text: 'Lihat foto menarik ini dari galeri kami',
                    url: window.location.href
                });
            } else {
                // Fallback: copy URL to clipboard
                navigator.clipboard.writeText(window.location.href).then(function() {
                    alert('Link telah disalin ke clipboard!');
                });
            }
        }
    </script>
@endpush
