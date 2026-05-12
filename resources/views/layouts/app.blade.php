<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ setting('app_name', 'Inventori Pro') }} - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-fixed-dim": "#4ae183", "error": "#ba1a1a", "surface-container": "#e6eeff",
                        "primary-container": "#0047ab", "surface-tint": "#2559bd", "secondary": "#006d37",
                        "outline-variant": "#c3c6d5", "inverse-primary": "#b1c5ff", "surface-dim": "#d0dbed",
                        "on-tertiary": "#ffffff", "surface-variant": "#d9e3f6", "on-primary": "#ffffff",
                        "primary-fixed": "#dae2ff", "on-background": "#121c2a", "surface-container-high": "#dee9fc",
                        "on-surface-variant": "#434653", "surface": "#f8f9ff", "primary": "#00327d",
                        "inverse-on-surface": "#eaf1ff", "on-primary-container": "#a5bdff", "on-secondary": "#ffffff",
                        "on-tertiary-container": "#ffae42", "on-error": "#ffffff", "inverse-surface": "#27313f",
                        "on-tertiary-fixed": "#2b1700", "surface-container-highest": "#d9e3f6", "background": "#f8f9ff",
                        "surface-bright": "#f8f9ff", "error-container": "#ffdad6", "tertiary-fixed": "#ffddb9",
                        "tertiary-container": "#6f4400", "surface-container-low": "#eff4ff", "secondary-fixed": "#6bfe9c",
                        "on-primary-fixed-variant": "#00419e", "on-error-container": "#93000a", "tertiary": "#503000",
                        "outline": "#737784", "on-secondary-fixed": "#00210c", "on-secondary-container": "#00743a",
                        "on-primary-fixed": "#001946", "on-tertiary-fixed-variant": "#663e00", "on-surface": "#121c2a",
                        "on-secondary-fixed-variant": "#005228", "surface-container-lowest": "#ffffff",
                        "secondary-container": "#6bfe9c", "tertiary-fixed-dim": "#ffb961", "primary-fixed-dim": "#b1c5ff"
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                    spacing: { "stack-md": "16px", "sidebar-width": "260px", "container-padding": "32px", "unit": "4px", "gutter": "24px", "stack-sm": "8px", "stack-lg": "24px" },
                    fontFamily: {
                        "label-sm": ["Manrope"], "headline-lg": ["Manrope"], "body-md": ["Manrope"],
                        "body-lg": ["Manrope"], "headline-sm": ["Manrope"], "label-md": ["Manrope"], "headline-md": ["Manrope"]
                    },
                    fontSize: {
                        "label-sm": ["11px", { lineHeight: "14px", fontWeight: "700" }],
                        "headline-lg": ["30px", { lineHeight: "40px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "body-md": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                        "body-lg": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "headline-sm": ["18px", { lineHeight: "26px", fontWeight: "600" }],
                        "label-md": ["12px", { lineHeight: "16px", letterSpacing: "0.02em", fontWeight: "600" }],
                        "headline-md": ["24px", { lineHeight: "32px", letterSpacing: "-0.01em", fontWeight: "600" }]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-outlined[data-weight="fill"] { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex">

    <aside class="fixed left-0 top-0 h-full w-[260px] bg-slate-900 border-r border-slate-800 shadow-xl flex flex-col py-6 z-20 transition-colors duration-200 hidden md:flex">
        <div class="px-6 mb-8 flex items-center gap-3">
            @if(setting('app_logo'))
                <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo" class="h-8 w-auto object-contain bg-white/10 rounded p-1">
            @else
                <div class="w-8 h-8 bg-blue-600 rounded-md flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-[16px]">inventory_2</span>
                </div>
            @endif
            <div>
                <h1 class="text-lg font-black text-white font-headline-sm leading-tight">{{ setting('app_name', 'Inventori Pro') }}</h1>
                <p class="text-slate-400 font-label-sm mt-0.5">Sistem Manajemen</p>
            </div>
        </div>
        <nav class="flex-1 overflow-y-auto px-4 space-y-2">
            <a class="{{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg mx-2 my-1 flex items-center px-4 py-3 gap-3 transition-colors duration-200 group" href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span class="font-label-md">Dashboard</span>
            </a>
            <a class="{{ request()->routeIs('products.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg mx-2 my-1 flex items-center px-4 py-3 gap-3 transition-colors duration-200 group" href="{{ route('products.index') }}">
                <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                <span class="font-label-md">Produk</span>
            </a>
            <a class="{{ request()->routeIs('transactions.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg mx-2 my-1 flex items-center px-4 py-3 gap-3 transition-colors duration-200 group" href="{{ route('transactions.index') }}">
                <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                <span class="font-label-md">Transaksi</span>
            </a>
            <a class="{{ request()->routeIs('laporan.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg mx-2 my-1 flex items-center px-4 py-3 gap-3 transition-colors duration-200 group" href="#">
                <span class="material-symbols-outlined text-[20px]">analytics</span>
                <span class="font-label-md">Laporan</span>
            </a>
        </nav>
        <div class="px-4 mt-auto pt-6 border-t border-slate-800 space-y-2">
            <a class="{{ request()->routeIs('settings.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg mx-2 my-1 flex items-center px-4 py-3 gap-3 transition-colors duration-200" href="{{ route('settings.index') }}">
                <span class="material-symbols-outlined text-[20px]">settings</span>
                <span class="font-label-md">Pengaturan</span>
            </a>
            <a class="{{ request()->routeIs('help.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} rounded-lg mx-2 my-1 flex items-center px-4 py-3 gap-3 transition-colors duration-200" href="{{ route('help.index') }}">
                <span class="material-symbols-outlined text-[20px]">help_outline</span>
                <span class="font-label-md">Pusat Bantuan</span>
            </a>
        </div>
    </aside>

    <div class="flex-1 ml-0 md:ml-[260px] flex flex-col min-h-screen">
        
        <header class="docked full-width top-0 border-b border-gray-200 shadow-sm bg-white z-10 transition-all duration-200">
            <div class="flex justify-between items-center h-16 px-6 w-full">
                <button class="md:hidden text-gray-600 hover:bg-gray-50 p-2 rounded-lg transition-all duration-200 active:scale-95">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-blue-700 font-headline-md md:hidden">{{ setting('app_name', 'Inventori Pro') }}</h2>
                    <h2 class="text-on-surface font-headline-md hidden md:block">@yield('title', 'Dashboard')</h2>
                </div>

                <div class="hidden lg:flex items-center bg-surface-container-low rounded-full px-4 py-2 w-64 border border-outline-variant focus-within:border-primary focus-within:ring-2 focus-within:ring-primary-fixed transition-all mr-auto ml-12">
                    <span class="material-symbols-outlined text-outline mr-2 text-[20px]">search</span>
                    <input class="bg-transparent border-none outline-none text-body-md w-full text-on-surface placeholder-outline focus:ring-0" placeholder="Cari sesuatu..." type="text">
                </div>

                <div class="flex items-center gap-2">
                    <!-- Notification Dropdown -->
                    <div class="relative hidden sm:block">
                        <button id="notification-btn" class="relative text-gray-600 hover:bg-gray-50 p-2 rounded-full transition-all duration-200 active:scale-95">
                            <span class="material-symbols-outlined text-[20px]">notifications</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute top-1 right-1.5 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            @endif
                        </button>

                        <!-- Dropdown Panel -->
                        <div id="notification-panel" class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 shadow-xl rounded-2xl overflow-hidden z-50 hidden opacity-0 transition-opacity duration-200 transform origin-top-right">
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                                <span class="font-semibold text-gray-900 text-sm">Notifikasi</span>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">{{ auth()->user()->unreadNotifications->count() }} Baru</span>
                                @endif
                            </div>
                            
                            <div class="max-h-96 overflow-y-auto divide-y divide-gray-100">
                                @forelse(auth()->user()->notifications()->limit(5)->get() as $notification)
                                    <div class="px-4 py-3 hover:bg-gray-50 transition-colors {{ $notification->read_at ? 'opacity-60' : 'bg-blue-50/30' }}">
                                        <div class="flex items-start gap-3">
                                            <div class="mt-0.5 {{ $notification->data['color'] ?? 'text-gray-400' }}">
                                                <span class="material-symbols-outlined text-[20px]">{{ $notification->data['icon'] ?? 'notifications' }}</span>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-900 leading-snug">{{ $notification->data['message'] ?? 'Notifikasi baru' }}</p>
                                                <span class="text-xs text-gray-500 mt-1 block">{{ $notification->created_at->diffForHumans() }}</span>
                                                
                                                <div class="mt-2 flex items-center gap-3">
                                                    @if(isset($notification->data['action_url']))
                                                        <a href="{{ $notification->data['action_url'] }}" class="inline-flex items-center text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline transition-colors">Lihat Detail</a>
                                                    @endif
                                                    @if(!$notification->read_at)
                                                        @if(isset($notification->data['action_url']))
                                                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                                        @endif
                                                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="inline-flex m-0 p-0">
                                                            @csrf
                                                            <button type="submit" class="text-xs font-medium text-gray-500 hover:text-gray-800 hover:underline transition-colors">Tandai dibaca</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="px-4 py-8 text-center">
                                        <span class="material-symbols-outlined text-gray-300 text-3xl mb-2">notifications_paused</span>
                                        <p class="text-sm text-gray-500">Belum ada notifikasi.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 pl-2">
                        <a href="{{ route('profile.index') }}" class="hidden sm:flex items-center gap-2 mr-2 group hover:opacity-80 transition-opacity">
                            @if(auth()->user()->avatar)
                                <img alt="User profile" class="h-8 w-8 rounded-full border border-outline-variant object-cover group-hover:border-primary transition-colors" src="{{ asset('storage/' . auth()->user()->avatar) }}">
                            @else
                                <img alt="User profile" class="h-8 w-8 rounded-full border border-outline-variant object-cover group-hover:border-primary transition-colors" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=0D8ABC&color=fff">
                            @endif
                            <span class="font-semibold text-sm group-hover:text-primary transition-colors">{{ auth()->user()->name ?? 'Pengguna' }}</span>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                            @csrf
                            <button class="bg-primary text-on-primary font-label-md px-4 py-2 rounded-lg hover:bg-surface-tint transition-all shadow-sm active:scale-95 hidden sm:block">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-gutter bg-surface">
            @yield('content')
        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('notification-btn');
            const panel = document.getElementById('notification-panel');
            
            if (btn && panel) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    panel.classList.toggle('hidden');
                    // Small delay for transition
                    setTimeout(() => {
                        panel.classList.toggle('opacity-0');
                    }, 10);
                });

                document.addEventListener('click', function(e) {
                    if (!panel.contains(e.target) && !btn.contains(e.target) && !panel.classList.contains('hidden')) {
                        panel.classList.add('opacity-0');
                        setTimeout(() => {
                            panel.classList.add('hidden');
                        }, 200);
                    }
                });
            }
        });
    </script>
</body>
</html>