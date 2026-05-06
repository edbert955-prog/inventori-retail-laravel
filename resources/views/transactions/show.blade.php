@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<main class="max-w-4xl mx-auto p-container-padding">
    <!-- Header -->
    <header class="mb-stack-lg">
        <a href="{{ route('transactions.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-primary-container transition-colors font-label-md mb-stack-md group">
            <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
            Kembali ke Riwayat
        </a>
        <h1 class="font-headline-lg text-on-surface mb-stack-sm">Detail Transaksi</h1>
        <p class="font-body-lg text-on-surface-variant">Rincian lengkap item untuk ID: TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</p>
    </header>

    <!-- Card Informasi Utama -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-6 mb-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div>
                <p class="text-sm text-outline mb-1 font-label-md">ID Transaksi</p>
                <p class="font-headline-sm text-on-surface">TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div>
                <p class="text-sm text-outline mb-1 font-label-md">Tanggal & Waktu</p>
                <p class="font-body-lg text-on-surface font-medium">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-outline mb-1 font-label-md">Jenis Transaksi</p>
                @if($transaction->type == 'masuk')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md w-max">
                        <span class="material-symbols-outlined text-[16px]">arrow_downward</span> Masuk
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-fixed-dim text-on-tertiary-fixed-variant font-label-md text-label-md w-max">
                        <span class="material-symbols-outlined text-[16px]">arrow_upward</span> Keluar
                    </span>
                @endif
            </div>
            <div>
                <p class="text-sm text-outline mb-1 font-label-md">Pencatat</p>
                <p class="font-body-lg text-on-surface font-medium">{{ $transaction->user->name ?? 'Sistem' }}</p>
            </div>
        </div>
    </div>

    <!-- Card Daftar Item -->
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant bg-surface-container-low">
            <h2 class="font-headline-sm text-on-surface">Item Transaksi</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="border-b border-outline-variant">
                    <tr>
                        <th class="px-6 py-4 font-label-sm text-on-surface-variant uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 font-label-sm text-on-surface-variant uppercase tracking-wider">SKU</th>
                        <th class="px-6 py-4 font-label-sm text-on-surface-variant uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-4 font-label-sm text-on-surface-variant uppercase tracking-wider text-right">Kuantitas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach($transaction->details as $index => $detail)
                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                        <td class="px-6 py-4 font-body-md text-on-surface">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-body-md text-outline">{{ $detail->product->sku }}</td>
                        <td class="px-6 py-4 font-body-md text-on-surface font-medium">{{ $detail->product->name }}</td>
                        <td class="px-6 py-4 font-body-md text-on-surface font-semibold text-right">
                            {{ $transaction->type == 'masuk' ? '+' : '-' }} {{ $detail->quantity }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-surface-container-low border-t border-outline-variant">
                    <tr>
                        <td colspan="3" class="px-6 py-4 font-headline-sm text-on-surface text-right">Total Item:</td>
                        <td class="px-6 py-4 font-headline-sm text-primary text-right">{{ $transaction->details->sum('quantity') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</main>
@endsection