<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // KF-002: Menampilkan daftar produk (Sesuai Gambar 5.1.5)
    public function index(Request $request)
    {
        // 1. Ambil data kategori untuk ditampilkan di Dropdown Filter
        $categories = Category::all();

        // 2. Mulai query produk
        $query = Product::with('category')->latest();

        // 3. Logika Pencarian Nama/SKU Produk
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('sku', 'like', '%' . $request->search . '%');
        }

        // 4. Logika Filter Kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 5. Eksekusi query
        $products = $query->get();

        return view('products.index', compact('products', 'categories'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Menyimpan produk baru beserta gambar
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|unique:products,sku',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi format gambar maksimal 2MB
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
        ]);

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'storage/app/public/products'
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // 2. Memproses pembaruan data produk
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            // Validasi unik untuk SKU, tapi abaikan SKU milik produk ini sendiri
            'sku' => 'required|unique:products,sku,' . $product->id, 
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
        ]);

        // Cek apakah user mengunggah gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari server jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    // 3. Menghapus data produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        try {
            // Hapus file gambar dari server jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            // Hapus data dari database
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
            
        } catch (\Illuminate\Database\QueryException $e) {
            // Ini untuk mencegah error jika produk gagal dihapus karena masih nyangkut di tabel transaksi (Integrity Constraint)
            if ($e->getCode() == "23000") {
                return redirect()->route('products.index')->with('error', 'Gagal: Produk ini tidak bisa dihapus karena sudah memiliki riwayat transaksi!');
            }
            return redirect()->route('products.index')->with('error', 'Terjadi kesalahan saat menghapus produk.');
        }
    }
}