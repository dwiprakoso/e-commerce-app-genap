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
            <!-- Social Login Buttons -->
            <div class="space-y-3 mb-6">
                <a href="{{ route('member.social.redirect', 'google') }}"
                    class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200 group">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    <span class="text-gray-700 font-medium group-hover:text-gray-900">Daftar dengan Google</span>
                </a>

                <a href="{{ route('member.social.redirect', 'facebook') }}"
                    class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fab fa-facebook-f text-lg mr-3"></i>
                    <span class="font-medium">Daftar dengan Facebook</span>
                </a>
            </div>

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

            <!-- Divider -->
            <div class="mb-6 text-center">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">atau daftar dengan email</span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('member.register.post') }}" class="space-y-6">
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
