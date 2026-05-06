@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-4xl mx-auto px-container-padding py-6">
    <div class="mb-stack-lg">
        <a href="{{ route('products.index') }}" class="text-primary hover:underline flex items-center gap-1 font-label-md">
            <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
        </a>
        <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-4">Edit Produk</h1>
        <p class="font-body-md text-outline">Perbarui detail produk inventaris.</p>
    </div>

    <div class="bg-white border border-outline-variant rounded-xl shadow-sm p-8">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <!-- Method PUT wajib untuk Update di Laravel -->
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Produk -->
                <div>
                    <label class="block font-label-md text-on-surface mb-2">Nama Produk <span class="text-error">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none" required>
                    @error('name') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Kode Produk (SKU) -->
                <div>
                    <label class="block font-label-md text-on-surface mb-2">Kode Produk (SKU) <span class="text-error">*</span></label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full px-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none" required>
                    @error('sku') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block font-label-md text-on-surface mb-2">Kategori <span class="text-error">*</span></label>
                    <select name="category_id" class="w-full px-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none" required>
                        <option value="">Pilih Kategori...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Gambar Produk -->
                <div>
                    <label class="block font-label-md text-on-surface mb-2">Gambar Produk (Opsional)</label>
                    
                    <!-- Menampilkan Gambar Lama Jika Ada -->
                    @if($product->image)
                        <div class="mb-3">
                            <p class="text-sm text-outline mb-1">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-20 w-20 object-cover rounded-lg border border-outline-variant shadow-sm">
                        </div>
                    @endif

                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-container file:text-primary-fixed hover:file:bg-primary hover:file:text-white transition-all">
                    <p class="text-xs text-outline mt-1">*Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    @error('image') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label class="block font-label-md text-on-surface mb-2">Harga (Rp) <span class="text-error">*</span></label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full px-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none" required>
                    @error('price') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Stok Awal & Stok Minimum -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-md text-on-surface mb-2">Stok <span class="text-error">*</span></label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full px-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none" required>
                        @error('stock') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-label-md text-on-surface mb-2">Batas Min. Stok <span class="text-error">*</span></label>
                        <input type="number" name="minimum_stock" value="{{ old('minimum_stock', $product->minimum_stock) }}" class="w-full px-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none" required>
                        @error('minimum_stock') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-outline-variant">
                <a href="{{ route('products.index') }}" class="px-6 py-2.5 bg-surface-variant text-on-surface font-label-md rounded-lg hover:bg-surface-dim transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-label-md rounded-lg hover:bg-primary-container transition-colors shadow-md">Perbarui Produk</button>
            </div>
        </form>
    </div>
</div>
@endsection