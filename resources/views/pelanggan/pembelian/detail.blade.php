@extends('layout.pelanggan.app')

@section('title', 'Detail Pesanan ' . $order->order_number . ' - Bearing Shop')

@section('content')
    <!-- Header Halaman -->
    <div class="bg-linear-to-r from-primary-700 to-primary-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('pelanggan.pembelian.index') }}"
                    class="inline-flex mb-6 items-center text-white hover:text-white transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Detail Pesanan</h1>
                <p class="text-primary-100">No. Pesanan: {{ $order->order_number }}</p>
            </div>
            <div class="md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-receipt text-primary-800 text-4xl"></i>
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

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Detail Pesanan -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Pesanan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Status Pesanan</h2>
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
                <div class="{{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }} px-4 py-3 rounded-lg flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-{{ $statusIcons[$order->status] ?? 'info-circle' }} text-2xl mr-3"></i>
                        <span class="font-bold text-lg">{{ $order->status_label }}</span>
                    </div>
                </div>

                <!-- Timeline Status -->
                @if ($order->statuses->count() > 0)
                    <div class="relative pl-8">
                        @foreach ($order->statuses->sortByDesc('created_at') as $index => $status)
                            <div class="relative {{ !$loop->last ? 'pb-8' : 'pb-0' }}">
                                @if (!$loop->last)
                                    <span class="absolute top-8 left-[-+20px] -ml-px h-full w-0.5 bg-primary-600"></span>
                                @endif
                                <div class="relative flex items-start">
                                    <span class="h-10 w-10 rounded-full flex items-center justify-center absolute -left-10 bg-primary-600 text-white {{ $loop->first ? 'ring-4 ring-primary-200' : '' }}">
                                        <i class="fas fa-{{ $statusIcons[$status->status] ?? 'info-circle' }}"></i>
                                    </span>
                                    <div class="min-w-0 flex-1 ml-3">
                                        <p class="font-bold text-gray-900 {{ $loop->first ? 'text-primary-600' : '' }}">
                                            {{ $status->status_label ?? ucfirst($status->status) }}
                                        </p>
                                        @if ($status->keterangan)
                                            <p class="text-sm text-gray-600 mt-1">{{ $status->keterangan }}</p>
                                        @endif
                                        <p class="text-xs text-gray-500 mt-1">{{ $status->created_at->translatedFormat('d F Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Produk yang Dipesan -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-box mr-2 text-primary-600"></i>Produk yang Dipesan
                </h2>
                <div class="space-y-4">
                    @foreach ($order->items as $item)
                        <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                            <div class="w-24 h-24 bg-white rounded-lg overflow-hidden shrink-0 shadow-sm">
                                @if ($item->produk && $item->produk->images->first())
                                    <img src="{{ asset('storage/' . $item->produk->images->first()->image_path) }}" 
                                        alt="{{ $item->nama_produk }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $item->nama_produk }}</h4>
                                <p class="text-xs text-gray-500 mb-2">SKU: {{ $item->produk->sku ?? '-' }}</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600">{{ $item->quantity }} × Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                    <p class="font-bold text-primary-600 text-lg">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Informasi Pengiriman -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-truck mr-2 text-primary-600"></i>Informasi Pengiriman
                </h2>
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-3">Penerima</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex">
                                <span class="text-gray-600 w-24">Nama</span>
                                <span class="text-gray-900 font-medium">: {{ $order->alamat_penerima }}</span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-600 w-24">Telepon</span>
                                <span class="text-gray-900 font-medium">: {{ $order->alamat_telepon }}</span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-600 w-24">Alamat</span>
                                <span class="text-gray-900 font-medium flex-1">: {{ $order->alamat_lengkap }}, 
                                    {{ $order->alamat_kecamatan }}, {{ $order->alamat_kota }}, 
                                    {{ $order->alamat_provinsi }} {{ $order->alamat_kode_pos }}</span>
                            </div>
                        </div>
                    </div>

                    @if ($order->kurir || $order->resi)
                        <div class="bg-primary-50 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-900 mb-3">Kurir & Pengiriman</h3>
                            <div class="space-y-2 text-sm">
                                @if ($order->kurir)
                                    <div class="flex">
                                        <span class="text-gray-600 w-32">Kurir</span>
                                        <span class="text-gray-900 font-medium">: {{ $order->kurir }}</span>
                                    </div>
                                @endif
                                @if ($order->resi)
                                    <div class="flex">
                                        <span class="text-gray-600 w-32">No. Resi</span>
                                        <span class="text-gray-900 font-medium">: {{ $order->resi }}</span>
                                    </div>
                                @endif
                                @if ($order->estimasi_sampai)
                                    <div class="flex">
                                        <span class="text-gray-600 w-32">Estimasi Tiba</span>
                                        <span class="text-gray-900 font-medium">: {{ $order->estimasi_sampai->translatedFormat('d F Y') }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Tombol Konfirmasi Pesanan Diterima -->
                            @if ($order->status == 'shipped')
                                <div class="mt-4 pt-4 border-t border-primary-200">
                                    <form action="{{ route('pelanggan.pembelian.confirm-delivered', $order->id) }}" method="POST" 
                                        onsubmit="return confirm('Apakah Anda yakin pesanan sudah diterima?')">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-all">
                                            <i class="fas fa-check-circle mr-2"></i>Konfirmasi Pesanan Diterima
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-credit-card mr-2 text-primary-600"></i>Informasi Pembayaran
                </h2>
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-3">Metode Pembayaran</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex">
                                <span class="text-gray-600 w-32">Metode</span>
                                <span class="text-gray-900 font-medium">: {{ $order->metode_pembayaran }}</span>
                            </div>
                        </div>
                    </div>

                    @if ($order->paid_at)
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-gray-900">Status Pembayaran</h3>
                                <span class="px-3 py-1 bg-green-600 text-white rounded-full text-sm font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>Sudah Dibayar
                                </span>
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Dibayar Pada</span>
                                    <span class="text-gray-900 font-medium">{{ $order->paid_at->translatedFormat('d F Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    @elseif ($order->status == 'pending')
                        <div class="bg-yellow-50 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-gray-900">Status Pembayaran</h3>
                                <span class="px-3 py-1 bg-yellow-600 text-white rounded-full text-sm font-semibold">
                                    <i class="fas fa-clock mr-1"></i>Menunggu Pembayaran
                                </span>
                            </div>
                            @if (!$order->bukti_pembayaran)
                                <form action="{{ route('pelanggan.pembelian.upload-bukti', $order->id) }}" 
                                    method="POST" enctype="multipart/form-data" class="mt-4" id="uploadBuktiForm">
                                    @csrf
                                    <p class="text-sm text-gray-600 mb-3">Upload bukti pembayaran:</p>
                                    
                                    <!-- Upload Area -->
                                    <div class="relative">
                                        <input type="file" name="bukti_pembayaran" accept="image/*" required
                                            id="buktiPembayaranInput"
                                            class="hidden">
                                        
                                        <!-- Clickable Upload Box -->
                                        <div id="uploadBox" 
                                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-primary-500 hover:bg-primary-50 transition-all duration-200">
                                            <div id="uploadPlaceholder">
                                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                                <p class="text-sm text-gray-600 mb-1">Klik untuk memilih file</p>
                                                <p class="text-xs text-gray-400">atau drag & drop file di sini</p>
                                                <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, JPEG (Maks. 2MB)</p>
                                            </div>
                                            <div id="filePreview" class="hidden">
                                                <img id="previewImage" src="" alt="Preview" class="max-h-32 mx-auto rounded-lg mb-2">
                                                <p id="fileName" class="text-sm text-gray-700 font-medium"></p>
                                                <button type="button" id="removeFile" class="text-red-500 text-xs mt-1 hover:text-red-700">
                                                    <i class="fas fa-times mr-1"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Submit Button -->
                                        <button type="submit" id="submitBtn" 
                                            class="w-full mt-3 px-4 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed"
                                            disabled>
                                            <i class="fas fa-upload mr-2"></i>Upload Bukti Pembayaran
                                        </button>
                                    </div>
                                </form>
                                
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const fileInput = document.getElementById('buktiPembayaranInput');
                                        const uploadBox = document.getElementById('uploadBox');
                                        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
                                        const filePreview = document.getElementById('filePreview');
                                        const previewImage = document.getElementById('previewImage');
                                        const fileName = document.getElementById('fileName');
                                        const removeFile = document.getElementById('removeFile');
                                        const submitBtn = document.getElementById('submitBtn');
                                        
                                        // Click to open file dialog
                                        uploadBox.addEventListener('click', function(e) {
                                            if (e.target !== removeFile && !removeFile.contains(e.target)) {
                                                fileInput.click();
                                            }
                                        });
                                        
                                        // Handle file selection
                                        fileInput.addEventListener('change', function() {
                                            handleFile(this.files[0]);
                                        });
                                        
                                        // Drag and drop
                                        uploadBox.addEventListener('dragover', function(e) {
                                            e.preventDefault();
                                            this.classList.add('border-primary-500', 'bg-primary-50');
                                        });
                                        
                                        uploadBox.addEventListener('dragleave', function(e) {
                                            e.preventDefault();
                                            this.classList.remove('border-primary-500', 'bg-primary-50');
                                        });
                                        
                                        uploadBox.addEventListener('drop', function(e) {
                                            e.preventDefault();
                                            this.classList.remove('border-primary-500', 'bg-primary-50');
                                            const file = e.dataTransfer.files[0];
                                            if (file && file.type.startsWith('image/')) {
                                                fileInput.files = e.dataTransfer.files;
                                                handleFile(file);
                                            }
                                        });
                                        
                                        // Remove file
                                        removeFile.addEventListener('click', function(e) {
                                            e.stopPropagation();
                                            fileInput.value = '';
                                            uploadPlaceholder.classList.remove('hidden');
                                            filePreview.classList.add('hidden');
                                            submitBtn.disabled = true;
                                        });
                                        
                                        function handleFile(file) {
                                            if (file) {
                                                // Validate file size (2MB)
                                                if (file.size > 2 * 1024 * 1024) {
                                                    alert('Ukuran file maksimal 2MB');
                                                    fileInput.value = '';
                                                    return;
                                                }
                                                
                                                // Show preview
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    previewImage.src = e.target.result;
                                                    fileName.textContent = file.name;
                                                    uploadPlaceholder.classList.add('hidden');
                                                    filePreview.classList.remove('hidden');
                                                    submitBtn.disabled = false;
                                                };
                                                reader.readAsDataURL(file);
                                            }
                                        }
                                    });
                                </script>
                            @else
                                <p class="text-sm text-green-600 mt-2">
                                    <i class="fas fa-check-circle mr-1"></i>Bukti pembayaran sudah diupload, menunggu verifikasi
                                </p>
                            @endif
                        </div>
                    @endif

                    @if ($order->bukti_pembayaran)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-900 mb-3">Bukti Pembayaran</h3>
                            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Bukti Pembayaran" 
                                class="w-full max-w-xs rounded-lg border border-gray-200">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Ringkasan & Aksi -->
        <div class="lg:col-span-1">
            <div class="sticky top-2 space-y-6">
                <!-- Ringkasan Pembayaran -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h2>
                    <div class="space-y-3 mb-4 pb-4 border-b border-gray-200">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal Produk</span>
                            <span class="font-medium">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span class="font-medium">
                                @if ($order->ongkir > 0)
                                    Rp {{ number_format($order->ongkir, 0, ',', '.') }}
                                @else
                                    GRATIS
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                        <span class="text-2xl font-bold text-primary-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-xs text-gray-500 text-center">Termasuk PPN jika berlaku</p>
                </div>

                <!-- Tombol Aksi -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Aksi</h2>
                    <div class="space-y-3">
                        @if ($order->canBeCancelled())
                            <button onclick="document.getElementById('cancelFormDetail').classList.toggle('hidden')"
                                class="w-full px-4 py-2.5 border-2 border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition-all">
                                <i class="fas fa-times mr-2"></i>Batalkan Pesanan
                            </button>
                            <form id="cancelFormDetail" action="{{ route('pelanggan.pembelian.cancel', $order->id) }}" 
                                method="POST" class="hidden">
                                @csrf
                                <input type="text" name="cancelled_reason" placeholder="Alasan pembatalan" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm mb-2">
                                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700">
                                    Konfirmasi Batalkan
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('pelanggan.pembelian.index') }}"
                            class="w-full px-4 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all block text-center">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Riwayat
                        </a>
                    </div>
                </div>

                <!-- Catatan -->
                @if ($order->catatan)
                    <div class="bg-gray-50 rounded-xl shadow-md p-6">
                        <h3 class="font-bold text-gray-900 mb-3">
                            <i class="fas fa-sticky-note mr-2 text-primary-600"></i>Catatan
                        </h3>
                        <p class="text-sm text-gray-700">{{ $order->catatan }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection