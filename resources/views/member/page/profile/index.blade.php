@extends('member.layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Profile Saya</h1>
            <p class="text-xl mb-6 max-w-2xl mx-auto">
                Informasi akun dan data personal Anda
            </p>
        </div>
    </section>

    <!-- Profile Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-32 bg-gradient-to-r from-blue-400 to-purple-500 relative">
                            <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                                <div
                                    class="w-32 h-32 bg-white rounded-full border-4 border-white overflow-hidden shadow-lg">
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-user text-4xl text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-20 pb-6 px-6 text-center">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $user->name }}</h2>
                            <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                            <div class="flex items-center justify-center text-sm text-gray-500 mb-4">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>Bergabung {{ \Carbon\Carbon::parse($user->created_at)->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Information -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-purple-700 text-white p-6">
                            <h3 class="text-xl font-bold">Informasi Akun</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">ID Member</label>
                                    <div class="bg-gray-50 rounded-lg p-3 border">
                                        <span
                                            class="text-gray-800 font-mono">#{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <div class="bg-gray-50 rounded-lg p-3 border">
                                        <span class="text-gray-800">{{ $user->name }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <div class="bg-gray-50 rounded-lg p-3 border">
                                        <span class="text-gray-800">{{ $user->email }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Bergabung</label>
                                    <div class="bg-gray-50 rounded-lg p-3 border">
                                        <span
                                            class="text-gray-800">{{ \Carbon\Carbon::parse($user->created_at)->format('d F Y, H:i') }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Terakhir Update</label>
                                    <div class="bg-gray-50 rounded-lg p-3 border">
                                        <span
                                            class="text-gray-800">{{ \Carbon\Carbon::parse($user->updated_at)->format('d F Y, H:i') }}</span>
                                    </div>
                                </div>
                                @if ($user->provider)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Login Via</label>
                                        <div class="bg-gray-50 rounded-lg p-3 border">
                                            <span class="text-gray-800 capitalize">{{ $user->provider }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Status -->
                <div class="mt-8">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Status Akun</h3>
                        <div class="grid md:grid-cols-3 gap-4">
                            <div class="text-center p-4 bg-green-50 rounded-lg">
                                <div class="text-2xl text-green-600 mb-2">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h4 class="font-semibold text-green-800">Aktif</h4>
                                <p class="text-sm text-green-600">Akun Terverifikasi</p>
                            </div>
                            <div class="text-center p-4 bg-blue-50 rounded-lg">
                                <div class="text-2xl text-blue-600 mb-2">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <h4 class="font-semibold text-blue-800">Member</h4>
                                <p class="text-sm text-blue-600">Status Keanggotaan</p>
                            </div>
                            <div class="text-center p-4 bg-purple-50 rounded-lg">
                                <div class="text-2xl text-purple-600 mb-2">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4 class="font-semibold text-purple-800">
                                    {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</h4>
                                <p class="text-sm text-purple-600">Bergabung</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 text-center">
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('member.paket-wisata.index') }}"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-map-marked-alt mr-2"></i>
                            Jelajahi Paket Wisata
                        </a>
                        <a href="{{ route('member.home') }}"
                            class="bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition duration-200">
                            <i class="fas fa-home mr-2"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .transition {
            transition: all 0.3s ease;
        }

        .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
@endpush
