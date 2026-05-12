<footer class="border-t border-gray-100 bg-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-start gap-12">
        <div>
            <div class="flex items-center gap-2 mb-4">
                @if(setting('app_logo'))
                    <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo" class="h-6 w-auto object-contain">
                @else
                    <div class="w-6 h-6 bg-brand-900 rounded-md flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-[14px]">inventory_2</span>
                    </div>
                @endif
                <span class="font-semibold tracking-tight text-brand-900">{{ setting('app_name', 'Inventori Pro') }}</span>
            </div>
            <p class="text-sm text-gray-500 max-w-xs leading-relaxed">
                {{ setting('app_description', 'Platform inventori modern yang dirancang untuk kecepatan dan kenyamanan penggunaan operasional sehari-hari.') }}
            </p>
        </div>
        
        <div class="flex gap-16">
            <div>
                <span class="text-sm font-semibold text-brand-900 block mb-4">Produk</span>
                <ul class="space-y-3">
                    <li><a href="#fitur" class="text-sm text-gray-500 hover:text-brand-900 transition-colors">Fitur Utama</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-brand-900 transition-colors">Integrasi</a></li>
                    <li><a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-brand-900 transition-colors">Masuk Platform</a></li>
                </ul>
            </div>
            <div>
                <span class="text-sm font-semibold text-brand-900 block mb-4">Perusahaan</span>
                <ul class="space-y-3">
                    <li><a href="#" class="text-sm text-gray-500 hover:text-brand-900 transition-colors">Pusat Bantuan</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-brand-900 transition-colors">Privasi</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-brand-900 transition-colors">Ketentuan</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-400">{!! setting('footer_text', '&copy; ' . date('Y') . ' Inventori Pro. All rights reserved.') !!}</p>
        <div class="flex gap-4">
            <div class="w-8 h-8 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition cursor-pointer">
                <span class="material-symbols-outlined text-[16px]">share</span>
            </div>
        </div>
    </div>
</footer>
