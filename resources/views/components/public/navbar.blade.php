<nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-md border-b border-gray-200/50">
    <div class="max-w-7xl mx-auto px-6 h-14 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2">
            @if(setting('app_logo'))
                <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo" class="h-6 w-auto object-contain">
            @else
                <div class="w-6 h-6 bg-brand-900 rounded-md flex items-center justify-center shadow-sm">
                    <span class="material-symbols-outlined text-white text-[14px]">inventory_2</span>
                </div>
            @endif
            <span class="font-semibold tracking-tight text-brand-900">{{ setting('app_name', 'Inventori Pro') }}</span>
        </a>
        <div class="hidden md:flex items-center gap-8">
            <!-- Navigation links removed -->
        </div>
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-brand-900 hover:text-gray-600 transition">Ke Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-brand-900 hover:text-gray-600 transition">Masuk</a>
                <a href="{{ route('register') }}" class="text-sm font-medium bg-brand-900 text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition shadow-sm">Daftar</a>
            @endauth
        </div>
    </div>
</nav>
