@extends('layouts.public')

@section('content')

<!-- HERO -->
<section class="relative pt-32 pb-20 px-6 overflow-hidden">
    <!-- Subtle background gradient/glow -->
    <div class="absolute top-[-10%] left-1/2 -translate-x-1/2 w-full max-w-4xl h-[500px] bg-gradient-to-b from-gray-100 to-transparent -z-10 blur-[100px] opacity-70 rounded-full"></div>
    
    <div class="max-w-7xl mx-auto text-center">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-50 border border-gray-200 text-gray-600 text-xs font-medium mb-8 hover:bg-gray-100 transition cursor-pointer">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            Inventori Pro 2.0 kini tersedia
        </div>
        
        <!-- Headline -->
        <h1 class="text-5xl md:text-[5.5rem] font-semibold text-brand-900 tracking-tighter leading-[1.05] mb-8">
            Pencatatan toko,<br/>
            <span class="text-gray-400">dibuat sangat sederhana.</span>
        </h1>
        
        <!-- Subheadline -->
        <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed mb-10">
            Tinggalkan buku catatan dan spreadsheet yang rumit. Inventori Pro memberikan kontrol penuh atas stok dan transaksi Anda dalam antarmuka yang cepat, tenang, dan indah.
        </p>
        
        <!-- CTA -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('login') }}" class="bg-brand-900 text-white px-8 py-4 rounded-xl text-sm font-medium hover:bg-gray-800 transition shadow-lg shadow-gray-900/10 w-full sm:w-auto flex items-center justify-center gap-2">
                Mulai gunakan gratis
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
            <a href="#fitur" class="bg-white border border-gray-200 text-brand-900 px-8 py-4 rounded-xl text-sm font-medium hover:bg-gray-50 transition w-full sm:w-auto">
                Eksplorasi fitur
            </a>
        </div>
    </div>

    <!-- UI Mockup -->
    <div class="max-w-5xl mx-auto mt-24 relative perspective-1000">
        <!-- Glow -->
        <div class="absolute inset-0 bg-gradient-to-tr from-gray-200/50 to-gray-50/10 blur-2xl -z-10 rounded-[2rem]"></div>
        
        <div class="bg-white rounded-2xl border border-gray-200 shadow-bento overflow-hidden">
            <!-- Mac header -->
            <div class="bg-gray-50/80 border-b border-gray-100 px-6 py-4 flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                <div class="w-3 h-3 rounded-full bg-gray-300"></div>
            </div>
            
            <div class="p-8 flex gap-8">
                <!-- Sidebar Mockup -->
                <div class="w-48 hidden md:flex flex-col gap-3">
                    <div class="h-8 bg-gray-100 rounded-lg w-full mb-4"></div>
                    <div class="h-8 bg-gray-50 hover:bg-gray-100 transition rounded-lg w-3/4"></div>
                    <div class="h-8 bg-gray-50 hover:bg-gray-100 transition rounded-lg w-5/6"></div>
                    <div class="h-8 bg-gray-50 hover:bg-gray-100 transition rounded-lg w-4/5 mt-4"></div>
                </div>
                
                <!-- Main Content Mockup -->
                <div class="flex-1">
                    <div class="flex justify-between items-end mb-8">
                        <div>
                            <div class="text-2xl font-semibold text-brand-900 mb-1 tracking-tight">Overview Stok</div>
                            <div class="text-sm text-gray-500">Pergerakan barang hari ini</div>
                        </div>
                        <div class="h-9 w-28 bg-brand-900 rounded-lg shadow-sm"></div>
                    </div>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-3 gap-4 mb-8">
                        <div class="p-5 rounded-xl border border-gray-100 bg-gray-50/50 shadow-sm">
                            <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center mb-4 shadow-sm">
                                <span class="material-symbols-outlined text-[16px] text-gray-600">inventory_2</span>
                            </div>
                            <div class="text-3xl font-semibold text-brand-900 mb-1 tracking-tight">1,248</div>
                            <div class="text-xs font-medium text-gray-500">TOTAL BARANG</div>
                        </div>
                        <div class="p-5 rounded-xl border border-gray-100 bg-gray-50/50 shadow-sm">
                            <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center mb-4 shadow-sm">
                                <span class="material-symbols-outlined text-[16px] text-gray-600">shopping_cart</span>
                            </div>
                            <div class="text-3xl font-semibold text-brand-900 mb-1 tracking-tight">84</div>
                            <div class="text-xs font-medium text-gray-500">TRANSAKSI HARI INI</div>
                        </div>
                        <div class="p-5 rounded-xl border border-red-100 bg-red-50/50 shadow-sm">
                            <div class="w-8 h-8 rounded-lg bg-white border border-red-100 flex items-center justify-center mb-4 shadow-sm">
                                <span class="material-symbols-outlined text-[16px] text-red-500">warning</span>
                            </div>
                            <div class="text-3xl font-semibold text-red-600 mb-1 tracking-tight">12</div>
                            <div class="text-xs font-medium text-red-500">STOK MENIPIS</div>
                        </div>
                    </div>
                    
                    <!-- Table Mockup -->
                    <div class="border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                        <div class="bg-gray-50 px-5 py-3 border-b border-gray-100 flex gap-4 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                            <div class="flex-1">Nama Barang</div>
                            <div class="w-24">SKU</div>
                            <div class="w-20 text-right">Stok</div>
                        </div>
                        <div class="px-5 py-4 border-b border-gray-50 flex items-center gap-4 text-sm bg-white hover:bg-gray-50 transition">
                            <div class="flex-1 font-medium text-brand-900">Beras Premium 5kg</div>
                            <div class="w-24 text-gray-500">BRS-001</div>
                            <div class="w-20 text-right font-semibold text-brand-900">45</div>
                        </div>
                        <div class="px-5 py-4 flex items-center gap-4 text-sm bg-red-50/30 hover:bg-red-50/60 transition">
                            <div class="flex-1 font-medium text-brand-900">Minyak Goreng 2L</div>
                            <div class="w-24 text-gray-500">MYK-002</div>
                            <div class="w-20 text-right font-semibold text-red-600">3</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BENTO GRID FEATURES -->
