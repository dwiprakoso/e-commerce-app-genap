@extends('member.layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-red-600 to-purple-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Video Wisata</h1>
            <p class="text-xl mb-6 max-w-2xl mx-auto">
                Nikmati pengalaman visual perjalanan wisata melalui koleksi video terbaik kami
            </p>
        </div>
    </section>

    <!-- Video Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            @if ($videos->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($videos as $video)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                            <!-- Video Thumbnail -->
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

                                <!-- Play Button Overlay -->
                                {{-- <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="bg-black bg-opacity-50 rounded-full p-4 hover:bg-opacity-70 transition">
                                        <i class="fas fa-play text-white text-2xl ml-1"></i>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ $video->title }}</h3>

                                <!-- Meta Info -->
                                <div class="flex items-center text-sm text-gray-500 mb-6">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>{{ \Carbon\Carbon::parse($video->created_at)->format('d M Y') }}</span>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('member.video.show', $video->id) }}"
                                    class="block w-full bg-red-600 text-white text-center py-2 px-4 rounded-lg font-medium hover:bg-red-700 transition duration-200">
                                    <i class="fas fa-play mr-2"></i>
                                    Tonton Video
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mb-6">
                        <i class="fas fa-video text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">Belum Ada Video</h3>
                    <p class="text-gray-500 mb-6">
                        @if (request('search'))
                            Tidak ditemukan video dengan kata kunci "{{ request('search') }}"
                        @else
                            Maaf, saat ini belum ada video yang tersedia.
                        @endif
                    </p>
                    @if (request('search'))
                        <a href="{{ route('member.video.index') }}"
                            class="bg-red-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-700 transition">
                            Lihat Semua Video
                        </a>
                    @else
                        <a href="{{ route('member.home') }}"
                            class="bg-red-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-700 transition">
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
    </style>
@endpush
