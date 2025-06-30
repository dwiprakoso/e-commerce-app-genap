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
                        <a href="{{ route('member.berita.index') }}" class="text-blue-600 hover:text-blue-800">Berita</a>
                        <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                    </li>
                    <li class="text-gray-500">{{ Str::limit($berita->title, 50) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Article Header -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $berita->title }}</h1>

                    <!-- Meta Information -->
                    <div class="flex items-center space-x-6 text-gray-500 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($berita->created_at)->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($berita->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="mb-8">
                    <div class="h-96 bg-gradient-to-r from-green-400 to-blue-500 rounded-lg relative overflow-hidden">
                        @if ($berita->image_url)
                            <img src="{{ asset('storage/' . $berita->image_url) }}" alt="{{ $berita->title }}"
                                class="w-full h-full object-cover rounded-lg">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-6xl opacity-50"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Article Content -->
                <div class="prose prose-lg max-w-none">
                    <div class="text-gray-700 leading-relaxed">
                        {!! nl2br(e($berita->content)) !!}
                    </div>
                </div>

                <!-- Share Section -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <a href="{{ route('member.berita.index') }}"
                                class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali ke Berita
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    @if ($beritaLainnya->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Berita Lainnya</h2>
                    <p class="text-gray-600">Artikel menarik lainnya yang mungkin Anda suka</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    @foreach ($beritaLainnya as $item)
                        <article
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                            <!-- Image Placeholder -->
                            <div class="h-48 bg-gradient-to-r from-purple-400 to-pink-500 relative overflow-hidden">
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
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M') }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ $item->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($item->content), 100) }}</p>

                                <!-- Date Info -->
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('member.berita.show', $item->id) }}"
                                    class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded-lg font-medium hover:bg-blue-700 transition duration-200">
                                    Baca Artikel
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Newsletter Section -->
    <section class="bg-blue-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Dapatkan Update Terbaru</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Berlangganan newsletter kami untuk mendapatkan berita dan update terbaru
            </p>
            <div class="max-w-md mx-auto flex">
                <input type="email" placeholder="Masukkan email Anda"
                    class="flex-1 px-4 py-3 rounded-l-lg text-gray-900 focus:outline-none">
                <button class="bg-green-600 text-white px-6 py-3 rounded-r-lg font-semibold hover:bg-green-700 transition">
                    Berlangganan
                </button>
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

        .prose {
            max-width: none;
        }

        .prose p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }
    </style>
@endpush
