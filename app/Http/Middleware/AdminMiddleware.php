<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // CEK SUDAH LOGIN DAN ROLE ADMIN
        if (session('login') && session('role') == 'admin') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Silakan login sebagai admin');
    }
}