<!-- Navigation -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-2">
                <i class="fas fa-mountain text-blue-600 text-2xl"></i>
                <span class="text-xl font-bold text-gray-800">Wisata Nusantara</span>
            </div>

            <div class="hidden md:flex space-x-6">
                <a href="#home" class="text-gray-700 hover:text-blue-600 transition">Beranda</a>
                <a href="{{ route('member.paket-wisata.index') }}"
                    class="text-gray-700 hover:text-blue-600 transition">Paket Wisata</a>
                <a href="#gallery" class="text-gray-700 hover:text-blue-600 transition">Galeri</a>
                <a href="#berita" class="text-gray-700 hover:text-blue-600 transition">Berita</a>
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
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-700">Halo, {{ Auth::guard('member')->user()->name }}!</span>
                        <a href="{{ route('member.home') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Dashboard
                        </a>
                        <form action="{{ route('member.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-600 transition">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
