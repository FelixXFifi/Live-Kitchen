<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Live Kitchen' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased bg-[#DBE2E9]">
    
    <nav class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 flex justify-between items-center relative z-50">
        {{-- <div class="flex items-center gap-8">
            <a href="{{ route('home') }}" class="text-[#2D4A63] font-serif italic text-xl font-bold tracking-wider hover:text-[#C5A059] transition-colors">
                LIVE KITCHEN
            </a>

            <div class="hidden md:flex gap-6 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#C5A059]' : 'hover:text-[#2D4A63]' }}">Home</a>
                <a href="{{ route('reservation.index') }}" class="hover:text-[#2D4A63]">Reservation</a>
                <a href="{{ route('cart.index') }}" class="hover:text-[#2D4A63]">Cart</a>
            </div>
        </div> --}}

        {{-- <div>
            @if(auth()->check())
                <a href="{{ route('dashboard') }}" class="text-[10px] font-bold uppercase tracking-[0.2em] bg-[#2D4A63] text-white px-4 py-2 rounded-sm">Dashboard</a>
            @else
                <a href="/login" class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#2D4A63]">Login</a>
            @endif
        </div> --}}
    </nav>

    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>