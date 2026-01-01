<!-- Navigasi Atas -->
<header class="bg-white shadow-sm z-10 border-b border-gray-200 relative overflow-hidden">

    <div class="flex items-center justify-between h-16 px-4 lg:px-8 relative z-10">
        <!-- Tombol menu mobile & Judul Halaman -->
        <div class="flex items-center space-x-4">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                <i class="fas fa-bars text-gray-600"></i>
            </button>
        </div>

        <!-- Ikon Sisi Kanan -->
        <div class="flex items-center space-x-4">

            <!-- Notifikasi -->
            {{-- <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bell text-gray-600 text-lg"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- Dropdown Notifikasi -->
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-200">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900">Notifikasi</h3>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                            <div class="flex items-start">
                                <div class="shrink-0">
                                    <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-shopping-cart text-primary-600"></i>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm text-gray-900">Pesanan baru dari John Doe</p>
                                    <p class="text-xs text-gray-500 mt-1">2 menit yang lalu</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                            <div class="flex items-start">
                                <div class="shrink-0">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-box text-green-600"></i>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm text-gray-900">Stok produk hampir habis</p>
                                    <p class="text-xs text-gray-500 mt-1">1 jam yang lalu</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                            <div class="flex items-start">
                                <div class="shrink-0">
                                    <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-primary-600"></i>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm text-gray-900">Pelanggan baru terdaftar</p>
                                    <p class="text-xs text-gray-500 mt-1">3 jam yang lalu</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="px-4 py-3 border-t border-gray-200 text-center">
                        <a href="#" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                            Lihat semua notifikasi
                        </a>
                    </div>
                </div>
            </div> --}}

            <!-- Profil Pengguna -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="w-9 h-9 bg-primary-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-semibold">A</span>
                    </div>
                    <div class="hidden md:block text-left">
                        <span class="text-sm font-medium text-gray-700 block">Admin Demo</span>
                        <span class="text-xs text-gray-500">Administrator</span>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </button>

                <!-- Dropdown Profil -->
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-200">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <p class="text-sm font-medium text-gray-900">Admin Demo</p>
                        <p class="text-xs text-gray-500">admin@demo.com</p>
                    </div>
                    <a href="#" onclick="alert('Fitur profil dalam pengembangan'); return false;"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user mr-2 text-gray-400"></i>Profil Saya
                    </a>
                    <a href="#" onclick="alert('Fitur pengaturan dalam pengembangan'); return false;"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2 text-gray-400"></i>Pengaturan
                    </a>
                    <div class="border-t border-gray-200 my-2"></div>
                    <form onsubmit="alert('Fitur logout dalam pengembangan'); return false;">
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>