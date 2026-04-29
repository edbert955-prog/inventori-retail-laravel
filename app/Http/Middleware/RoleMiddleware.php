<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role pengguna sesuai dengan yang diizinkan di routes
        if (Auth::user()->role !== $role) {
            // Jika role tidak sesuai (misal: Staf mencoba buka halaman Laporan Manajer)
            // Tampilkan error 403 Forbidden
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk membuka halaman ini.');
        }

        // 3. Jika aman, izinkan masuk ke halaman
        return $next($request);
    }
}