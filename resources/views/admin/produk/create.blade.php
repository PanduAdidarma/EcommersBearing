@extends('layout.admin.app')

@section('title', 'Tambah Produk - Admin')

@section('content')
    <!-- Header -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('admin.produk.index') }}"
                    class="inline-flex items-center text-white hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Tambah Produk</h1>
                <p class="text-blue-100">Tambahkan produk baru ke katalog</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-plus text-blue-900 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>Terjadi kesalahan:</strong>
            </div>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Informasi Dasar -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-info-circle mr-2 text-blue-600"></i>Informasi Dasar
            </h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama') border-red-500 @enderror"
                        placeholder="Contoh: SKF 6205-2Z Deep Groove Ball Bearing">
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kategori_id') border-red-500 @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Merk <span class="text-red-500">*</span>
                    </label>
                    <select name="merk_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('merk_id') border-red-500 @enderror">
                        <option value="">Pilih Merk</option>
                        @foreach ($merks as $merk)
                            <option value="{{ $merk->id }}" {{ old('merk_id') == $merk->id ? 'selected' : '' }}>
                                {{ $merk->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('merk_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        SKU
                    </label>
                    <input type="text" name="sku" value="{{ old('sku') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sku') border-red-500 @enderror"
                        placeholder="Kosongkan untuk auto-generate">
                    @error('sku')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Kosongkan untuk generate otomatis</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('deskripsi') border-red-500 @enderror"
                        placeholder="Deskripsi lengkap produk">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Harga & Stok -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-tag mr-2 text-blue-600"></i>Harga & Stok
            </h2>

            <div class="grid md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Harga <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                        <input type="text" name="harga" id="harga" value="{{ old('harga') }}" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('harga') border-red-500 @enderror"
                            placeholder="0" oninput="formatRupiah(this)">
                    </div>
                    @error('harga')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Harga jual normal produk</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Harga Diskon
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                        <input type="text" name="harga_diskon" id="harga_diskon" value="{{ old('harga_diskon') }}"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('harga_diskon') border-red-500 @enderror"
                            placeholder="0" oninput="formatRupiah(this)">
                    </div>
                    @error('harga_diskon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Kosongkan jika tidak ada diskon</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Stok <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="stok" value="{{ old('stok', 0) }}" required min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stok') border-red-500 @enderror">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">pcs</span>
                    </div>
                    @error('stok')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Jumlah stok tersedia</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Min Stok <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="min_stok" value="{{ old('min_stok', 5) }}" required min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('min_stok') border-red-500 @enderror">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">pcs</span>
                    </div>
                    @error('min_stok')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Batas peringatan stok rendah</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Berat <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="0.01" name="berat" value="{{ old('berat') }}" required min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('berat') border-red-500 @enderror"
                            placeholder="0">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">gram</span>
                    </div>
                    @error('berat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Untuk kalkulasi ongkir</p>
                </div>
            </div>
        </div>

        <script>
            function formatRupiah(input) {
                let value = input.value.replace(/[^\d]/g, '');
                if (value === '') {
                    input.value = '';
                    return;
                }
                input.value = new Intl.NumberFormat('id-ID').format(value);
            }
            
            // Before form submit, convert formatted price back to number
            document.querySelector('form').addEventListener('submit', function() {
                const harga = document.getElementById('harga');
                const hargaDiskon = document.getElementById('harga_diskon');
                if (harga) harga.value = harga.value.replace(/\./g, '');
                if (hargaDiskon) hargaDiskon.value = hargaDiskon.value.replace(/\./g, '');
            });
        </script>

        <!-- Spesifikasi Teknis -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-cog mr-2 text-blue-600"></i>Spesifikasi Teknis
            </h2>

            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Inner Diameter (mm)
                    </label>
                    <input type="number" step="0.01" name="inner_diameter" value="{{ old('inner_diameter') }}" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Outer Diameter (mm)
                    </label>
                    <input type="number" step="0.01" name="outer_diameter" value="{{ old('outer_diameter') }}" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Width (mm)
                    </label>
                    <input type="number" step="0.01" name="width" value="{{ old('width') }}" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Material
                    </label>
                    <input type="text" name="material" value="{{ old('material') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Contoh: Chrome Steel">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Seal Type
                    </label>
                    <input type="text" name="seal_type" value="{{ old('seal_type') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Contoh: 2RS, ZZ">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Cage Type
                    </label>
                    <input type="text" name="cage_type" value="{{ old('cage_type') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Contoh: Brass, Steel">
                </div>
            </div>
        </div>

        <!-- Gambar & Status -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-image mr-2 text-blue-600"></i>Gambar & Status
            </h2>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Produk
                    </label>
                    <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('images.*') border-red-500 @enderror">
                    @error('images.*')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Format: jpeg, png, jpg, webp. Maksimal 2MB per gambar. Gambar pertama akan jadi thumbnail.</p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label class="ml-2 text-sm font-medium text-gray-700">Produk Aktif</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label class="ml-2 text-sm font-medium text-gray-700">Produk Unggulan (Featured)</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.produk.index') }}"
                class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                <i class="fas fa-save mr-2"></i>Simpan Produk
            </button>
        </div>
    </form>
@endsection