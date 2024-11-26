<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('main')->with('error', 'Verileri görmek için giriş yapmalısın.');
        }

        return $next($request);
    }
}
?>