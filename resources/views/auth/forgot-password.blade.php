<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bearing Shop') }} - Lupa Password</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Skrip -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-linear-to-br from-primary-50 via-white to-gray-50">
    <div class="min-h-full flex">
        <!-- Sisi Kiri - Gambar/Branding -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-linear-to-br from-primary-600 via-primary-700 to-primary-900 relative overflow-hidden">
            <!-- Elemen Dekoratif -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-20 w-72 h-72 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            </div>

            <!-- Konten -->
            <div class="relative z-10 flex flex-col justify-center px-12 text-white">
                <!-- Logo & Brand -->
                <div class="mb-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center shadow-xl">
                            <i class="fas fa-cog text-primary-600 text-3xl"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold">Bearing Shop</h1>
                            <p class="text-primary-200 text-sm">Premium Quality Bearings</p>
                        </div>
                    </div>
                </div>

                <!-- Fitur -->
                <div class="space-y-6 max-w-md">
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-primary-500 bg-opacity-30 rounded-lg flex items-center justify-center shrink-0">
                            <i class="fas fa-shipping-fast text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-1">Pengiriman Cepat</h3>
                            <p class="text-primary-100 text-sm">Pengiriman ke seluruh Indonesia dengan jaminan aman dan
                                cepat</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-primary-500 bg-opacity-30 rounded-lg flex items-center justify-center shrink-0">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-1">Produk Original</h3>
                            <p class="text-primary-100 text-sm">100% produk bearing original dari brand ternama dunia</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-primary-500 bg-opacity-30 rounded-lg flex items-center justify-center shrink-0">
                            <i class="fas fa-headset text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-1">Customer Support 24/7</h3>
                            <p class="text-primary-100 text-sm">Tim support siap membantu Anda kapan saja</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-primary-500 bg-opacity-30 rounded-lg flex items-center justify-center shrink-0">
                            <i class="fas fa-tags text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-1">Harga Kompetitif</h3>
                            <p class="text-primary-100 text-sm">Dapatkan harga terbaik untuk bearing berkualitas tinggi</p>
                        </div>
                    </div>
                </div>

                <!-- Statistik -->
                <div class="grid grid-cols-3 gap-6 mt-12 pt-12 border-t border-primary-500 border-opacity-30">
                    <div>
                        <div class="text-3xl font-bold mb-1">5000+</div>
                        <div class="text-primary-200 text-sm">Produk Bearing</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-1">10K+</div>
                        <div class="text-primary-200 text-sm">Pelanggan Puas</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-1">24/7</div>
                        <div class="text-primary-200 text-sm">Support</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sisi Kanan - Form -->
        <div class="flex-1 flex flex-col justify-center px-6 py-12 lg:px-20 xl:px-24">
            <!-- Logo Mobile -->
            <div class="lg:hidden mb-8 text-center">
                <div class="inline-flex items-center space-x-3">
                    <div class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-cog text-white text-2xl"></i>
                    </div>
                    <div class="text-left">
                        <h1 class="text-2xl font-bold text-gray-900">Bearing Shop</h1>
                        <p class="text-gray-600 text-xs">Premium Quality Bearings</p>
                    </div>
                </div>
            </div>

            <!-- Konten Form -->
            <div class="mx-auto w-full max-w-md">
                <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-10">
                    <!-- Header -->
                    <div class="mb-8 text-center">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-key text-primary-600 text-2xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Lupa Password?</h2>
                        <p class="text-gray-600 text-sm">
                            Tidak masalah! Masukkan email Anda dan kami akan mengirimkan link untuk reset password.
                        </p>
                    </div>

                    <!-- Form Lupa Password -->
                    <form method="POST" action=" " class="space-y-6">

                        <!-- Alamat Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-envelope mr-2 text-gray-400"></i>Alamat Email
                            </label>
                            <input id="email" type="email" name="email" required autofocus
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                placeholder="Masukkan email terdaftar Anda">
                            <p class="mt-2 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>Kami akan mengirimkan link reset password ke
                                email ini
                            </p>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit"
                            class="w-full bg-primary-600 text-white py-3 rounded-lg font-medium hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Link Reset Password
                        </button>
                    </form>

                    <!-- Instruksi -->
                    <div class="mt-8 p-4 bg-primary-50 border border-primary-100 rounded-lg">
                        <h4 class="text-sm font-semibold text-primary-900 mb-2 flex items-center">
                            <i class="fas fa-lightbulb mr-2"></i>Petunjuk:
                        </h4>
                        <ul class="text-xs text-primary-800 space-y-1.5 ml-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-600 mr-2 mt-0.5"></i>
                                <span>Masukkan email yang terdaftar di akun Anda</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-600 mr-2 mt-0.5"></i>
                                <span>Cek inbox atau folder spam email Anda</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-600 mr-2 mt-0.5"></i>
                                <span>Klik link reset password yang dikirimkan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-600 mr-2 mt-0.5"></i>
                                <span>Buat password baru untuk akun Anda</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Pembatas -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">Atau</span>
                        </div>
                    </div>

                    <!-- Kembali ke Login -->
                    <div class="text-center space-y-3">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center text-sm text-primary-600 hover:text-primary-700 font-medium hover:underline">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke halaman login
                        </a>

                        <p class="text-xs text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="text-primary-600 hover:text-primary-700 font-medium hover:underline ml-1">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>

                    <!-- Bagian Bantuan -->
                    <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                        <p class="text-sm text-gray-600 mb-2">Butuh bantuan?</p>
                        <div class="flex items-center justify-center space-x-4 text-xs">
                            <a href="#" class="text-primary-600 hover:text-primary-700 font-medium flex items-center">
                                <i class="fas fa-envelope mr-1"></i>Email Support
                            </a>
                            <span class="text-gray-300">|</span>
                            <a href="#" class="text-primary-600 hover:text-primary-700 font-medium flex items-center">
                                <i class="fas fa-phone mr-1"></i>Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-gray-600">
                <p>&copy; {{ date('Y') }} Bearing Shop. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>