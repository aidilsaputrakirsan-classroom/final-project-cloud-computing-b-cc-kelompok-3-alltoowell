<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    public function handle($request, Closure $next, $role)
    {
        if (!session()->has('user_role') || session('user_role') !== $role) {
            return redirect('/login')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
