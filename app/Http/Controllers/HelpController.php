<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HelpController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->query('q', '');

        // Mock data for Help Center (Easily portable to DB/CMS later)
        $categories = [
            [
                'icon' => 'rocket_launch',
                'title' => 'Memulai (Quick Start)',
                'description' => 'Panduan dasar untuk menyiapkan toko Anda.',
                'color' => 'bg-emerald-50 text-emerald-600',
                'articles' => [
                    'Cara menambah produk pertama',
                    'Mengatur stok minimum',
                    'Memahami dashboard'
                ]
            ],
            [
                'icon' => 'inventory_2',
                'title' => 'Manajemen Produk',
                'description' => 'Segala hal tentang katalog dan stok.',
                'color' => 'bg-blue-50 text-blue-600',
                'articles' => [
                    'Mengelompokkan produk dengan kategori',
                    'Apa itu SKU?',
                    'Menghapus atau menonaktifkan produk'
                ]
            ],
            [
                'icon' => 'receipt_long',
                'title' => 'Transaksi Barang',
                'description' => 'Pencatatan barang masuk dan keluar.',
                'color' => 'bg-purple-50 text-purple-600',
                'articles' => [
                    'Cara mencatat barang masuk (Restock)',
                    'Cara mencatat penjualan (Keluar)',
                    'Membatalkan transaksi'
                ]
            ],
            [
                'icon' => 'build',
                'title' => 'Troubleshooting',
                'description' => 'Solusi untuk masalah yang sering terjadi.',
                'color' => 'bg-orange-50 text-orange-600',
                'articles' => [
                    'Mengapa stok tidak berkurang?',
                    'Lupa password',
                    'Data transaksi tidak sinkron'
                ]
            ]
        ];

        return view('help.index', compact('categories', 'searchQuery'));
    }

    public function show($slug)
    {
        // Decode the slug back to a readable title format for display purposes
        // In a real application, you would query the database using the slug
        $title = ucwords(str_replace('-', ' ', $slug));
        
        return view('help.show', compact('title'));
    }
}
