@extends('layouts.app')

@section('title', 'Catat Transaksi Baru')

@section('content')
<main class="max-w-5xl mx-auto p-container-padding">
    <!-- Header -->
    <header class="mb-stack-lg">
        <a href="{{ route('transactions.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-primary-container transition-colors font-label-md mb-stack-md group">
            <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
            Kembali
        </a>
        <h1 class="font-headline-lg text-on-surface mb-stack-sm">Catat Transaksi Baru</h1>
        <p class="font-body-lg text-on-surface-variant">Masukkan data barang masuk atau keluar gudang.</p>
    </header>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Card Form Utama -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-[32px]">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <!-- Bagian 1: Informasi Umum -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter mb-stack-lg">
                <div class="flex flex-col gap-stack-sm">
                    <label class="font-label-md text-on-surface-variant">Jenis Transaksi</label>
                    <select name="type" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 font-body-md text-on-surface focus:outline-none focus:border-primary" required>
                        <option value="">Pilih Jenis Transaksi</option>
                        <option value="masuk">Barang Masuk (Restock)</option>
                        <option value="keluar">Barang Keluar</option>
                    </select>
                </div>
                <div class="flex flex-col gap-stack-sm">
                    <label class="font-label-md text-on-surface-variant">Tanggal Transaksi</label>
                    <input name="transaction_date" type="datetime-local" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 font-body-md text-on-surface focus:outline-none focus:border-primary" required value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" />
                </div>
            </div>

            <hr class="border-t border-outline-variant my-[32px]"/>

            <!-- Bagian 2: Detail Item (Daftar Barang) -->
            <div class="mb-stack-lg">
                <h2 class="font-headline-sm text-on-surface mb-stack-md">Daftar Barang</h2>
                
                <div id="product-rows-container">
                    <!-- Baris 1 (Default) -->
                    <div class="product-row flex flex-col sm:flex-row items-end gap-stack-md mb-stack-md">
                        <div class="flex-1 w-full flex flex-col gap-stack-sm">
                            <label class="font-label-md text-on-surface-variant">Pilih Produk</label>
                            <select name="product_id[]" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 font-body-md text-on-surface focus:outline-none focus:border-primary" required>
                                <option value="">Pilih Produk dari Katalog</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->sku }} - {{ $product->name }} (Stok: {{ $product->stock }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full sm:w-[150px] flex flex-col gap-stack-sm">
                            <label class="font-label-md text-on-surface-variant">Kuantitas</label>
                            <input name="quantity[]" type="number" min="1" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 font-body-md text-on-surface focus:outline-none focus:border-primary" placeholder="0" required />
                        </div>
                        <!-- Tombol Hapus (Disembunyikan pada baris pertama) -->
                        <button type="button" class="remove-row-btn hidden h-[46px] w-[46px] flex items-center justify-center bg-error-container text-on-error-container hover:bg-error hover:text-on-error rounded-lg transition-colors flex-shrink-0">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                </div>

                <button type="button" id="add-row-btn" class="mt-stack-md inline-flex items-center gap-2 px-4 py-2 border border-primary text-primary hover:bg-surface-container-low rounded-lg font-label-md transition-colors">
                    <span class="material-symbols-outlined text-[18px]">add</span> Tambah Barang Lain
                </button>
            </div>

            <!-- Bagian 3: Footer Form -->
            <div class="border-t border-outline-variant pt-[24px] mt-[32px] flex justify-end gap-stack-md items-center">
                <a href="{{ route('transactions.index') }}" class="px-6 py-2.5 bg-surface-variant text-on-surface-variant rounded-lg font-label-md">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-lg font-label-md shadow-sm">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</main>

<!-- Skrip JavaScript untuk menambah baris produk secara dinamis -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('product-rows-container');
        const addBtn = document.getElementById('add-row-btn');

        addBtn.addEventListener('click', function() {
            // Ambil elemen baris pertama untuk dicloning
            const firstRow = container.querySelector('.product-row');
            const newRow = firstRow.cloneNode(true);

            // Bersihkan input value pada baris baru
            newRow.querySelector('input[type="number"]').value = '';
            newRow.querySelector('select').selectedIndex = 0;

            // Tampilkan tombol hapus pada baris baru
            const removeBtn = newRow.querySelector('.remove-row-btn');
            removeBtn.classList.remove('hidden');

            // Tambahkan event listener untuk tombol hapus
            removeBtn.addEventListener('click', function() {
                newRow.remove();
            });

            // Sembunyikan label agar sejajar secara visual dengan baris di atasnya
            const labels = newRow.querySelectorAll('label');
            labels.forEach(label => label.classList.add('sr-only'));

            container.appendChild(newRow);
        });
    });
</script>
@endsection