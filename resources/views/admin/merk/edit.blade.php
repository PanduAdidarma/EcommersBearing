@extends('layout.admin.app')

@section('title', 'Edit Merk')

@section('content')
    <!-- Header -->
    <div class="bg-linear-to-r from-blue-700 to-blue-900 rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('admin.merk.index') }}"
                    class="inline-flex items-center text-white hover:text-white mb-4 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Edit Merk</h1>
                <p class="text-blue-100">Edit merk: {{ $merk->nama }}</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-edit text-blue-900 text-4xl"></i>
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

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Info Merk -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-center mb-6">
                    @if ($merk->logo)
                        <img src="{{ asset('storage/' . $merk->logo) }}" alt="{{ $merk->nama }}"
                            class="w-32 h-32 rounded-lg mx-auto mb-4 object-cover border-4 border-blue-100">
                    @else
                        <div class="w-32 h-32 rounded-lg mx-auto mb-4 bg-gray-100 flex items-center justify-center border-4 border-blue-100">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                    @endif
                    <h3 class="text-xl font-bold text-gray-900">{{ $merk->nama }}</h3>
                    <p class="text-sm text-gray-500">ID: #{{ $merk->id }}</p>
                    
                    <div class="flex justify-center gap-2 mt-2">
                        @if ($merk->is_premium)
                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">
                                <i class="fas fa-crown mr-1"></i>Premium
                            </span>
                        @endif
                        @if ($merk->is_active)
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                <i class="fas fa-check-circle mr-1"></i>Aktif
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">
                                <i class="fas fa-pause-circle mr-1"></i>Tidak Aktif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Jumlah Produk:</span>
                        <span class="font-medium">{{ $merk->produks()->count() }} produk</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Dibuat:</span>
                        <span class="font-medium">{{ $merk->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Diupdate:</span>
                        <span class="font-medium">{{ $merk->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Edit -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6">
                <form action="{{ route('admin.merk.update', $merk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Nama Merk -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Merk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" value="{{ old('nama', $merk->nama) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama') border-red-500 @enderror"
                                placeholder="Contoh: SKF, NSK, FAG">
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Nama merk harus unik dan maksimal 100 karakter</p>
                        </div>

                        <!-- Logo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Logo Baru
                            </label>
                            <input type="file" name="logo" accept="image/jpeg,image/png,image/jpg,image/svg+xml"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('logo') border-red-500 @enderror">
                            @error('logo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-xs mt-1">Kosongkan jika tidak ingin mengubah logo. Format: jpeg, png, jpg, svg. Maksimal 1MB</p>
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('deskripsi') border-red-500 @enderror"
                                placeholder="Deskripsi singkat tentang merk ini">{{ old('deskripsi', $merk->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Deskripsi akan ditampilkan di halaman merk (opsional)</p>
                        </div>

                        <!-- Premium -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Merk Premium
                            </label>
                            <select name="is_premium"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('is_premium') border-red-500 @enderror">
                                <option value="0" {{ old('is_premium', $merk->is_premium) == 0 ? 'selected' : '' }}>Tidak</option>
                                <option value="1" {{ old('is_premium', $merk->is_premium) == 1 ? 'selected' : '' }}>Ya (Premium)</option>
                            </select>
                            @error('is_premium')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-xs mt-1">Merk premium akan ditampilkan dengan badge khusus</p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>
                            <select name="is_active"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('is_active') border-red-500 @enderror">
                                <option value="1" {{ old('is_active', $merk->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active', $merk->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('is_active')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Merk tidak aktif tidak akan ditampilkan</p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.merk.index') }}"
                            class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-all">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection