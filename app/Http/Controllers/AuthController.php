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
        $this->supabaseUrl = rtrim(config('services.supabase.url'), '/');
        $this->supabaseKey = config('services.supabase.key');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email',
            'phone'    => 'required|string|min:10|max:15',
            'password' => 'required|min:6|confirmed'
        ]);

        $email = strtolower(trim($request->email));
        $role = str_ends_with($email, '@admin.com') ? 'admin' : 'user';

        $response = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=minimal'
        ])->post("{$this->supabaseUrl}/rest/v1/users", [
            'name'     => $request->name,
            'email'    => $email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => $role
        ]);

        if ($response->failed()) {
            $error = $response->json('message') ?? 'Gagal registrasi ke Supabase.';
            throw ValidationException::withMessages(['email' => $error]);
        }

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $email = strtolower(trim($request->email));

        $response = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/users", [
            'email'  => 'eq.' . $email,
            'select' => '*'
        ]);

        if ($response->failed()) {
            throw ValidationException::withMessages([
                'email' => 'Gagal menghubungi server Supabase.'
            ]);
        }

        $users = $response->json();

        if (empty($users)) {
            throw ValidationException::withMessages([
                'email' => 'Email tidak ditemukan.'
            ]);
        }

        $user = $users[0];

        if (!Hash::check($request->password, $user['password'])) {
            throw ValidationException::withMessages([
                'password' => 'Password salah.'
            ]);
        }

        // SIMPAN SESSION
        session([
            'user_id'    => $user['id'],
            'user_name'  => $user['name'],
            'user_email' => $user['email'],
            'user_role'  => $user['role'],
            'user_phone' => $user['phone']
        ]);

        return redirect()->intended(
            $user['role'] === 'admin'
                ? '/admin/dashboard'
                : '/rooms'
        );
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/')->with('success', 'Logout berhasil.');
    }
}
