@extends('layouts.app')

@section('title', 'Pusat Bantuan')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Hero / Search Section -->
    <div class="mb-12">
        <h1 class="text-3xl font-semibold tracking-tight text-gray-900 mb-2">Halo {{ auth()->user()->name ?? 'Kawan' }}, ada yang bisa dibantu?</h1>
        <p class="text-gray-500 text-lg mb-8 max-w-2xl">Jelajahi panduan penggunaan sistem, atau langsung cari topik yang sedang Anda butuhkan saat ini.</p>
        
        <form action="{{ route('help.index') }}" method="GET" class="relative max-w-3xl group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-gray-400 text-[22px] group-focus-within:text-blue-600 transition-colors">search</span>
            </div>
            <input type="text" 
                   name="q" 
                   value="{{ $searchQuery }}" 
                   placeholder="Misal: 'cara edit produk' atau 'laporan bulanan'..." 
                   class="w-full pl-12 pr-4 py-4 bg-white border border-gray-200 rounded-2xl text-gray-900 shadow-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-base placeholder:text-gray-400">
            
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center gap-2">
                @if($searchQuery)
                    <a href="{{ route('help.index') }}" class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </a>
                @endif
                <kbd class="hidden sm:inline-flex items-center px-2 py-1 border border-gray-200 rounded text-xs font-medium text-gray-400 bg-gray-50/50">Enter</kbd>
            </div>
        </form>

        @if($searchQuery)
            <p class="mt-4 text-sm text-gray-500">Hasil pencarian untuk: <strong class="text-gray-900">"{{ $searchQuery }}"</strong></p>
        @endif
    </div>

    <!-- Main Content Layout -->
    <div class="flex flex-col lg:flex-row gap-12">
        
        <!-- Left Column: Knowledge Base Categories -->
        <div class="flex-1">
            @if(!$searchQuery)
                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-6">Koleksi Panduan</h2>
            @endif

            <div class="space-y-10">
                @forelse($categories as $category)
                    @php
                        // Cek apakah ada artikel di kategori ini yang cocok dengan pencarian
                        $matchingArticles = array_filter($category['articles'], function($article) use ($searchQuery) {
                            return !$searchQuery || stripos($article, $searchQuery) !== false;
                        });
                    @endphp

                    @if(count($matchingArticles) > 0)
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="material-symbols-outlined text-gray-400 text-[20px]">{{ $category['icon'] }}</span>
                                <h3 class="text-lg font-medium text-gray-900">{{ $category['title'] }}</h3>
                            </div>
                            
                            <div class="bg-white border border-gray-200/60 rounded-2xl overflow-hidden shadow-sm">
                                <ul class="divide-y divide-gray-100">
                                    @foreach($matchingArticles as $article)
                                        <li>
                                            <a href="{{ route('help.show', Str::slug($article)) }}" class="group flex items-center justify-between px-6 py-4 hover:bg-gray-50/80 transition-colors">
                                                <span class="text-gray-700 font-medium text-sm group-hover:text-blue-600 transition-colors">{{ $article }}</span>
                                                <span class="material-symbols-outlined text-gray-300 text-[18px] group-hover:text-blue-500 group-hover:translate-x-1 transition-all">arrow_forward</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @empty
                    <!-- (Kondisi ini tidak akan terpanggil karena filtering manual di atas, namun disiapkan jika list $categories kosong) -->
                @endforelse

                @if($searchQuery && !collect($categories)->pluck('articles')->flatten()->filter(fn($a) => stripos($a, $searchQuery) !== false)->count())
                    <div class="text-center py-16 px-6 bg-gray-50 border border-gray-200 border-dashed rounded-2xl">
                        <span class="material-symbols-outlined text-gray-400 text-4xl mb-3">search_off</span>
                        <h3 class="text-gray-900 font-medium mb-1">Tidak ada hasil yang cocok</h3>
                        <p class="text-sm text-gray-500">Coba gunakan kata kunci lain yang lebih umum atau sederhana.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Quick Onboarding / Support -->
        <div class="w-full lg:w-[320px] flex flex-col gap-6 shrink-0">
            
            @if(!$searchQuery)
            <!-- Onboarding Checklist (SaaS Style) -->
            <div class="bg-gray-900 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                <!-- Subtle background pattern -->
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 16px 16px;"></div>
                
                <div class="relative z-10">
                    <h3 class="font-medium text-lg mb-1">Langkah Pertama</h3>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">Selesaikan langkah ini untuk menyiapkan toko Anda beroperasi penuh.</p>
                    
                    <div class="space-y-4">
                        <div class="flex gap-3 items-start opacity-50">
                            <span class="material-symbols-outlined text-green-400 text-[20px] mt-0.5">check_circle</span>
                            <div>
                                <p class="text-sm font-medium text-gray-300 line-through">Buat akun staf</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start">
                            <div class="w-5 h-5 rounded-full border border-gray-600 flex items-center justify-center mt-0.5 shrink-0"></div>
                            <div>
                                <p class="text-sm font-medium text-white">Daftarkan kategori</p>
                                <p class="text-xs text-gray-400 mt-1">Pisahkan barang per divisi</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start">
                            <div class="w-5 h-5 rounded-full border border-gray-600 flex items-center justify-center mt-0.5 shrink-0"></div>
                            <div>
                                <p class="text-sm font-medium text-white">Input stok awal barang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Contact Box -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[20px]">support_agent</span>
                </div>
                <h3 class="font-medium text-gray-900 mb-1">Butuh Bantuan Langsung?</h3>
                <p class="text-sm text-gray-500 mb-4 leading-relaxed">Jangan ragu menghubungi tim support kami jika sistem mengalami kendala.</p>
                <a href="mailto:{{ setting('contact_email', 'support@inventoripro.com') }}" class="block w-full py-2.5 px-4 bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 text-gray-700 text-sm font-medium text-center rounded-xl transition-all">
                    Hubungi Dukungan
                </a>
            </div>

            <!-- Pro Tip -->
            <div class="bg-[#fdfbf7] border border-[#f3eee4] rounded-2xl p-6">
                <div class="flex items-center gap-2 text-amber-600 mb-2">
                    <span class="material-symbols-outlined text-[18px]">lightbulb</span>
                    <span class="text-xs font-bold tracking-wider uppercase">Pro Tip</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Gunakan <strong>Ctrl + K</strong> (atau Cmd + K) dari mana saja di aplikasi untuk mencari produk tanpa menggunakan *mouse*.
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
