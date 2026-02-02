<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user login dan apakah emailnya adalah admin
        if (Auth::check() && Auth::user()->email === 'admin@gmail.com') {
            return $next($request);
        }

        // Jika bukan admin, arahkan ke dashboard biasa
        return redirect('/dashboard')->with('error', 'Akses ditolak. Anda bukan admin.');
    }
}
