<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List | Culinary Gallery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        /* Font Serif agar sesuai desain mewah */
        body { font-family: 'Georgia', serif; }
    </style>
</head>
<body class="bg-[#d1dce8] min-h-screen">
    
    <div class="bg-[#0f2633] flex items-center h-24 relative shadow-lg">
        <div class="px-8 border-r-2 border-[#c2b280] h-full flex items-center">
            <a href="/">
                <svg class="w-12 h-12 text-[#f1e4bc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </a>
        </div>

        <div class="bg-[#244a5f] h-full flex items-center px-16 relative" style="clip-path: polygon(0 0, 90% 0, 100% 100%, 0% 100%);">
            <h1 class="text-[#f1e4bc] text-2xl tracking-[0.3em] uppercase font-light">Order List</h1>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-1 bg-[#c2b280]"></div>
    </div>

    <main class="max-w-7xl mx-auto p-10">
        <livewire:order-list />
    </main>

    @livewireScripts
</body>
</html>