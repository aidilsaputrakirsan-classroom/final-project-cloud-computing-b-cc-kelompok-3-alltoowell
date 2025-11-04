<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role   ← parameter dari route: 'role:admin'
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek apakah role user sesuai
        if (Auth::user()->role !== $role) {
            // Bisa redirect atau abort
            abort(403, 'Akses ditolak. Anda bukan admin.');
            // atau: return redirect('/')->with('error', 'Hanya admin yang bisa akses.');
        }

        // 3. Lanjut ke controller
        return $next($request);
    }
}