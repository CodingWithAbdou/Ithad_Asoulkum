<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactor
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && is_null(auth()->user()->email_verified_at)) {
            return redirect()->route('dashboard.verify.show');
        }

        return $next($request);
    }
}