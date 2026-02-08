<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Chat | Excellence Guest</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-[#DBE2E9] min-h-screen flex items-center justify-center p-6 font-serif">
    <div class="max-w-4xl w-full">
        <div class="mb-6 flex justify-between items-center text-[#1e3243]">
             <h2 class="tracking-[0.2em] uppercase text-sm font-light">Private Chat</h2>
             <a href="{{ url()->previous() }}" class="text-[10px] uppercase tracking-widest opacity-60 hover:opacity-100">&larr; Back</a>
        </div>
        
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-200">
            @livewire('concierge-chat')
        </div>
    </div>
    @livewireScripts
</body>
</html>