@extends('member.layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-purple-600 to-pink-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Galeri Foto</h1>
            <p class="text-xl mb-6 max-w-2xl mx-auto">
                Koleksi foto-foto indah dari berbagai destinasi wisata di Indonesia
            </p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            @if ($galleries->count() > 0)
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($galleries as $item)
                        <div class="group cursor-pointer" onclick="openModal('{{ $item->id }}')">
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform group-hover:scale-105">
                                <!-- Image -->
                                <div
                                    class="aspect-square bg-gradient-to-r from-purple-400 to-pink-500 relative overflow-hidden">
                                    @if ($item->image_url)
                                        <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->caption }}"
                                            class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <i class="fas fa-image text-white text-4xl opacity-50"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Caption -->
                                @if ($item->caption)
                                    <div class="p-4">
                                        <p class="text-gray-700 text-sm line-clamp-2">{{ $item->caption }}</p>
                                        <p class="text-gray-500 text-xs mt-2">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Lightbox Modal -->
                <div id="lightboxModal"
                    class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4">
                    <div class="relative max-w-4xl max-h-full">
                        <!-- Close Button -->
                        <button onclick="closeModal()"
                            class="absolute -top-10 right-0 text-white text-2xl hover:text-gray-300">
                            <i class="fas fa-times"></i>
                        </button>

                        <!-- Image Container -->
                        <div id="modalImageContainer" class="relative">
                            <img id="modalImage" src="" alt=""
                                class="max-w-full max-h-screen object-contain">

                            <!-- Navigation -->
                            <button onclick="prevImage()"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white text-3xl hover:text-gray-300">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button onclick="nextImage()"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white text-3xl hover:text-gray-300">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        <!-- Caption -->
                        <div id="modalCaption" class="text-white text-center mt-4 px-4"></div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mb-6">
                        <i class="fas fa-images text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">Belum Ada Foto</h3>
                    <p class="text-gray-500 mb-6">
                        @if (request('search'))
                            Tidak ditemukan foto dengan kata kunci "{{ request('search') }}"
                        @else
                            Maaf, saat ini belum ada foto yang tersedia di galeri.
                        @endif
                    </p>
                    @if (request('search'))
                        <a href="{{ route('member.galeri.index') }}"
                            class="bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition">
                            Lihat Semua Foto
                        </a>
                    @else
                        <a href="{{ route('member.home') }}"
                            class="bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition">
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

        .aspect-square {
            aspect-ratio: 1 / 1;
        }
    </style>
@endpush

@push('scripts')
    <script>
        let galleries = @json($galleries);
        let currentIndex = 0;

        function openModal(id) {
            const modal = document.getElementById('lightboxModal');
            const modalImage = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');

            // Find the gallery item
            const gallery = galleries.find(item => item.id == id);
            currentIndex = galleries.findIndex(item => item.id == id);

            if (gallery && gallery.image_url) {
                modalImage.src = '/storage/' + gallery.image_url;
                modalImage.alt = gallery.caption || '';
                modalCaption.textContent = gallery.caption || '';

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal() {
            const modal = document.getElementById('lightboxModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function nextImage() {
            if (currentIndex < galleries.length - 1) {
                currentIndex++;
                const gallery = galleries[currentIndex];
                if (gallery.image_url) {
                    const modalImage = document.getElementById('modalImage');
                    const modalCaption = document.getElementById('modalCaption');

                    modalImage.src = '/storage/' + gallery.image_url;
                    modalImage.alt = gallery.caption || '';
                    modalCaption.textContent = gallery.caption || '';
                }
            }
        }

        function prevImage() {
            if (currentIndex > 0) {
                currentIndex--;
                const gallery = galleries[currentIndex];
                if (gallery.image_url) {
                    const modalImage = document.getElementById('modalImage');
                    const modalCaption = document.getElementById('modalCaption');

                    modalImage.src = '/storage/' + gallery.image_url;
                    modalImage.alt = gallery.caption || '';
                    modalCaption.textContent = gallery.caption || '';
                }
            }
        }

        // Close modal when clicking outside
        document.getElementById('lightboxModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            } else if (e.key === 'ArrowRight') {
                nextImage();
            } else if (e.key === 'ArrowLeft') {
                prevImage();
            }
        });
    </script>
@endpush
