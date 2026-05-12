@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<div class="max-w-7xl mx-auto px-container-padding py-6">
    <header class="mb-stack-lg flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight">Manajemen Produk</h1>
            <p class="font-body-md text-body-md text-outline">Kelola katalog inventaris dan pantau ketersediaan stok secara real-time.</p>
        </div>
    </header>

    <form action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row items-center justify-between gap-4 mb-stack-lg w-full">
        
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
            <div class="relative w-full sm:w-[300px]">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-xl">search</span>
                <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200" placeholder="Cari nama atau SKU..." type="text"/>
            </div>

            <div class="w-full sm:w-[200px]">
                <select name="category_id" class="w-full px-4 py-2.5 bg-white border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 text-on-surface">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-surface-variant text-on-surface font-label-md rounded-lg hover:bg-surface-dim transition-colors shadow-sm">
                Filter
            </button>
            
            @if(request('search') || request('category_id'))
                <a href="{{ route('products.index') }}" class="text-sm text-error hover:underline whitespace-nowrap">Reset</a>
            @endif
        </div>
        
        <a href="{{ route('products.create') }}" class="w-full md:w-auto flex items-center justify-center gap-2 px-6 py-2.5 bg-primary-container text-white font-label-md text-label-md rounded-lg shadow-md hover:bg-primary transition-all duration-200 active:scale-[0.98]">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Produk Baru
        </a>
    </form>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 shadow-sm" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-surface-container-low border-b border-outline-variant">
                        <th class="px-6 py-4 font-label-md text-label-md text-outline uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-4 font-label-md text-label-md text-outline uppercase tracking-wider">Kode Produk</th>
                        <th class="px-6 py-4 font-label-md text-label-md text-outline uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 font-label-md text-label-md text-outline uppercase tracking-wider text-center">Stok</th>
                        <th class="px-6 py-4 font-label-md text-label-md text-outline uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    
                    @forelse ($products as $product)
                    <tr class="hover:bg-surface-container transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-10 w-10 rounded-lg object-cover border border-outline-variant shadow-sm">
                                @else
                                    <div class="h-10 w-10 rounded-lg {{ $product->stock == 0 ? 'bg-error-container/10' : 'bg-primary/5' }} flex items-center justify-center">
                                        <span class="material-symbols-outlined {{ $product->stock == 0 ? 'text-error' : 'text-primary' }}">inventory_2</span>
                                    </div>
                                @endif
                                <span class="font-headline-sm text-body-lg font-semibold text-on-surface">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-body-md text-body-md text-outline">{{ $product->sku }}</td>
                        <td class="px-6 py-4 font-body-md text-body-md font-medium text-on-surface">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($product->stock == 0)
                                <span class="px-2.5 py-1 bg-error-container text-on-error-container text-label-sm font-label-sm rounded-full">
                                    {{ $product->stock }}
                                </span>
                            @elseif($product->stock <= $product->minimum_stock)
                                <span class="px-2.5 py-1 bg-tertiary-fixed/30 text-on-tertiary-fixed-variant text-label-sm font-label-sm rounded-full">
                                    {{ $product->stock }}
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-secondary-container/20 text-on-secondary-container text-label-sm font-label-sm rounded-full">
                                    {{ $product->stock }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-4">
                            <a href="{{ route('products.edit', $product->id) }}" class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors">Edit</a>
                            
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-label-md text-label-md text-on-surface-variant hover:text-error transition-colors">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-3xl">inventory_2</span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Katalog Masih Kosong</h3>
                                <p class="text-gray-500 text-sm mb-6 text-center">Mulai tambahkan barang dagangan Anda agar dapat dilacak stok dan penjualannya.</p>
                                <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                                    <span class="material-symbols-outlined text-[18px]">add</span>
                                    Tambah Produk Pertama
                                </a>
                                @if(request('search') || request('category_id'))
                                    <p class="text-xs text-gray-400 mt-4">Atau coba <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline">hapus filter pencarian</a></p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant flex items-center justify-between">
            <span class="font-body-md text-body-md text-outline">Menampilkan total {{ $products->count() }} produk</span>
            <div class="flex items-center gap-2">
                <button class="p-1.5 rounded border border-outline-variant text-outline hover:bg-white disabled:opacity-50" disabled="">
                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                </button>
                <button class="p-1.5 rounded border border-outline-variant text-outline hover:bg-white disabled:opacity-50" disabled="">
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection