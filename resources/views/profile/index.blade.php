@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<main class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
    
    <!-- Header -->
    <header class="mb-8">
        <h1 class="text-3xl font-semibold text-gray-900 tracking-tight mb-2">Profil Saya</h1>
        <p class="text-gray-500">Kelola identitas, alamat email, dan keamanan akun Anda.</p>
    </header>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-8 flex items-start gap-3 shadow-sm">
            <span class="material-symbols-outlined text-emerald-600 mt-0.5">check_circle</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <div class="space-y-8">
        <!-- Bagian 1: Informasi Dasar & Avatar -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-500 text-[20px]">person</span>
                    Informasi Dasar
                </h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui foto profil dan detail identitas Anda.</p>
            </div>
            
            <form action="{{ route('profile.updateBasic') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="flex flex-col md:flex-row gap-8 mb-6">
                    <!-- Avatar Upload -->
                    <div class="shrink-0 flex flex-col items-center gap-3">
                        <div class="w-24 h-24 rounded-full border-2 border-gray-200 bg-gray-50 flex items-center justify-center overflow-hidden relative group">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=128" alt="Avatar" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined text-white">photo_camera</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <label class="cursor-pointer px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors">
                                Pilih Foto
                                <input type="file" name="avatar" class="hidden" accept="image/jpeg,image/png,image/webp">
                            </label>
                            @if($user->avatar)
                                <button type="button" onclick="event.preventDefault(); document.getElementById('delete-avatar-form').submit();" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Foto">
                                    <span class="material-symbols-outlined text-[16px]">delete</span>
                                </button>
                            @endif
                        </div>
                        @error('avatar')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- User Details -->
                    <div class="flex-1 grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all" required>
                            @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all" required>
                            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all">
                            @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-medium bg-primary text-white hover:bg-primary-container hover:text-on-primary-container transition-all shadow-sm">
                        Simpan Profil
                    </button>
                </div>
            </form>

            <form id="delete-avatar-form" action="{{ route('profile.removeAvatar') }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>

        <!-- Bagian 2: Keamanan / Ganti Sandi -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-500 text-[20px]">lock</span>
                    Keamanan Akun
                </h2>
                <p class="text-sm text-gray-500 mt-1">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.</p>
            </div>
            
            <form action="{{ route('profile.updatePassword') }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Saat Ini</label>
                        <input type="password" name="current_password" class="w-full md:w-1/2 px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all" required>
                        @error('current_password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Baru</label>
                        <input type="password" name="password" class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all" required>
                        @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Sandi Baru</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all" required>
                    </div>
                </div>
                
                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-medium bg-gray-900 text-white hover:bg-black transition-all shadow-sm">
                        Perbarui Sandi
                    </button>
                </div>
            </form>
        </div>

    </div>
</main>
@endsection
