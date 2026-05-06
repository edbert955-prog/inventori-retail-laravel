<?php

namespace App\Http\Controllers;

    use App\Models\Product; 
    use App\Models\TransactionDetail;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Tarik data transaksi beserta nama user dan detail itemnya
        $query = Transaction::with(['user', 'details'])->orderBy('transaction_date', 'desc');

        // Fitur Filter Jenis (Masuk/Keluar)
        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        // Fitur Search ID Transaksi
        if ($request->filled('search')) {
            $query->where('id', 'like', '%' . str_replace('TRX-', '', $request->search) . '%');
        }

        $transactions = $query->paginate(10); // Menampilkan 10 data per halaman

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        // Mengambil semua produk untuk ditampilkan di dropdown
        $products = Product::orderBy('name')->get();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Dasar
        $request->validate([
            'type' => 'required|in:masuk,keluar',
            'transaction_date' => 'required|date',
            'product_id' => 'required|array|min:1', // Harus berupa array dan minimal 1 produk
            'product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|numeric|min:1',
        ]);

        // Gunakan DB Transaction agar jika ada yang gagal (misal stok tidak cukup), semuanya dibatalkan
        try {
            DB::beginTransaction();

            // 2. Buat Header Transaksi
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'type' => $request->type,
                'transaction_date' => $request->transaction_date,
            ]);

            // 3. Looping untuk menyimpan detail item dan mengupdate stok produk
            foreach ($request->product_id as $key => $productId) {
                $qty = $request->quantity[$key];
                $product = Product::findOrFail($productId);

                // Validasi Stok Keluar (Tidak boleh lebih dari stok yang ada)
                if ($request->type == 'keluar' && $product->stock < $qty) {
                    throw new \Exception("Stok {$product->name} tidak mencukupi. Sisa stok: {$product->stock}");
                }

                // Update Stok Produk
                if ($request->type == 'masuk') {
                    $product->stock += $qty;
                } else {
                    $product->stock -= $qty;
                }
                $product->save();

                // Simpan ke tabel pivot transaction_details
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productId,
                    'quantity' => $qty,
                ]);
            }

            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dicatat dan stok telah diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
}

// Menampilkan detail spesifik dari sebuah transaksi
    public function show($id)
    {
        // Mengambil transaksi beserta data user pencatat dan relasi detail -> produknya
        $transaction = Transaction::with(['user', 'details.product'])->findOrFail($id);
        
        return view('transactions.show', compact('transaction'));
    }
}