<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-[260px] bg-slate-950 text-white min-h-screen p-6">
        <h1 class="text-3xl font-bold mb-1">
            Inventori Pro
        </h1>

        <p class="text-slate-400 mb-10">
            Management System
        </p>

        <nav class="space-y-3">

            <a href="/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-blue-600 transition">
                Dashboard
            </a>

            <a href="/products"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-blue-600 transition">
                Products
            </a>

            <a href="/transactions"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-blue-600 transition">
                Transaction
            </a>

            <a href="/laporan"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-blue-600 transition">
                Reports
            </a>

        </nav>

        <div class="mt-96 space-y-3">

            <a href="/settings"
                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white">
                Settings
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 transition">
                Help
            </a>

        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-slate-800">
                Settings
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola pengaturan sistem inventaris Anda
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Profil Toko -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200">
                <h2 class="text-xl font-semibold mb-5 text-slate-800">
                    Profil Toko
                </h2>

                <div class="space-y-4">

                    <input type="text"
                        placeholder="Nama Toko"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <input type="email"
                        placeholder="Email Toko"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <input type="text"
                        placeholder="Nomor Telepon"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <textarea
                        placeholder="Alamat Toko"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 h-28 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

                </div>
            </div>

            <!-- Pengaturan Sistem -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200">
                <h2 class="text-xl font-semibold mb-5 text-slate-800">
                    Pengaturan Sistem
                </h2>

                <div class="space-y-4">

                    <select
                        class="w-full border border-slate-300 rounded-xl px-4 py-3">
                        <option>Bahasa Sistem</option>
                        <option>Indonesia</option>
                        <option>English</option>
                    </select>

                    <select
                        class="w-full border border-slate-300 rounded-xl px-4 py-3">
                        <option>Notifikasi Stok</option>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>

                    <input type="number"
                        placeholder="Minimum Stok"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3">

                    <input type="number"
                        placeholder="Pajak (%)"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3">

                </div>
            </div>

            <!-- Keamanan -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200 md:col-span-2">

    <h2 class="text-xl font-semibold mb-5 text-slate-800">
        Keamanan Akun
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <input type="password"
            placeholder="Password Lama"
            class="border border-slate-300 rounded-xl px-4 py-3">

        <input type="password"
            placeholder="Password Baru"
            class="border border-slate-300 rounded-xl px-4 py-3">

        <input type="password"
            placeholder="Konfirmasi Password"
            class="border border-slate-300 rounded-xl px-4 py-3">

    </div>

    <button
        class="mt-6 bg-blue-600 hover:bg-blue-700 transition text-white px-8 py-3 rounded-xl font-semibold">
        Simpan Pengaturan
    </button>

</div>