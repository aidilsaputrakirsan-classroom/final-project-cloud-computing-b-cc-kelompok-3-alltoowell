<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $supabaseUrl;
    protected $supabaseKey;

    public function __construct()
    {
        $this->supabaseUrl = env('SUPABASE_URL');
        $this->supabaseKey = env('SUPABASE_KEY');
    }

   // 🟢 Menampilkan halaman login
public function showLoginForm()
{
    return view('auth.login');
}

// 🟢 Menampilkan halaman register
public function showRegisterForm()
{
    return view('auth.register');
}


    // 🟢 Registrasi user baru
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|min:10|max:15',
            'password' => 'required|min:6|confirmed'
        ]);

        // Normalisasi email agar konsisten
        $email = strtolower(trim($request->email));

        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal'
        ])->post("{$this->supabaseUrl}/rest/v1/users", [
            'name' => $request->name,
            'email' => $email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        if ($response->failed()) {
            $errorMessage = $response->json('message') ?? 'Gagal registrasi ke Supabase.';
            throw ValidationException::withMessages(['email' => $errorMessage]);
        }

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // 🟣 Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Normalisasi email
        $email = strtolower(trim($request->email));

        // 🔍 Ambil data user dari Supabase
        $response = Http::withHeaders([
            'apikey' => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/users", [
            'email' => 'eq.' . $email,
            'select' => '*'
        ]);

        // Jika gagal koneksi atau tidak ada data
        if ($response->failed()) {
            throw ValidationException::withMessages(['email' => 'Gagal menghubungi server Supabase.']);
        }

        $users = $response->json();
        if (empty($users)) {
            throw ValidationException::withMessages(['email' => 'Email tidak ditemukan.']);
        }

        $user = $users[0];

        // 🔐 Verifikasi password
        if (!Hash::check($request->password, $user['password'])) {
            throw ValidationException::withMessages(['password' => 'Password salah.']);
        }

        // 🔒 Simpan data ke session
        session([
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'user_role' => $user['role'],
            'user_phone' => $user['phone']
        ]);

        // 🔁 Arahkan sesuai role
    if ($user['role'] === 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/user/dashboard');
}
    // 🔴 Logout user
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/')->with('success', 'Logout berhasil.');
    }
}
