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
     * @param  string  $role   // contoh: ->middleware('role:admin')
     * @return mixed
     */
    public function handle($request, Closure $next, string $role)
    {
        // Jika belum login
        if (!session()->has('user_role')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Jika role tidak sesuai
        if (session('user_role') !== $role) {
            abort(403, 'Akses ditolak. Anda tidak memiliki akses.');
        }

        // Lanjut request
        return $next($request);
    }
}
