<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Data Akun Pengguna (Sesuai role di SKPL)
        $manajer = User::create([
            'name' => 'Bapak Manajer',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234'), // Password sesuai desain UI kamu
            'role' => 'manajer',
        ]);

        $staf = User::create([
            'name' => 'Mas Staf Gudang',
            'email' => 'staf@gmail.com',
            'password' => Hash::make('staf1234'),
            'role' => 'staf',
        ]);

        // 2. Buat Data Kategori
        $katPakaian = Category::create(['name' => 'Pakaian']);
        $katAksesoris = Category::create(['name' => 'Aksesoris']);
        $katSepatu = Category::create(['name' => 'Sepatu']);

        // 3. Buat Data Produk (Sesuai dengan tabel di desain UI kamu)
        $kaos = Product::create([
            'category_id' => $katPakaian->id,
            'sku' => '800-123',
            'name' => 'Kaos Polos',
            'price' => 112000,
            'stock' => 300,
            'minimum_stock' => 50,
        ]);

        $celana = Product::create([
            'category_id' => $katPakaian->id,
            'sku' => '800-014',
            'name' => 'Celana Jeans',
            'price' => 124000,
            'stock' => 300,
            'minimum_stock' => 50,
        ]);

        $tas = Product::create([
            'category_id' => $katAksesoris->id,
            'sku' => '800-624',
            'name' => 'Tas Ransel',
            'price' => 135000,
            'stock' => 24, // Sengaja dibuat di bawah minimum untuk ngetes notifikasi stok kritis!
            'minimum_stock' => 50,
        ]);

        $sepatu = Product::create([
            'category_id' => $katSepatu->id,
            'sku' => '800-508',
            'name' => 'Sepatu Sneaker',
            'price' => 148000,
            'stock' => 200,
            'minimum_stock' => 50,
        ]);

        // 4. Buat Dummy Transaksi Masuk & Keluar
        $transaksiMasuk = Transaction::create([
            'user_id' => $staf->id,
            'type' => 'masuk',
            'transaction_date' => Carbon::now()->subDays(2), // Transaksi 2 hari yang lalu
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaksiMasuk->id,
            'product_id' => $kaos->id,
            'quantity' => 100,
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaksiMasuk->id,
            'product_id' => $celana->id,
            'quantity' => 50,
        ]);

        $transaksiKeluar = Transaction::create([
            'user_id' => $staf->id,
            'type' => 'keluar',
            'transaction_date' => Carbon::now()->subDay(), // Transaksi kemarin
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaksiKeluar->id,
            'product_id' => $tas->id,
            'quantity' => 5,
        ]);
    }
}
