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
                <a href="{{ route('member.paket-wisata.index') }}"
                    class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Lihat Paket Wisata
                </a>
                <a href="{{ route('member.galeri.index') }}"
                    class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                    Lihat Galeri
                </a>
            </div>
        </div>
    </section>


    <!-- Berita Terbaru Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Berita & Artikel Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Update terbaru seputar dunia pariwisata</p>
            </div>

            @if ($berita->count() > 0)
                <div class="grid md:grid-cols-3 gap-8 mb-8">
                    @foreach ($berita as $item)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                            @if ($item->image_url)
                                <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->title }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ $item->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                                <a href="{{ route('member.berita.show', $item->id) }}"
                                    class="text-blue-600 font-medium hover:text-blue-800 transition inline-flex items-center">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1 text-sm"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Belum ada berita tersedia</p>
                </div>
            @endif

            <div class="text-center">
                <a href="{{ route('member.berita.index') }}"
                    class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Video Wisata Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Saksikan keindahan destinasi melalui video</p>
            </div>

            @if ($videos->count() > 0)
                <div class="grid md:grid-cols-3 gap-8 mb-8">
                    @foreach ($videos as $video)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                            <div class="relative group cursor-pointer">
                                <div class="relative">
                                    <div class="h-48 bg-gradient-to-r from-red-400 to-purple-500 relative overflow-hidden">
                                        @if (str_contains($video->url, 'youtube.com') || str_contains($video->url, 'youtu.be'))
                                            @php
                                                $videoId = '';
                                                // YouTube watch URL
                                                if (str_contains($video->url, 'youtube.com/watch?v=')) {
                                                    parse_str(parse_url($video->url, PHP_URL_QUERY), $params);
                                                    $videoId = $params['v'] ?? '';
                                                }
                                                // YouTube short URL
                                                elseif (str_contains($video->url, 'youtu.be/')) {
                                                    $videoId = basename(parse_url($video->url, PHP_URL_PATH));
                                                }
                                                // YouTube embed URL
                                                elseif (str_contains($video->url, 'youtube.com/embed/')) {
                                                    $videoId = basename(parse_url($video->url, PHP_URL_PATH));
                                                }
                                            @endphp

                                            @if ($videoId)
                                                <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                                    alt="{{ $video->title }}" class="w-full h-full object-cover"
                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <!-- Fallback jika thumbnail gagal load -->
                                                <div class="absolute inset-0 flex items-center justify-center"
                                                    style="display: none;">
                                                    <i class="fas fa-play-circle text-white text-6xl opacity-50"></i>
                                                </div>
                                            @else
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <i class="fas fa-play-circle text-white text-6xl opacity-50"></i>
                                                </div>
                                            @endif
                                        @else
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <i class="fas fa-play-circle text-white text-6xl opacity-50"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">
                                    <i class="fas fa-video mr-1"></i>
                                    Video Wisata
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ $video->title }}</h3>
                                @if ($video->description)
                                    <p class="text-gray-600 mb-4">{{ Str::limit($video->description, 100) }}</p>
                                @endif
                                <a href="{{ route('member.video.show', $video->id) }}"
                                    class="text-purple-600 font-medium hover:text-purple-800 transition inline-flex items-center">
                                    Tonton Video </i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Belum ada video tersedia</p>
                </div>
            @endif

            <div class="text-center">
                <a href="{{ route('member.video.index') }}"
                    class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
                    Lihat Semua Video
                </a>
            </div>
        </div>
    </section>

    <!-- Gallery Preview Section -->
    <section id="gallery" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Galeri Foto</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Koleksi foto-foto indah dari berbagai destinasi</p>
            </div>

            @if ($galleries->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                    @foreach ($galleries->take(6) as $gallery)
                        <div class="relative group overflow-hidden rounded-lg shadow-lg">
                            <img src="{{ asset('storage/' . $gallery->image_url) }}" alt="{{ $gallery->caption }}"
                                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <p class="text-white font-medium">{{ $gallery->caption }}</p>
                                    <p class="text-gray-300 text-sm">{{ $gallery->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Belum ada foto tersedia</p>
                </div>
            @endif

            <div class="text-center">
                <a href="{{ route('member.galeri.index') }}"
                    class="bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-orange-700 transition">
                    Lihat Semua Foto
                </a>
            </div>
        </div>
    </section>
@endsection
