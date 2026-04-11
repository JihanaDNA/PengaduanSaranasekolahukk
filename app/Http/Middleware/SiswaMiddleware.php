<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SiswaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // CEK SUDAH LOGIN DAN ROLE SISWA
        if (session('login') && session('role') == 'siswa') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Silakan login sebagai siswa');
    }
}