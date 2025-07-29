<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LecturerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'lecturer') {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}
