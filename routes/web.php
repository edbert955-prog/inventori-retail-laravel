<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HelpController;

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
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister']);
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/laporan', [ProductController::class, 'report'])->name('laporan.index');

// Route yang wajib login
Route::middleware(['auth'])->group(function () {
    Route::get('/help', [HelpController::class, 'index'])->name('help.index');
    Route::get('/help/{slug}', [HelpController::class, 'show'])->name('help.show');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/basic', [App\Http\Controllers\ProfileController::class, 'updateBasic'])->name('profile.updateBasic');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile/avatar', [App\Http\Controllers\ProfileController::class, 'removeAvatar'])->name('profile.removeAvatar');

    // Notifikasi
    Route::post('/notifications/{id}/read', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back();
    })->name('notifications.read');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // === RUTE TRANSAKSI ===
    // 1. Index (Daftar Transaksi)
    Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');

    // 2. Create (Form Tambah) -> WAJIB DI ATAS {id}
    Route::get('/transactions/create', [App\Http\Controllers\TransactionController::class, 'create'])->name('transactions.create');

    // 3. Store (Simpan Data)
    Route::post('/transactions', [App\Http\Controllers\TransactionController::class, 'store'])->name('transactions.store');

    // 4. Show (Detail Transaksi) -> WAJIB DI BAWAH create
    Route::get('/transactions/{id}', [App\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show');
    
    // Route khusus Manajer (Laporan & Produk)
    Route::middleware(['role:manajer'])->group(function () {
        Route::resource('products', ProductController::class);
        // Route laporan di sini...
        // Rute untuk melihat detail transaksi spesifik
    
    });

    // Route khusus Staf (Transaksi)
    Route::middleware(['role:staf'])->group(function () {
        Route::resource('transactions', TransactionController::class);
    });
});

Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');

Route::get('/transactions/create', [App\Http\Controllers\TransactionController::class, 'create'])->name('transactions.create');
Route::post('/transactions', [App\Http\Controllers\TransactionController::class, 'store'])->name('transactions.store');

Route::get('/dashboard', function () {
    // Mengambil data asli dari Database
    $totalProduk = Product::count();
    $stokRendah = Product::whereColumn('stock', '<=', 'minimum_stock')->count();
    $transaksiHariIni = Transaction::whereDate('created_at', Carbon::today())->count();
    $totalKategori = Category::count();

    // Mengirimkan data ke view dashboard.blade.php
    return view('dashboard', compact('totalProduk', 'stokRendah', 'transaksiHariIni', 'totalKategori'));
})->middleware(['auth'])->name('dashboard');