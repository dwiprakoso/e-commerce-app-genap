@extends('member.layouts.app')
@section('content')
    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="text-sm">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="{{ route('member.home') }}" class="text-red-600 hover:text-red-800">Beranda</a>
                        <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ route('member.video.index') }}" class="text-red-600 hover:text-red-800">Video</a>
                        <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                    </li>
                    <li class="text-gray-500">{{ Str::limit($video->title, 50) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Video Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Video Header -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $video->title }}</h1>

                    <!-- Meta Information -->
                    <div class="flex items-center space-x-6 text-gray-500 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($video->created_at)->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($video->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Video Player -->
                <div class="mb-8">
                    <div class="relative bg-black rounded-lg overflow-hidden" style="padding-bottom: 56.25%; height: 0;">
                        @if (str_contains($video->url, 'youtube.com') || str_contains($video->url, 'youtu.be'))
                            @php
                                $embedUrl = '';
                                if (str_contains($video->url, 'youtube.com/watch?v=')) {
                                    $videoId = substr($video->url, strpos($video->url, 'v=') + 2);
                                    $videoId = strpos($videoId, '&')
                                        ? substr($videoId, 0, strpos($videoId, '&'))
                                        : $videoId;
                                    $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                } elseif (str_contains($video->url, 'youtu.be/')) {
                                    $videoId = substr($video->url, strpos($video->url, 'youtu.be/') + 9);
                                    $videoId = strpos($videoId, '?')
                                        ? substr($videoId, 0, strpos($videoId, '?'))
                                        : $videoId;
                                    $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                } elseif (str_contains($video->url, 'youtube.com/embed/')) {
                                    $embedUrl = $video->url;
                                }
                            @endphp
                            @if ($embedUrl)
                                <iframe src="{{ $embedUrl }}" class="absolute top-0 left-0 w-full h-full"
                                    frameborder="0" allowfullscreen>
                                </iframe>
                            @else
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                                        <p>Video tidak dapat ditampilkan</p>
                                        <a href="{{ $video->url }}" target="_blank"
                                            class="text-red-400 hover:text-red-300">
                                            Buka di tab baru
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @else
                            <!-- For other video formats -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <i class="fas fa-play-circle text-6xl mb-4"></i>
                                    <p class="mb-4">Klik untuk menonton video</p>
                                    <a href="{{ $video->url }}" target="_blank"
                                        class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition">
                                        Tonton Video
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Share Section -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Bagikan Video</h3>
                            <div class="flex space-x-4">
                                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                    <i class="fab fa-facebook-f mr-2"></i>
                                    Facebook
                                </button>
                                <button class="bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 transition">
                                    <i class="fab fa-twitter mr-2"></i>
                                    Twitter
                                </button>
                                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                    <i class="fab fa-whatsapp mr-2"></i>
                                    WhatsApp
                                </button>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('member.video.index') }}"
                                class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali ke Video
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Videos -->
    @if ($videoLainnya->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Video Lainnya</h2>
                    <p class="text-gray-600">Video menarik lainnya yang mungkin Anda suka</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    @foreach ($videoLainnya as $item)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                            <!-- Video Thumbnail -->
                            <div class="relative">
                                <div class="h-48 bg-gradient-to-r from-purple-400 to-pink-500 relative overflow-hidden">
                                    @if (str_contains($item->url, 'youtube.com') || str_contains($item->url, 'youtu.be'))
                                        @php
                                            $videoId = '';
                                            if (str_contains($item->url, 'youtube.com/watch?v=')) {
                                                $videoId = substr($item->url, strpos($item->url, 'v=') + 2);
                                                $videoId = strpos($videoId, '&')
                                                    ? substr($videoId, 0, strpos($videoId, '&'))
                                                    : $videoId;
                                            } elseif (str_contains($item->url, 'youtu.be/')) {
                                                $videoId = substr($item->url, strpos($item->url, 'youtu.be/') + 9);
                                                $videoId = strpos($videoId, '?')
                                                    ? substr($videoId, 0, strpos($videoId, '?'))
                                                    : $videoId;
                                            }
                                        @endphp
                                        @if ($videoId)
                                            <img src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg"
                                                alt="{{ $item->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <i class="fas fa-play-circle text-white text-4xl opacity-50"></i>
                                            </div>
                                        @endif
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <i class="fas fa-play-circle text-white text-4xl opacity-50"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Play Button Overlay -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="bg-black bg-opacity-50 rounded-full p-3 hover:bg-opacity-70 transition">
                                        <i class="fas fa-play text-white text-xl ml-1"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ $item->title }}</h3>

                                <!-- Date Info -->
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('member.video.show', $item->id) }}"
                                    class="block w-full bg-red-600 text-white text-center py-2 px-4 rounded-lg font-medium hover:bg-red-700 transition duration-200">
                                    Tonton Video
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
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
