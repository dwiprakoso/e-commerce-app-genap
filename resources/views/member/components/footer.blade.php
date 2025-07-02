<!-- Footer -->
<footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <i class="fas fa-mountain text-blue-400 text-2xl"></i>
                    <span class="text-xl font-bold">Wisata Nusantara</span>
                </div>
                <p class="text-gray-400">
                    Menjelajahi keindahan Indonesia dengan pengalaman wisata yang tak terlupakan
                </p>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Menu</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('member.home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('member.paket-wisata.index') }}" class="hover:text-white transition">Paket
                            Wisata</a></li>
                    <li><a href="{{ route('member.galeri.index') }}" class="hover:text-white transition">Galeri</a></li>
                    <li><a href="{{ route('member.berita.index') }}" class="hover:text-white transition">Berita</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><i class="fas fa-phone mr-2"></i> +62 123 456 789</li>
                    <li><i class="fas fa-envelope mr-2"></i> info@wisatanusantara.com</li>
                    <li><i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia</li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Ikuti Kami</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2025 Wisata Nusantara. All rights reserved.</p>
        </div>
    </div>
</footer>
