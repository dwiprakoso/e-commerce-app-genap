<!-- Navigation -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-2">
                <i class="fas fa-mountain text-blue-600 text-2xl"></i>
                <span class="text-xl font-bold text-gray-800">Wisata Nusantara</span>
            </div>

            <div class="hidden md:flex space-x-6">
                <a href="{{ route('member.home') }}" class="text-gray-700 hover:text-blue-600 transition">Beranda</a>
                <a href="{{ route('member.paket-wisata.index') }}"
                    class="text-gray-700 hover:text-blue-600 transition">Paket Wisata</a>
                <a href="{{ route('member.galeri.index') }}"
                    class="text-gray-700 hover:text-blue-600 transition">Galeri</a>
                <a href="{{ route('member.video.index') }}"
                    class="text-gray-700 hover:text-blue-600 transition">Video</a>
                <a href="{{ route('member.berita.index') }}"
                    class="text-gray-700 hover:text-blue-600 transition">Berita</a>
            </div>

            <div class="flex space-x-3">
                @guest('member')
                    <a href="{{ route('member.login') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Masuk
                    </a>
                    <a href="{{ route('member.register') }}"
                        class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition">
                        Daftar
                    </a>
                @else
                    <div class="relative">
                        <!-- Dropdown Button -->
                        <button id="userDropdown"
                            class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition focus:outline-none">
                            <span>Halo, {{ Auth::guard('member')->user()->name }}!</span>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdownMenu"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50 hidden">
                            <div class="py-2">
                                <a href="{{ route('member.pesanan') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i class="fas fa-shopping-bag mr-2"></i>
                                    Pesanan Saya
                                </a>
                                <a href="{{ route('member.profile') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i class="fas fa-user mr-2"></i>
                                    Profil Saya
                                </a>
                                <hr class="my-2">
                                <form action="{{ route('member.logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Toggle dropdown
                        document.getElementById('userDropdown').addEventListener('click', function(e) {
                            e.stopPropagation();
                            const dropdown = document.getElementById('dropdownMenu');
                            dropdown.classList.toggle('hidden');
                        });

                        // Close dropdown when clicking outside
                        document.addEventListener('click', function(e) {
                            const dropdown = document.getElementById('dropdownMenu');
                            const button = document.getElementById('userDropdown');

                            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                                dropdown.classList.add('hidden');
                            }
                        });

                        // Close dropdown when pressing Escape
                        document.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape') {
                                document.getElementById('dropdownMenu').classList.add('hidden');
                            }
                        });
                    </script>
                @endguest
            </div>
        </div>
    </div>
</nav>
