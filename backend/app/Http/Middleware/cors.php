<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        return [
            'paths' => ['/*'],

            'allowed_methods' => ['*'],

            'allowed_origins' => ['http://localhost:8080'],

            'allowed_origins_patterns' => [],
            'allowed_headers' => ['*'],

            'exposed_headers' => [],

            'max_age' => 0,

            'supports_credentials' => false,
        ];
    }
}