<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiTokenValid
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->input('token') !== '0a68d206-d271-47da-846f-07ec94075f6c') {
            throw new \Exception();
        }

        return $next($request);
    }
}
