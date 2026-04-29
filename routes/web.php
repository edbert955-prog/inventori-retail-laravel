<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome'); // Nanti ini diisi HTML dari Stitch
})->name('home');
// Route untuk Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/laporan', [ProductController::class, 'report'])->name('laporan.index');

// Route yang wajib login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route khusus Manajer (Laporan & Produk)
    Route::middleware(['role:manajer'])->group(function () {
        Route::resource('products', ProductController::class);
        // Route laporan di sini...
    });

    // Route khusus Staf (Transaksi)
    Route::middleware(['role:staf'])->group(function () {
        Route::resource('transactions', TransactionController::class);
    });
});

Route::get('/dashboard', function () {
    // Mengambil data asli dari Database
    $totalProduk = Product::count();
    $stokRendah = Product::whereColumn('stock', '<=', 'minimum_stock')->count();
    $transaksiHariIni = Transaction::whereDate('created_at', Carbon::today())->count();
    $totalKategori = Category::count();

    // Mengirimkan data ke view dashboard.blade.php
    return view('dashboard', compact('totalProduk', 'stokRendah', 'transaksiHariIni', 'totalKategori'));
})->middleware(['auth'])->name('dashboard');