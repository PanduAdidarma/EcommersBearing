{{--
|--------------------------------------------------------------------------
| Layout Utama Pelanggan
|--------------------------------------------------------------------------
|
| Layout master untuk halaman pelanggan/customer.
| Mencakup struktur HTML dasar, sidebar, navbar, dan footer.
|
| @package resources/views/layout/pelanggan
| @author  Bearing Shop Team
| @version 1.0.0
|
--}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false, sidebarCollapsed: false }"
    class="h-full">

<head>
    {{-- Meta Tags --}}
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- Page Title --}}
    <title>{{ config('app.name', 'Bearing Shop') }} - @yield('title', 'Toko Bearing')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Font Awesome Icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Vite Assets (CSS & JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full bg-gray-50">
    <div class="flex h-full">

        {{-- ========================================
            SIDEBAR SECTION
        ======================================== --}}

        {{-- Sidebar Desktop --}}
        @include('layout.pelanggan.sidebarPelanggan')

        {{-- Sidebar Mobile (Overlay) --}}
        @include('layout.pelanggan.sidebarPelanggan-mobile')

        {{-- ========================================
            MAIN CONTENT SECTION
        ======================================== --}}

        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Navbar --}}
            @include('layout.pelanggan.navbar')

            {{-- Main Content Area --}}
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-4 lg:px-8 py-6">

                    {{-- Breadcrumb Navigation --}}
                    @if (isset($breadcrumbs))
                        <nav class="flex mb-4" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                @foreach ($breadcrumbs as $breadcrumb)
                                    @if ($loop->last)
                                        {{-- Current Page (Non-clickable) --}}
                                        <li aria-current="page">
                                            <div class="flex items-center">
                                                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                                                <span class="text-sm font-medium text-gray-500">{{ $breadcrumb['name'] }}</span>
                                            </div>
                                        </li>
                                    @else
                                        {{-- Parent Pages (Clickable) --}}
                                        <li>
                                            <div class="flex items-center">
                                                @if (!$loop->first)
                                                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                                                @endif
                                                <a href="{{ $breadcrumb['url'] }}"
                                                    class="text-sm font-medium text-gray-700 hover:text-primary-600">
                                                    {{ $breadcrumb['name'] }}
                                                </a>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>
                    @endif

                    {{-- Page Content --}}
                    @yield('content')

                </div>
            </main>

            {{-- ========================================
                FOOTER SECTION
            ======================================== --}}

            <footer class="bg-gray-200 border-t border-gray-200 py-4">
                <div class="container mx-auto px-4 lg:px-8">
                    <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
                        {{-- Copyright --}}
                        <p>&copy; {{ date('Y') }} Bearing Shop. All rights reserved.</p>

                        {{-- Footer Navigation Links --}}
                        <div class="flex space-x-4 mt-2 md:mt-0">
                            <a href="{{ route('pelanggan.tentang-kami') }}" class="hover:text-primary-600">Tentang Kami</a>
                            <a href="{{ route('pelanggan.kontak') }}" class="hover:text-primary-600">Kontak</a>
                            <a href="{{ route('pelanggan.kebijakan-privasi') }}" class="hover:text-primary-600">Kebijakan Privasi</a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    {{-- Additional Scripts Stack --}}
    @stack('scripts')
</body>

</html>