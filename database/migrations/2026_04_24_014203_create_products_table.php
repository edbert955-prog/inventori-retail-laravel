<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel categories
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->string('sku')->unique();
            $table->string('name');
            // Menggunakan integer untuk harga (Rupiah jarang pakai desimal) atau decimal
            $table->integer('price'); 
            $table->integer('stock')->default(0);
            // Memperbaiki typo dari gambar, ini untuk notifikasi stok kritis
            $table->integer('minimum_stock')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
