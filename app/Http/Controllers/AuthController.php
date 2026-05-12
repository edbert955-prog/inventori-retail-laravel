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

    public function register()
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'manajer', // Default role for newly registered user
        ]);

        Auth::login($user);

        return redirect()->intended('/dashboard')->with('success', 'Akun berhasil dibuat!');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Kami tidak dapat menemukan pengguna dengan alamat email tersebut.'
        ]);
        
        // Mocking the email sending for UI purposes since SMTP is not configured
        return back()->with('status', 'Kami telah mengirimkan tautan reset kata sandi ke email Anda!');
    }
}