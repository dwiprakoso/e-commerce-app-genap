@extends('member.layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-600 to-blue-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Pesan Paket Wisata</h1>
            <p class="text-xl mb-6 max-w-2xl mx-auto">
                Lengkapi data pemesanan Anda untuk {{ $paket->title }}
            </p>
        </div>
    </section>

    <!-- Form Pemesanan -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Detail Paket -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500 relative">
                            @if ($paket->image_url)
                                <img src="{{ asset('storage/' . $paket->image_url) }}" alt="{{ $paket->title }}"
                                    class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i class="fas fa-image text-white text-4xl opacity-50"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $paket->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $paket->description }}</p>

                            <div class="space-y-3">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-calendar-alt mr-3 text-blue-500"></i>
                                    <span>{{ \Carbon\Carbon::parse($paket->start_date)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($paket->end_date)->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-clock mr-3 text-blue-500"></i>
                                    <span>{{ \Carbon\Carbon::parse($paket->start_date)->diffInDays(\Carbon\Carbon::parse($paket->end_date)) + 1 }}
                                        Hari</span>
                                </div>
                                <div class="flex items-center text-lg font-bold text-green-600">
                                    <i class="fas fa-tag mr-3"></i>
                                    <span>Rp {{ number_format($paket->price, 0, ',', '.') }} / orang</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Pemesanan -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Data Pemesanan</h3>

                        <form action="{{ route('member.paket-wisata.store-pesan', $paket->id) }}" method="POST"
                            enctype="multipart/form-data" id="pesanForm">
                            @csrf

                            <!-- Jumlah Orang -->
                            <div class="mb-6">
                                <label for="jumlah_orang" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-users mr-2"></i>Jumlah Orang
                                </label>
                                <input type="number" id="jumlah_orang" name="jumlah_orang"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jumlah_orang') border-red-500 @enderror"
                                    placeholder="Masukkan jumlah orang" value="{{ old('jumlah_orang', 1) }}" min="1"
                                    max="50" oninput="hitungTotal()" onchange="hitungTotal()" onkeyup="hitungTotal()">
                                @error('jumlah_orang')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Total Harga (Auto Calculate) -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calculator mr-2"></i>Total Harga
                                </label>
                                <div class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-lg font-bold text-green-600"
                                    id="totalHarga">
                                    Rp {{ number_format($paket->price, 0, ',', '.') }}
                                </div>
                                <input type="hidden" id="total_harga_hidden" name="total_harga"
                                    value="{{ $paket->price }}">
                            </div>

                            <!-- Bukti Bayar -->
                            <div class="mb-6">
                                <label for="bukti_bayar" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-upload mr-2"></i>Upload Bukti Bayar
                                </label>
                                <input type="file" id="bukti_bayar" name="bukti_bayar" accept="image/*"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bukti_bayar') border-red-500 @enderror"
                                    onchange="validateFile(this)">
                                <p class="text-xs text-gray-500 mt-1">
                                    Format: JPG, PNG, JPEG. Maksimal 2MB
                                </p>
                                @error('bukti_bayar')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Informasi Pembayaran -->
                            <div class="mb-6 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                <h4 class="font-semibold text-blue-800 mb-2">
                                    <i class="fas fa-info-circle mr-2"></i>Informasi Pembayaran
                                </h4>
                                <p class="text-sm text-blue-700">
                                    Silahkan transfer ke rekening: <br>
                                    <strong>Bank BCA: 1234567890</strong><br>
                                    <strong>A.n: PT Wisata Nusantara</strong><br>
                                    Kemudian upload bukti transfer di atas.
                                </p>
                            </div>

                            <!-- Buttons -->
                            <div class="flex space-x-4">
                                <a href="{{ route('member.paket-wisata.show', $paket->id) }}"
                                    class="flex-1 bg-gray-500 text-white py-3 px-4 rounded-lg font-medium hover:bg-gray-600 transition duration-200 text-center">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali
                                </a>
                                <button type="submit"
                                    class="flex-1 bg-green-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-green-700 transition duration-200"
                                    onclick="return validateForm()">
                                    <i class="fas fa-check mr-2"></i>
                                    Pesan Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script langsung di dalam HTML -->
    <script>
        // Global variables
        const HARGA_PER_ORANG = {{ $paket->price }};

        console.log('=== INLINE SCRIPT LOADED ===');
        console.log('Harga per orang:', HARGA_PER_ORANG);

        // Fungsi untuk format rupiah
        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Fungsi untuk menghitung total harga
        function hitungTotal() {
            console.log('=== MENGHITUNG TOTAL ===');

            const inputJumlah = document.getElementById('jumlah_orang');
            const displayTotal = document.getElementById('totalHarga');
            const hiddenTotal = document.getElementById('total_harga_hidden');

            if (!inputJumlah || !displayTotal) {
                console.error('Element tidak ditemukan!');
                return;
            }

            let jumlahOrang = parseInt(inputJumlah.value) || 1;

            // Validasi input
            if (jumlahOrang < 1) {
                jumlahOrang = 1;
                inputJumlah.value = 1;
            }
            if (jumlahOrang > 50) {
                jumlahOrang = 50;
                inputJumlah.value = 50;
            }

            const totalHarga = HARGA_PER_ORANG * jumlahOrang;

            console.log('Jumlah orang:', jumlahOrang);
            console.log('Total harga:', totalHarga);

            // Update display
            displayTotal.textContent = formatRupiah(totalHarga);

            // Update hidden input
            if (hiddenTotal) {
                hiddenTotal.value = totalHarga;
            }

            console.log('Display updated:', displayTotal.textContent);
        }

        // Fungsi validasi file
        function validateFile(input) {
            const file = input.files[0];
            if (!file) return;

            console.log('File selected:', file.name, file.size, file.type);

            // Validasi ukuran (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                input.value = '';
                return;
            }

            // Validasi tipe file
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung! Gunakan JPG, JPEG, atau PNG.');
                input.value = '';
                return;
            }

            console.log('File validation passed!');
        }

        // Fungsi validasi form
        function validateForm() {
            const jumlahOrang = parseInt(document.getElementById('jumlah_orang').value);
            const buktiFile = document.getElementById('bukti_bayar').files[0];

            if (!jumlahOrang || jumlahOrang < 1) {
                alert('Jumlah orang minimal 1!');
                document.getElementById('jumlah_orang').focus();
                return false;
            }

            if (!buktiFile) {
                return confirm('Anda belum upload bukti bayar. Lanjutkan?');
            }

            return true;
        }

        // Hitung total saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded - running initial calculation');
            hitungTotal();
        });

        // Backup: Hitung ulang setelah 1 detik
        setTimeout(function() {
            console.log('Backup calculation after 1 second');
            hitungTotal();
        }, 1000);

        console.log('=== SCRIPT INITIALIZATION COMPLETE ===');
    </script>
@endsection
