<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah email user sesuai dengan email admin utama
        if (Auth::check() && Auth::user()->email === 'admin@mail.com') {
            return $next($request);
        }

        // Jika tidak memenuhi syarat, tendang ke halaman home dengan flash message
        return redirect()->route('home')->with('error', 'Access Denied! Sanctuary restricted to administrators only.');
    }
}