<section id="fitur" class="py-32 px-6 max-w-7xl mx-auto">
    <div class="text-center mb-24">
        <h2 class="text-3xl md:text-5xl font-semibold text-brand-900 tracking-tight mb-6">Segala yang Anda butuhkan,<br/><span class="text-gray-400">tidak ada yang tidak perlu.</span></h2>
        <p class="text-gray-500 text-lg max-w-2xl mx-auto leading-relaxed">Kami membuang fitur-fitur kompleks yang tidak pernah Anda gunakan, dan menyempurnakan fitur inti yang Anda pakai setiap hari.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-[340px]">
        
        <!-- Bento 1 (Large) -->
        <div class="md:col-span-2 rounded-[2rem] bg-gray-50 border border-gray-200/60 p-10 relative overflow-hidden group hover:border-gray-300 transition-colors">
            <div class="absolute inset-0 bg-gradient-to-br from-white/60 to-transparent"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 rounded-xl bg-white border border-gray-200 flex items-center justify-center mb-6 shadow-sm">
                    <span class="material-symbols-outlined text-gray-700">sync</span>
                </div>
                <h3 class="text-2xl font-semibold text-brand-900 mb-3 tracking-tight">Sinkronisasi Real-time</h3>
                <p class="text-gray-500 max-w-sm leading-relaxed">Setiap barang yang terjual atau masuk langsung mengupdate stok. Anda tidak perlu merefresh halaman untuk melihat data terbaru.</p>
            </div>
            
            <!-- Interactive Visual -->
            <div class="absolute -right-4 -bottom-10 w-96 bg-white rounded-2xl border border-gray-200 shadow-bento p-6 rotate-[-4deg] group-hover:rotate-0 group-hover:-translate-y-2 transition-all duration-500">
                <div class="flex items-center gap-4 border-b border-gray-100 pb-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-emerald-500 text-[18px]">south_west</span>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-brand-900">Restock Barang Masuk</div>
                        <div class="text-xs text-gray-500">Hari ini, 14:00</div>
                    </div>
                    <div class="text-emerald-500 font-semibold">+20</div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-500 text-[18px]">north_east</span>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-brand-900">Penjualan Toko</div>
                        <div class="text-xs text-gray-500">Hari ini, 14:15</div>
                    </div>
                    <div class="text-red-500 font-semibold">-5</div>
                </div>
            </div>
        </div>
        
        <!-- Bento 2 (Small) -->
        <div class="rounded-[2rem] bg-gray-50 border border-gray-200/60 p-10 relative overflow-hidden group hover:border-gray-300 transition-colors">
            <div class="relative z-10">
                <div class="w-12 h-12 rounded-xl bg-white border border-gray-200 flex items-center justify-center mb-6 shadow-sm">
                    <span class="material-symbols-outlined text-gray-700">notifications</span>
                </div>
                <h3 class="text-2xl font-semibold text-brand-900 mb-3 tracking-tight">Peringatan Stok</h3>
                <p class="text-gray-500 leading-relaxed">Visualisasi instan saat barang mencapai batas minimum.</p>
            </div>
            
            <div class="absolute bottom-8 left-8 right-8 bg-white rounded-xl border border-red-100 shadow-bento flex items-center p-4 gap-3 translate-y-4 group-hover:translate-y-0 opacity-80 group-hover:opacity-100 transition-all duration-300">
                <div class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-red-500 text-[16px]">warning</span>
                </div>
                <div>
                    <div class="text-sm font-semibold text-brand-900">Minyak Kritis</div>
                    <div class="text-xs text-gray-500">Sisa 3 pcs di gudang</div>
                </div>
            </div>
        </div>
        
        <!-- Bento 3 (Small) -->
        <div class="rounded-[2rem] bg-gray-50 border border-gray-200/60 p-10 relative overflow-hidden hover:border-gray-300 transition-colors">
            <div class="relative z-10">
                <div class="w-12 h-12 rounded-xl bg-white border border-gray-200 flex items-center justify-center mb-6 shadow-sm">
                    <span class="material-symbols-outlined text-gray-700">history_edu</span>
                </div>
                <h3 class="text-2xl font-semibold text-brand-900 mb-3 tracking-tight">Audit Log Detail</h3>
                <p class="text-gray-500 leading-relaxed">Lacak siapa yang mencatat atau menghapus transaksi. Akuntabilitas penuh untuk seluruh staf.</p>
            </div>
        </div>
        
        <!-- Bento 4 (Large Dark) -->
        <div class="md:col-span-2 rounded-[2rem] bg-brand-900 p-10 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-tr from-brand-900 to-gray-800"></div>
            
            <div class="relative z-10">
                <div class="w-12 h-12 rounded-xl bg-white/10 border border-white/10 flex items-center justify-center mb-6 backdrop-blur-md">
                    <span class="material-symbols-outlined text-white">analytics</span>
                </div>
                <h3 class="text-2xl font-semibold text-white mb-3 tracking-tight">Data menjadi wawasan</h3>
                <p class="text-gray-400 max-w-sm leading-relaxed">Sistem otomatis mengubah rutinitas pencatatan Anda menjadi grafik pergerakan barang yang mudah dibaca dan dipahami.</p>
            </div>
            
            <!-- Abstract Chart Decor -->
            <div class="absolute right-0 bottom-0 w-3/4 h-56 flex items-end gap-3 px-8 opacity-70 group-hover:opacity-100 transition-opacity duration-500">
                <div class="flex-1 bg-white/5 hover:bg-white/20 transition-colors rounded-t-xl h-[35%]"></div>
                <div class="flex-1 bg-white/10 hover:bg-white/20 transition-colors rounded-t-xl h-[55%]"></div>
                <div class="flex-1 bg-white/15 hover:bg-white/25 transition-colors rounded-t-xl h-[40%]"></div>
                <div class="flex-1 bg-white/30 rounded-t-xl h-[85%] relative shadow-[0_0_30px_rgba(255,255,255,0.2)]">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-white text-brand-900 px-3 py-1 rounded-lg text-xs font-bold shadow-lg">Puncak</div>
                </div>
                <div class="flex-1 bg-white/10 hover:bg-white/20 transition-colors rounded-t-xl h-[50%]"></div>
                <div class="flex-1 bg-white/5 hover:bg-white/20 transition-colors rounded-t-xl h-[25%]"></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-32 px-6">
    <div class="max-w-4xl mx-auto text-center bg-gray-50 rounded-[2rem] border border-gray-200/60 p-16 shadow-sm">
        <h2 class="text-3xl md:text-5xl font-semibold text-brand-900 tracking-tight mb-6">Siap merapikan toko Anda?</h2>
        <p class="text-gray-500 text-lg mb-10 max-w-lg mx-auto">Proses setup memakan waktu kurang dari 2 menit. Tambahkan barang pertama Anda hari ini juga.</p>
        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-brand-900 text-white px-8 py-4 rounded-xl font-medium hover:bg-gray-800 transition shadow-lg shadow-gray-900/10 hover:-translate-y-0.5">
            Mulai uji coba gratis
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    </div>
</section>

@endsection