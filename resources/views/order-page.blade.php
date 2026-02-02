<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Statement | {{ config('app.name') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#0f2633] antialiased min-h-screen flex items-center justify-center py-12">

    <main class="w-full">
        <livewire:order-summary />
    </main>

    @livewireScripts
</body>
</html>