@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@section('content')
<main class="max-w-5xl mx-auto p-4 sm:p-6 lg:p-8">
    
    <!-- Header -->
    <header class="mb-8">
        <h1 class="text-3xl font-semibold text-gray-900 tracking-tight mb-2">Pengaturan Sistem</h1>
        <p class="text-gray-500">Kelola identitas, branding, dan informasi kontak platform Anda di satu tempat.</p>
    </header>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-8 flex items-start gap-3 shadow-sm">
            <span class="material-symbols-outlined text-emerald-600 mt-0.5">check_circle</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Bagian 1: Branding (Logo & Favicon) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-500 text-[20px]">palette</span>
                    Branding & Logo
                </h2>
                <p class="text-sm text-gray-500 mt-1">Logo yang diunggah akan menggantikan teks bawaan sistem.</p>
            </div>
            
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- App Logo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Logo Aplikasi (Navbar & Login)</label>
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center bg-gray-50 overflow-hidden relative group">
                            @if(isset($settings['app_logo']) && $settings['app_logo'])
                                <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Logo" class="w-full h-full object-contain p-2">
                            @else
                                <span class="material-symbols-outlined text-gray-400 text-3xl">image</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" name="app_logo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors">
                            <p class="mt-2 text-xs text-gray-500">PNG, JPG, SVG maksimal 2MB. Resolusi disarankan 512x512px.</p>
                        </div>
                    </div>
                </div>

                <!-- Favicon -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Favicon (Ikon Browser)</label>
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center bg-gray-50 overflow-hidden">
                            @if(isset($settings['app_favicon']) && $settings['app_favicon'])
                                <img src="{{ asset('storage/' . $settings['app_favicon']) }}" alt="Favicon" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-gray-400">web</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" name="app_favicon" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors">
                            <p class="mt-2 text-xs text-gray-500">Format .ico atau .png maksimal 1MB. Ukuran 32x32px.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian 2: Informasi Umum -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-500 text-[20px]">feed</span>
                    Informasi Umum
                </h2>
            </div>
            
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Aplikasi</label>
                    <input type="text" name="app_name" value="{{ $settings['app_name'] ?? 'Inventori Pro' }}" class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teks Footer</label>
                    <input type="text" name="footer_text" value="{{ $settings['footer_text'] ?? '' }}" class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat (SEO/Landing Page)</label>
                    <textarea name="app_description" rows="3" class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all">{{ $settings['app_description'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Bagian 3: Informasi Kontak -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-500 text-[20px]">contact_support</span>
                    Informasi Kontak
                </h2>
                <p class="text-sm text-gray-500 mt-1">Ditampilkan di landing page dan invoice pelanggan.</p>
            </div>
            
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Bantuan</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-[18px]">mail</span>
                        </div>
                        <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="w-full pl-10 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-[18px]">call</span>
                        </div>
                        <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" class="w-full pl-10 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all">
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Bisnis</label>
                    <div class="relative">
                        <div class="absolute top-3 left-0 pl-3 pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-[18px]">location_on</span>
                        </div>
                        <textarea name="contact_address" rows="2" class="w-full pl-10 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all">{{ $settings['contact_address'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar (Sticky Bottom) -->
        <div class="sticky bottom-6 mt-8 p-4 bg-white/80 backdrop-blur-md rounded-2xl shadow-lg border border-gray-200/50 flex justify-end gap-3 z-10">
            <a href="{{ route('dashboard') }}" class="px-6 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-100 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-medium bg-primary text-white hover:bg-primary-container hover:text-on-primary-container transition-all shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Simpan Perubahan
            </button>
        </div>
    </form>
</main>
@endsection
