<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // cek apakah user sudah login (berbasis session)
        if (!session()->has('user_role')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // cek apakah role sesuai
        if (session('user_role') !== $role) {
            abort(403, 'Akses ditolak. Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
