<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Wisata Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-purple-500 to-blue-600 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <!-- Header -->
        <div class="text-center p-8 pb-4">
            <div class="flex justify-center items-center space-x-2 mb-4">
                <i class="fas fa-mountain text-blue-600 text-3xl"></i>
                <span class="text-2xl font-bold text-gray-800">Wisata Nusantara</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Bergabung Bersama Kami</h2>
            <p class="text-gray-600">Buat akun untuk memulai petualangan Anda</p>
        </div>

        <!-- Form -->
        <div class="px-8 pb-8">
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <div class="flex">
                        <i class="fas fa-exclamation-circle mt-0.5 mr-2"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('member.register') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2"></i>Nama Lengkap
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="Masukkan nama lengkap">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="Masukkan alamat email">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition pr-12"
                            placeholder="Minimal 8 karakter">
                        <button type="button" onclick="togglePassword('password', 'passwordIcon')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <i id="passwordIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="mt-2 text-xs text-gray-500">
                        <div class="flex items-center space-x-4">
                            <div id="length-check" class="flex items-center">
                                <i class="fas fa-times text-red-500 mr-1"></i>
                                <span>Min. 8 karakter</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition pr-12"
                            placeholder="Ulangi password">
                        <button type="button" onclick="togglePassword('password_confirmation', 'confirmPasswordIcon')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <i id="confirmPasswordIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="terms" required
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        Saya menyetujui
                        <a href="#" class="text-blue-600 hover:text-blue-700">Syarat & Ketentuan</a>
                        dan
                        <a href="#" class="text-blue-600 hover:text-blue-700">Kebijakan Privasi</a>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                </button>
            </form>

            <!-- Divider -->
            <div class="mt-8 text-center">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">atau</span>
                    </div>
                </div>
            </div>

            <!-- Login Link -->
            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('member.login') }}"
                        class="text-blue-600 hover:text-blue-700 font-semibold transition">
                        Masuk sekarang
                    </a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="mt-4 text-center">
                <a href="{{ route('member.home') }}" class="text-gray-500 hover:text-gray-700 transition text-sm">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali ke beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const lengthCheck = document.getElementById('length-check');

            if (password.length >= 8) {
                lengthCheck.querySelector('i').className = 'fas fa-check text-green-500 mr-1';
                lengthCheck.querySelector('span').className = 'text-green-500';
            } else {
                lengthCheck.querySelector('i').className = 'fas fa-times text-red-500 mr-1';
                lengthCheck.querySelector('span').className = 'text-red-500';
            }
        });
    </script>
</body>

</html>
