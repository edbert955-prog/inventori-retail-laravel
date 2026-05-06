@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<main class="max-w-7xl mx-auto flex flex-col gap-stack-lg p-container-padding">
    <!-- Header Section -->
    <header class="flex flex-col gap-stack-sm">
        <h1 class="font-headline-lg text-headline-lg text-on-surface">Riwayat Transaksi</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant">Pantau aktivitas barang masuk dan keluar dari gudang.</p>
    </header>

    <!-- Action Bar -->
    <form action="{{ route('transactions.index') }}" method="GET" class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-stack-md w-full">
        <div class="flex flex-col sm:flex-row gap-stack-md w-full sm:w-auto">
            <!-- Search -->
            <div class="relative w-full sm:w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="Cari ID (Cth: 1)..." type="text"/>
            </div>
            
            <!-- Filter -->
            <div class="relative w-full sm:w-48">
                <select name="type" onchange="this.form.submit()" class="w-full pl-4 pr-10 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface appearance-none focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors cursor-pointer">
                    <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>Semua Jenis</option>
                    <option value="masuk" {{ request('type') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                    <option value="keluar" {{ request('type') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                </select>
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">arrow_drop_down</span>
            </div>
            
            @if(request('search') || (request('type') && request('type') != 'all'))
                <a href="{{ route('transactions.index') }}" class="text-sm text-error hover:underline whitespace-nowrap self-center ml-2">Reset</a>
            @endif
        </div>
        
        <!-- Primary Action -->
        <a href="{{ route('transactions.create') }}" class="flex items-center justify-center gap-2 bg-primary text-on-primary font-label-md text-label-md px-6 py-2.5 rounded-lg hover:shadow-md hover:bg-primary-container transition-all active:scale-95 w-full sm:w-auto shrink-0">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Catat Transaksi
        </a>
    </form>

    <!-- Data Table Card -->
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05),0_2px_4px_-1px_rgba(0,0,0,0.03)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead class="bg-surface-container-low border-b border-outline-variant">
                    <tr>
                        <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider whitespace-nowrap">ID Transaksi</th>
                        <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider whitespace-nowrap">Tanggal</th>
                        <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider whitespace-nowrap">Jenis</th>
                        <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider whitespace-nowrap">Pencatat</th>
                        <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider whitespace-nowrap text-right">Total Item</th>
                        <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider whitespace-nowrap text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant bg-surface-container-lowest">
                    
                    @forelse ($transactions as $transaction)
                    <tr class="hover:bg-surface-container-low/50 transition-colors group">
                        <td class="px-6 py-4 font-body-md text-body-md text-on-surface font-semibold">TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 font-body-md text-body-md text-on-surface-variant">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y, H:i') }}</td>
                        
                        <!-- Logika Warna Badge Berdasarkan Jenis[cite: 2] -->
                        <td class="px-6 py-4">
                            @if($transaction->type == 'masuk')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md w-max">
                                    <span class="material-symbols-outlined text-[16px]">arrow_downward</span> Masuk
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-fixed-dim text-on-tertiary-fixed-variant font-label-md text-label-md w-max">
                                    <span class="material-symbols-outlined text-[16px]">arrow_upward</span> Keluar
                                </span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 font-body-md text-body-md text-on-surface">{{ $transaction->user->name ?? 'Sistem' }}</td>
                        
                        <!-- Menjumlahkan kuantitas dari detail transaksi -->
                        <td class="px-6 py-4 font-body-md text-body-md text-on-surface font-semibold text-right">
                            {{ $transaction->type == 'masuk' ? '+' : '-' }} {{ $transaction->details->sum('quantity') }}
                        </td>
                        
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('transactions.show', $transaction->id) }}" class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-outline">Belum ada riwayat transaksi.</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <!-- Pagination Bawaan Laravel -->
        <div class="px-6 py-4 border-t border-outline-variant bg-surface-container-lowest">
            {{ $transactions->links() }}
        </div>
    </div>
</main>
@endsection