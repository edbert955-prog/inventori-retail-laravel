<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - Sistem Manajemen Inventaris</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@600;700&display=swap" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: "#0058bc", error: "#ba1a1a", /* ... biarkan settingan warnamu tetap di sini ... */ }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center p-6">
    <main class="w-full max-w-[420px]">
        <div class="bg-white rounded-lg p-8 shadow-[0_4px_12px_rgba(0,122,255,0.08)] flex flex-col gap-6">
            <header>
                <h1 class="text-3xl font-bold text-gray-900 font-manrope">Masuk</h1>
            </header>

            @error('email')
            <div class="bg-red-100 p-3 rounded flex items-start gap-3">
                <span class="material-symbols-outlined text-red-700 mt-[2px]">error</span>
                <p class="text-sm text-red-900">{{ $message }}</p>
            </div>
            @enderror

            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
                @csrf 

                <div class="flex flex-col gap-2">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider" for="email">Email</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded text-gray-900 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600/15 transition-all" 
                           id="email" 
                           name="email" 
                           placeholder="contoh@email.com" 
                           type="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus/>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider" for="password">Kata Sandi</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded text-gray-900 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600/15 transition-all" 
                           id="password" 
                           name="password" 
                           type="password" 
                           required/>
                </div>

                <div class="flex flex-col gap-3 pt-2">
                    <button class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium text-[15px] py-[12px] px-[16px] rounded-full transition-colors flex justify-center items-center" 
                            type="submit">
                        Masuk
                    </button>
                    <div class="flex justify-end">
                        <a class="text-sm text-blue-700 hover:text-blue-800 transition-colors" href="#">Lupa kata sandi?</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>