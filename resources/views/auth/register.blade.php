<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daftar - {{ setting('app_name', 'Inventori Pro') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300,0&display=swap" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f8f9ff',
                            100: '#dae2ff',
                            800: '#0047ab',
                            900: '#00327d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900 min-h-screen flex selection:bg-brand-100 selection:text-brand-900">
    
    <!-- Left Side: Branding / Visual (Hidden on mobile) -->
    <div class="hidden lg:flex w-1/2 relative overflow-hidden flex-col justify-between p-16 group">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/Apa-itu-Inventory.jpg') }}" alt="Inventory Cover" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-[20s] ease-out" />
            <!-- Soft Dark Overlay -->
            <div class="absolute inset-0 bg-brand-900/60 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent"></div>
        </div>

        <!-- Logo -->
        <a href="/" class="relative z-10 flex items-center gap-2 hover:opacity-80 transition-opacity w-max">
            @if(setting('app_logo'))
                <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo" class="h-8 w-auto object-contain drop-shadow-md">
            @else
                <div class="w-8 h-8 bg-brand-900 rounded-lg flex items-center justify-center shadow-sm">
                    <span class="material-symbols-outlined text-white text-[16px]">inventory_2</span>
                </div>
            @endif
            <span class="font-semibold tracking-tight text-white text-lg drop-shadow-md">{{ setting('app_name', 'Inventori Pro') }}</span>
        </a>
        
        <!-- Testimonial / Branding Statement -->
        <div class="relative z-10 max-w-lg mb-10">
            <h2 class="text-4xl font-semibold text-white tracking-tight leading-[1.1] mb-8 drop-shadow-lg">
                "Pencatatan yang lebih tenang, untuk toko yang lebih berkembang."
            </h2>
            <div class="flex items-center gap-5">
                <div class="flex -space-x-3">
                    <img class="w-12 h-12 rounded-full border-[3px] border-white object-cover shadow-sm" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&h=100" alt="User">
                    <img class="w-12 h-12 rounded-full border-[3px] border-white object-cover shadow-sm" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=100&h=100" alt="User">
                    <img class="w-12 h-12 rounded-full border-[3px] border-white object-cover shadow-sm" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&h=100" alt="User">
                </div>
                <div>
                    <p class="font-semibold text-white text-sm drop-shadow-md">Bergabung dengan ratusan toko</p>
                    <p class="text-gray-300 text-sm drop-shadow-md">Merapikan operasional setiap hari.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Auth Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-24 relative overflow-y-auto">
        
        <!-- Mobile Logo (only visible on small screens) -->
        <a href="/" class="absolute top-8 left-8 flex lg:hidden items-center gap-2">
            @if(setting('app_logo'))
                <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo" class="h-8 w-auto object-contain">
            @else
                <div class="w-8 h-8 bg-brand-900 rounded-lg flex items-center justify-center shadow-sm">
                    <span class="material-symbols-outlined text-white text-[16px]">inventory_2</span>
                </div>
            @endif
            <span class="font-semibold tracking-tight text-brand-900">{{ setting('app_name', 'Inventori Pro') }}</span>
        </a>

        <div class="w-full max-w-[400px]">
            <div class="mb-10 text-center lg:text-left mt-12 lg:mt-0">
                <h1 class="text-3xl font-semibold text-gray-900 tracking-tight mb-3">Buat Akun Baru</h1>
                <p class="text-gray-500">Mulai rapikan stok toko Anda hari ini.</p>
            </div>

            @if($errors->any())
            <div class="bg-red-50 border border-red-100 p-4 rounded-xl flex flex-col gap-1 mb-8">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-red-500 text-[20px]">error</span>
                    <p class="text-sm text-red-700 font-medium">Terjadi Kesalahan:</p>
                </div>
                <ul class="list-disc list-inside text-sm text-red-600 pl-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf 

                <!-- Name Input -->
                <div class="space-y-2.5">
                    <label class="text-sm font-medium text-gray-700" for="name">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-[18px]">person</span>
                        </div>
                        <input class="w-full pl-10 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:outline-none focus:border-brand-900 focus:ring-4 focus:ring-brand-100 transition-all placeholder:text-gray-400" 
                               id="name" 
                               name="name" 
                               placeholder="Nama Lengkap Anda" 
                               type="text" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus/>
                    </div>
                </div>

                <!-- Email Input -->
                <div class="space-y-2.5">
                    <label class="text-sm font-medium text-gray-700" for="email">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-[18px]">mail</span>
                        </div>
                        <input class="w-full pl-10 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:outline-none focus:border-brand-900 focus:ring-4 focus:ring-brand-100 transition-all placeholder:text-gray-400" 
                               id="email" 
                               name="email" 
                               placeholder="nama@toko.com" 
                               type="email" 
                               value="{{ old('email') }}" 
                               required/>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-2.5">
                    <label class="text-sm font-medium text-gray-700" for="password">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-[18px]">lock</span>
                        </div>
                        <input class="w-full pl-10 pr-12 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:outline-none focus:border-brand-900 focus:ring-4 focus:ring-brand-100 transition-all placeholder:text-gray-400" 
                               id="password" 
                               name="password" 
                               placeholder="Min. 8 karakter" 
                               type="password" 
                               required/>
                        <button type="button" onclick="togglePassword('password', 'eye-icon')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                            <span class="material-symbols-outlined text-[18px]" id="eye-icon">visibility_off</span>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password Input -->
                <div class="space-y-2.5">
                    <label class="text-sm font-medium text-gray-700" for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 text-[18px]">lock_reset</span>
                        </div>
                        <input class="w-full pl-10 pr-12 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:outline-none focus:border-brand-900 focus:ring-4 focus:ring-brand-100 transition-all placeholder:text-gray-400" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Ulangi kata sandi" 
                               type="password" 
                               required/>
                        <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-confirm')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                            <span class="material-symbols-outlined text-[18px]" id="eye-icon-confirm">visibility_off</span>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button class="w-full bg-brand-900 text-white font-medium text-sm py-3.5 px-4 rounded-xl hover:bg-gray-800 transition-all shadow-lg shadow-brand-900/15 active:scale-[0.98] flex items-center justify-center gap-2 group" 
                            type="submit">
                        Daftar Akun
                        <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
                
                <div class="text-center mt-8">
                    <p class="text-sm text-gray-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-brand-900 hover:text-brand-800 transition-colors">Masuk di sini</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility_off';
            }
        }
    </script>
</body>
</html>
