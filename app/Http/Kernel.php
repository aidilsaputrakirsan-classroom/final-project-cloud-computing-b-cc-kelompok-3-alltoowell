<?php

namespace App\Http;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

class Kernel
{
    public function __construct(
        protected Application $app,
        protected Middleware $middleware,
        protected Exceptions $exceptions
    ) {
        $this->registerRouteMiddleware();
    }

    /**
     * REGISTER ROUTE MIDDLEWARE
     */
    protected function registerRouteMiddleware(): void
    {
        $this->middleware->alias('role', \App\Http\Middleware\RoleMiddleware::class);
    }

    public function middleware(): void
    {
        //
    }

    public function bootstrap(): void
    {
        //
    }
}
