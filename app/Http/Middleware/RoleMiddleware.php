<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!session()->has('user_role')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (session('user_role') !== $role) {
            abort(403, 'Akses ditolak. Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
