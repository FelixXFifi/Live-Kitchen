<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengecekan email ini SAMA dengan yang ada di LoginController
        if (Auth::check() && Auth::user()->email === 'admin@mail.com') {
            return $next($request);
        }

        // Jika bukan admin, tendang ke home dengan pesan error
        return redirect()->route('home')->with('error', 'Akses Khusus Admin!');
    }
}