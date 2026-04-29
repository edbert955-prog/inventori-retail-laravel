<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login (Sesuai Gambar 5.1.2)
    public function index()
    {
        return view('auth.login');
    }

    // Memproses data login (Sesuai KF-001)
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Skenario Normal: Arahkan berdasarkan role (Bab 2.2)
            $user = Auth::user();
            if ($user->role === 'manajer') {
                return redirect()->intended('/dashboard')->with('success', 'Selamat datang, Manajer!');
            }
            
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang, Staf Gudang!');
        }

        // Skenario Alternatif: Login Gagal (Sesuai Gambar 5.1.3)
        return back()->withErrors([
            'email' => 'Email atau kata sandi salah. Silakan coba lagi.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}