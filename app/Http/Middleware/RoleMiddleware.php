<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role   ← parameter dari route: 'role:admin'
     * @return mixed
     */
    public function handle($request, Closure $next, string $role)
    {
        // Jika belum login
        if (!session()->has('user_role')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Jika role TIDAK SAMA
        if (session('user_role') !== $role) {
            abort(403, 'Akses ditolak. Anda tidak memiliki akses.');
        }

        // Lanjut ke route berikutnya
        return $next($request);
    }
}