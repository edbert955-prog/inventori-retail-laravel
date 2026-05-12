@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-[32px]">
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-[24px] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05),0_2px_4px_-1px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-[64px] text-primary">inventory_2</span>
            </div>
            <h3 class="font-headline-sm text-on-surface-variant mb-4">Total Produk</h3>
            <div class="flex items-baseline gap-2">
                <span class="font-headline-lg text-on-surface">{{ $totalProduk }}</span>
            </div>
            <div class="mt-4 flex items-center gap-1 text-secondary">
                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                <span class="font-label-sm">Data Real-time</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-[24px] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05),0_2px_4px_-1px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-[64px] text-error">warning</span>
            </div>
            <h3 class="font-headline-sm text-on-surface-variant mb-4">Stok Rendah</h3>
            <div class="flex items-baseline gap-2">
                <span class="font-headline-lg text-error">{{ $stokRendah }}</span>
                <span class="font-body-md text-on-surface-variant">item</span>
            </div>
            <div class="mt-4 flex items-center gap-1 text-error">
                <span class="material-symbols-outlined text-[16px]">priority_high</span>
                <span class="font-label-sm">Perlu restock segera</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-[24px] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05),0_2px_4px_-1px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-[64px] text-primary">receipt_long</span>
            </div>
            <h3 class="font-headline-sm text-on-surface-variant mb-4">Transaksi Hari Ini</h3>
            <div class="flex items-baseline gap-2">
                <span class="font-headline-lg text-on-surface">{{ $transaksiHariIni }}</span>
            </div>
            <div class="mt-4 flex items-center gap-1 text-secondary">
                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                <span class="font-label-sm">Data Real-time</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-[24px] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05),0_2px_4px_-1px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-[64px] text-primary">category</span>
            </div>
            <h3 class="font-headline-sm text-on-surface-variant mb-4">Total Kategori</h3>
            <div class="flex items-baseline gap-2">
                <span class="font-headline-lg text-on-surface">{{ $totalKategori }}</span>
            </div>
            <div class="mt-4 flex items-center gap-1 text-outline">
                <span class="material-symbols-outlined text-[16px]">horizontal_rule</span>
                <span class="font-label-sm">Stabil</span>
            </div>
        </div>
    </div>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-[24px] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05),0_2px_4px_-1px_rgba(0,0,0,0.03)]">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-headline-md text-on-surface">Stok Trend</h3>
            <div class="flex gap-2">
                <button class="px-3 py-1 text-label-sm font-label-sm bg-surface-variant text-on-surface rounded-md hover:bg-surface-dim transition-colors">Minggu</button>
                <button class="px-3 py-1 text-label-sm font-label-sm bg-primary text-on-primary rounded-md shadow-sm">Bulan</button>
            </div>
        </div>
        
        <div class="h-64 flex items-end justify-between gap-2 md:gap-4 mt-8 pt-4 border-l border-b border-outline-variant relative">
            <div class="absolute left-[-30px] top-0 h-full flex flex-col justify-between text-label-sm text-outline pb-6">
                <span>1k</span>
                <span>500</span>
                <span>0</span>
            </div>
            <div class="w-full flex justify-between items-end h-full px-2 pb-1">
                <div class="w-[8%] bg-primary-container rounded-t-sm h-[40%] hover:bg-primary transition-colors relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-label-sm opacity-0 group-hover:opacity-100 transition-opacity bg-inverse-surface text-inverse-on-surface px-2 py-1 rounded">400</span>
                </div>
                <div class="w-[8%] bg-primary-container rounded-t-sm h-[60%] hover:bg-primary transition-colors relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-label-sm opacity-0 group-hover:opacity-100 transition-opacity bg-inverse-surface text-inverse-on-surface px-2 py-1 rounded">600</span>
                </div>
                <div class="w-[8%] bg-primary-container rounded-t-sm h-[45%] hover:bg-primary transition-colors relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-label-sm opacity-0 group-hover:opacity-100 transition-opacity bg-inverse-surface text-inverse-on-surface px-2 py-1 rounded">450</span>
                </div>
                <div class="w-[8%] bg-primary-container rounded-t-sm h-[80%] hover:bg-primary transition-colors relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-label-sm opacity-0 group-hover:opacity-100 transition-opacity bg-inverse-surface text-inverse-on-surface px-2 py-1 rounded">800</span>
                </div>
                <div class="w-[8%] bg-primary-container rounded-t-sm h-[55%] hover:bg-primary transition-colors relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-label-sm opacity-0 group-hover:opacity-100 transition-opacity bg-inverse-surface text-inverse-on-surface px-2 py-1 rounded">550</span>
                </div>
                <div class="w-[8%] bg-primary-container rounded-t-sm h-[90%] hover:bg-primary transition-colors relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-label-sm opacity-0 group-hover:opacity-100 transition-opacity bg-inverse-surface text-inverse-on-surface px-2 py-1 rounded">900</span>
                </div>
                <div class="w-[8%] bg-primary-container rounded-t-sm h-[75%] hover:bg-primary transition-colors relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-label-sm opacity-0 group-hover:opacity-100 transition-opacity bg-inverse-surface text-inverse-on-surface px-2 py-1 rounded">750</span>
                </div>
            </div>
        </div>
        <div class="flex justify-between px-2 mt-2 text-label-sm text-outline ml-[2px]">
            <span class="w-[8%] text-center">Jan</span>
            <span class="w-[8%] text-center">Feb</span>
            <span class="w-[8%] text-center">Mar</span>
            <span class="w-[8%] text-center">Apr</span>
            <span class="w-[8%] text-center">Mei</span>
            <span class="w-[8%] text-center">Jun</span>
            <span class="w-[8%] text-center">Jul</span>
        </div>
    </div>
</div>
@endsection