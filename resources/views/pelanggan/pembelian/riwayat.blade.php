@extends('layout.pelanggan.app')

@section('title', 'Riwayat Pembelian - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-primary-700 to-primary-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Riwayat Pembelian</h1>
                <p class="text-primary-100">Lihat dan kelola pesanan Anda</p>
            </div>
            <div class="hidden md:block">
                <div class="w-18 h-18 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-history text-primary-800 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages menggunakan komponen -->
    @if (session('success'))
        @include('pelanggan.component.alert', ['type' => 'success', 'slot' => session('success')])
    @endif

    @if (session('error'))
        @include('pelanggan.component.alert', ['type' => 'error', 'slot' => session('error')])
    @endif

    <!-- Filter Tabs -->
    <div class="bg-white rounded-xl shadow-md mb-6">
        <div class="flex overflow-x-auto">
            <a href="{{ route('pelanggan.pembelian.index') }}"
                class="flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 {{ !request('status') ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 hover:bg-gray-50' }} transition-all">
                Semua
            </a>
            <a href="{{ route('pelanggan.pembelian.index', ['status' => 'pending']) }}"
                class="flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 {{ request('status') == 'pending' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 hover:bg-gray-50' }} transition-all">
                Menunggu
            </a>
            <a href="{{ route('pelanggan.pembelian.index', ['status' => 'paid']) }}"
                class="flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 {{ request('status') == 'paid' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 hover:bg-gray-50' }} transition-all">
                Dibayar
            </a>
            <a href="{{ route('pelanggan.pembelian.index', ['status' => 'processing']) }}"
                class="flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 {{ request('status') == 'processing' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 hover:bg-gray-50' }} transition-all">
                Diproses
            </a>
            <a href="{{ route('pelanggan.pembelian.index', ['status' => 'shipped']) }}"
                class="flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 {{ request('status') == 'shipped' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 hover:bg-gray-50' }} transition-all">
                Dikirim
            </a>
            <a href="{{ route('pelanggan.pembelian.index', ['status' => 'delivered']) }}"
                class="flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 {{ request('status') == 'delivered' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 hover:bg-gray-50' }} transition-all">
                Selesai
            </a>
            <a href="{{ route('pelanggan.pembelian.index', ['status' => 'cancelled']) }}"
                class="flex-1 min-w-[120px] px-6 py-4 font-semibold text-center border-b-2 {{ request('status') == 'cancelled' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 hover:bg-gray-50' }} transition-all">
                Dibatalkan
            </a>
        </div>
    </div>

    <!-- Daftar Pesanan -->
    @if ($orders->count() > 0)
        <div class="space-y-4">
            @foreach ($orders as $order)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all">
                    <!-- Header Pesanan -->
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center space-x-4">
                                <div>
                                    <p class="text-sm text-gray-500">No. Pesanan</p>
                                    <p class="font-bold text-gray-900">{{ $order->order_number }}</p>
                                </div>
                                <div class="hidden sm:block">
                                    <p class="text-sm text-gray-500">Tanggal Pembelian</p>
                                    <p class="font-medium text-gray-900">{{ $order->created_at->translatedFormat('d F Y, H:i') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'paid' => 'bg-primary-100 text-primary-700',
                                        'processing' => 'bg-primary-100 text-primary-700',
                                        'shipped' => 'bg-purple-100 text-purple-700',
                                        'delivered' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                    $statusIcons = [
                                        'pending' => 'clock',
                                        'paid' => 'check-circle',
                                        'processing' => 'box',
                                        'shipped' => 'truck',
                                        'delivered' => 'check-circle',
                                        'cancelled' => 'times-circle',
                                    ];
                                @endphp
                                <span class="{{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }} px-3 py-1 rounded-full text-sm font-semibold flex items-center">
                                    <i class="fas fa-{{ $statusIcons[$order->status] ?? 'info-circle' }} mr-2"></i>
                                    {{ $order->status_label }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Item Pesanan -->
                    <div class="p-6">
                        <div class="space-y-4 mb-6">
                            @foreach ($order->items as $item)
                                <div class="flex items-start space-x-4">
                                    <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                                        @if ($item->produk && $item->produk->images->first())
                                            <img src="{{ asset('storage/' . $item->produk->images->first()->image_path) }}" 
                                                alt="{{ $item->produk->nama }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $item->nama_produk }}</h4>
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm text-gray-600">{{ $item->quantity }} × Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                            <p class="font-bold text-primary-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Info Pengiriman jika shipped -->
                        @if ($order->status == 'shipped' && $order->resi)
                            <div class="bg-primary-50 rounded-lg p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Nomor Resi</p>
                                        <p class="font-bold text-gray-900">{{ $order->resi }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $order->kurir }}</p>
                                    </div>
                                    <form action="{{ route('pelanggan.pembelian.confirm-delivered', $order->id) }}" method="POST" 
                                        onsubmit="return confirm('Apakah Anda yakin pesanan sudah diterima?')">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-all text-sm">
                                            <i class="fas fa-check-circle mr-2"></i>Pesanan Diterima
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        <!-- Pending: Upload Bukti Pembayaran -->
                        @if ($order->status == 'pending')
                            <div class="bg-yellow-50 rounded-lg p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Segera lakukan pembayaran</p>
                                        <p class="font-bold text-red-600">Metode: {{ $order->metode_pembayaran }}</p>
                                    </div>
                                    @if (!$order->bukti_pembayaran)
                                        <button onclick="document.getElementById('uploadForm{{ $order->id }}').classList.toggle('hidden')"
                                            class="px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-all text-sm">
                                            <i class="fas fa-upload mr-2"></i>Upload Bukti
                                        </button>
                                    @else
                                        <span class="text-green-600 font-medium text-sm">
                                            <i class="fas fa-check-circle mr-1"></i>Bukti sudah diupload
                                        </span>
                                    @endif
                                </div>
                                <!-- Form Upload -->
                                <form id="uploadForm{{ $order->id }}" action="{{ route('pelanggan.pembelian.upload-bukti', $order->id) }}" 
                                    method="POST" enctype="multipart/form-data" class="hidden mt-4">
                                    @csrf
                                    <div class="flex items-center space-x-2">
                                        <input type="file" name="bukti_pembayaran" accept="image/*" required
                                            class="flex-1 text-sm border border-gray-300 rounded-lg">
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700">
                                            <i class="fas fa-save mr-1"></i>Kirim
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <!-- Cancelled: Alasan pembatalan -->
                        @if ($order->status == 'cancelled' && $order->cancelled_reason)
                            <div class="bg-red-50 rounded-lg p-4 mb-4">
                                <p class="text-sm text-gray-600 mb-1">Alasan Pembatalan</p>
                                <p class="font-medium text-red-700">{{ $order->cancelled_reason }}</p>
                            </div>
                        @endif

                        <!-- Total & Aksi -->
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Total Belanja</p>
                                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $order->metode_pembayaran }}</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('pelanggan.pembelian.show', $order->order_number) }}"
                                    class="flex-1 min-w-[120px] px-4 py-2.5 border-2 border-primary-600 text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition-all text-center">
                                    <i class="fas fa-info-circle mr-2"></i>Lihat Detail
                                </a>

                                @if ($order->canBeCancelled())
                                    <button onclick="document.getElementById('cancelForm{{ $order->id }}').classList.toggle('hidden')"
                                        class="flex-1 min-w-[120px] px-4 py-2.5 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition-all">
                                        <i class="fas fa-times mr-2"></i>Batalkan
                                    </button>
                                @endif
                            </div>

                            <!-- Form Batalkan -->
                            @if ($order->canBeCancelled())
                                <form id="cancelForm{{ $order->id }}" action="{{ route('pelanggan.pembelian.cancel', $order->id) }}" 
                                    method="POST" class="hidden mt-4">
                                    @csrf
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="cancelled_reason" placeholder="Alasan pembatalan" required
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-sm">
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700">
                                            Konfirmasi
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-8">
            {{ $orders->withQueryString()->links() }}
        </div>
    @else
        <!-- Status Kosong -->
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shopping-bag text-gray-400 text-5xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-600 mb-6">Anda belum memiliki riwayat pembelian</p>
            <a href="{{ route('pelanggan.produk.index') }}"
                class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-all shadow-md hover:shadow-lg">
                <i class="fas fa-shopping-bag mr-2"></i>Mulai Belanja
            </a>
        </div>
    @endif
@endsection