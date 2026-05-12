@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Breadcrumb & Nav -->
    <nav class="flex items-center gap-2 mb-8">
        <a href="{{ route('help.index') }}" class="text-gray-500 hover:text-gray-900 transition-colors text-sm font-medium flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            Pusat Bantuan
        </a>
        <span class="text-gray-300 text-sm">/</span>
        <span class="text-gray-400 text-sm truncate">{{ $title }}</span>
    </nav>

    <!-- Article Content (Mocked beautifully) -->
    <article class="bg-white border border-gray-200 rounded-3xl p-8 md:p-12 shadow-sm">
        <header class="mb-10 pb-10 border-b border-gray-100">
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight leading-tight mb-4">{{ $title }}</h1>
            <div class="flex items-center gap-4 text-sm text-gray-500">
                <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">schedule</span> Diperbarui 2 hari yang lalu</span>
                <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">timer</span> 3 min baca</span>
            </div>
        </header>

        <div class="prose prose-blue max-w-none">
            <p class="text-lg text-gray-600 leading-relaxed mb-8">
                Halaman ini adalah dokumentasi detail untuk panduan <strong>{{ $title }}</strong>. Saat ini, sistem bantuan beroperasi menggunakan kerangka data statis demi mempercepat performa (mockup), namun arsitektur ini sudah siap sepenuhnya untuk dikoneksikan ke sebuah CMS <i>(Content Management System)</i> di masa depan.
            </p>

            <h3 class="text-xl font-semibold text-gray-900 mb-4 mt-10">Langkah-langkah Eksekusi</h3>
            <p class="text-gray-600 mb-6">Berikut adalah prosedur standar operasi (SOP) yang direkomendasikan sistem:</p>
            
            <ol class="space-y-4 mb-8 text-gray-600 list-decimal pl-5">
                <li class="pl-2">Akses menu yang relevan di *sidebar* sebelah kiri layar Anda.</li>
                <li class="pl-2">Klik tombol aksi utama (biasanya berwarna biru di kanan atas layar).</li>
                <li class="pl-2">Isi formulir sesuai dengan petunjuk bantuan yang sudah dilengkapi tanda <code>[?]</code> (tooltip).</li>
                <li class="pl-2">Simpan data Anda, dan sistem akan langsung melakukan pencatatan histori.</li>
            </ol>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-xl my-8">
                <h4 class="text-blue-900 font-semibold mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">info</span>
                    Catatan Penting
                </h4>
                <p class="text-blue-800/80 text-sm">
                    Pastikan Anda selalu memeriksa kembali angka masukan Anda, terutama yang berhubungan dengan Kuantitas (Stok) dan Harga. Sistem menggunakan <i>Double-Entry Logic</i> untuk transaksi, yang berarti pembatalan stok akan tercatat sebagai transaksi baru demi menjaga integritas data akuntansi gudang.
                </p>
            </div>
            
            <h3 class="text-xl font-semibold text-gray-900 mb-4 mt-10">Mengalami Kendala Lebih Lanjut?</h3>
            <p class="text-gray-600 mb-6">Jika panduan ini masih kurang menyelesaikan masalah Anda di lapangan, dukungan manusiawi kami siap membantu.</p>
        </div>
        
        <footer class="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-gray-500">Apakah artikel ini membantu?</span>
                <button class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-green-600 hover:border-green-200 hover:bg-green-50 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">thumb_up</span>
                </button>
                <button class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">thumb_down</span>
                </button>
            </div>
            <a href="mailto:{{ setting('contact_email', 'support@inventoripro.com') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors flex items-center gap-1">
                Kirim email ke Dukungan <span class="material-symbols-outlined text-[16px]">open_in_new</span>
            </a>
        </footer>
    </article>

</div>
@endsection
