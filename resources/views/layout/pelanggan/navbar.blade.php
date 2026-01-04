<!-- Navigasi Atas -->
<header class="bg-white shadow-sm z-10 border-b border-gray-200">
    <div class="flex items-center justify-between h-16 px-4 lg:px-8">
        <!-- Tombol menu mobile & Bar Pencarian -->
        <div class="flex items-center space-x-4 flex-1">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                <i class="fas fa-bars text-gray-600"></i>
            </button>

            <!-- Bar Pencarian -->
            <div class="flex-1 max-w-2xl">
                <form action="{{ route('pelanggan.produk.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari produk bearing..." value="{{ request('search') }}"
                            class="w-full px-4 py-2 pl-10 pr-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                        <button type="submit" class="absolute left-3 top-3 text-gray-400 hover:text-primary-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Ikon Sisi Kanan -->
        <div class="flex items-center space-x-1">
            @auth
                <!-- Tombol Keranjang -->
                @php
                    $cartCount = \App\Models\Keranjang::where('user_id', auth()->id())->count();
                @endphp
                <a href="{{ route('pelanggan.keranjang.index') }}"
                    class="relative p-2 ml-2 rounded-lg hover:bg-gray-100 transition-colors cart-icon">
                    <i class="fas fa-shopping-cart text-gray-600 text-lg"></i>
                    <span class="cart-badge absolute -top-1 -right-1 w-5 h-5 bg-orange-500 text-white text-xs rounded-full flex items-center justify-center font-medium {{ $cartCount > 0 ? '' : 'hidden' }}">
                        {{ $cartCount > 99 ? '99+' : $cartCount }}
                    </span>
                </a>

                <!-- Notifikasi -->
                {{-- <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fas fa-bell text-gray-600 text-lg"></i>
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
                            <div class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-bell-slash text-3xl mb-2"></i>
                                <p class="text-sm">Belum ada notifikasi</p>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Profil Pengguna -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="w-9 h-9 bg-primary-600 rounded-full flex items-center justify-center overflow-hidden">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                            @else
                                <span class="text-white text-sm font-semibold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <span class="hidden md:block text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                    </button>

                    <!-- Dropdown Profil -->
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-200">

                        <div class="px-4 py-3 border-b border-gray-200">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('pelanggan.profil.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user mr-2 text-gray-400"></i>Profil Saya
                        </a>
                        <a href="{{ route('pelanggan.pembelian.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-box mr-2 text-gray-400"></i>Pesanan Saya
                        </a>
                        <div class="border-t border-gray-200 my-2"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Guest: Login & Register -->
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-sm font-medium text-primary-600 hover:text-primary-700 border border-primary-600 rounded-lg hover:bg-primary-50 transition-all">
                    <i class="fas fa-sign-in-alt mr-1"></i>Login
                </a>
                <a href="{{ route('register') }}"
                    class="hidden sm:inline-flex px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 transition-all">
                    <i class="fas fa-user-plus mr-1"></i>Daftar
                </a>
            @endauth
        </div>
    </div>
</header>