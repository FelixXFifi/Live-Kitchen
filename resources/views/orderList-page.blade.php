<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management | Live Kitchen Luxury</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    @livewireStyles

    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        body { font-family: 'Poppins', sans-serif; background-color: #dce4eb; }
        
        /* Gaya Scrollbar Luxury */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #c2a978; }

        /* Dekorasi Sudut Emas */
        .gold-corner {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 20px;
            height: 20px;
            border-top: 3px solid #c2a978;
            border-left: 3px solid #c2a978;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <nav class="bg-[#2c4c58] p-4 flex justify-between items-center text-[#c2a978] shadow-md px-10 relative z-50">
        <h1 class="text-xl tracking-widest uppercase font-serif">Live Kitchen</h1>
        <div class="flex items-center gap-6 text-sm font-semibold">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition uppercase tracking-widest">Dashboard</a>
            <a href="{{ route('manajemen.menu') }}" class="hover:text-white transition uppercase tracking-widest">Menu</a>
            <a href="{{ route('admin.orders') }}" class="text-white border-b border-[#c2a978] transition uppercase tracking-widest">Pesanan</a>
            
            <form action="{{ route('logout') }}" method="POST" class="inline ml-4">
                @csrf
                <button type="submit" class="bg-transparent border border-[#c2a978] hover:bg-[#c2a978] hover:text-[#2c4c58] px-4 py-1 rounded-sm text-[10px] tracking-[0.2em] transition">LOGOUT</button>
            </form>
        </div>
    </nav>

    <div class="bg-[#0f2633] py-12 px-12 relative overflow-hidden shadow-inner">
        <div class="absolute right-0 top-0 opacity-10">
            <svg class="w-64 h-64 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
            </svg>
        </div>
        
        <div class="relative z-10">
            <h2 class="text-[#c2a978] text-[10px] tracking-[0.5em] uppercase font-bold mb-2">Curated Gallery</h2>
            <h1 class="text-4xl font-serif text-[#f1e4bc] font-bold">ORDER MANAGEMENT</h1>
            <p class="text-white/50 italic text-sm mt-2 font-light">Kelola setiap pesanan dengan presisi dan pelayanan mewah.</p>
        </div>
        
        <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-[#c2a978] to-transparent"></div>
    </div>

    <main class="flex-grow p-8 md:p-12">
        <div class="max-w-7xl mx-auto">
            
            <div class="bg-white p-8 custom-shadow border border-gray-100 relative shadow-[15px_15px_0px_rgba(44,76,88,0.05)]">
                <div class="gold-corner"></div>
                
                <div class="mb-10 flex items-center gap-4">
                    <span class="h-[1px] w-12 bg-[#2c4c58]"></span>
                    <h3 class="font-serif text-[#2c4c58] text-xl italic">Recent Inquiries</h3>
                </div>

                @livewire('order-list')

            </div>
        </div>
    </main>

    <footer class="bg-[#2c4c58] h-24 flex flex-col items-center justify-center space-y-2">
        <div class="h-[1px] w-20 bg-[#c2a978] opacity-30"></div>
        <p class="text-[#c2a978] text-[9px] opacity-50 tracking-[0.4em] uppercase">© 2026 LIVE KITCHEN LUXURY MANAGEMENT</p>
    </footer>

    @livewireScripts
</body>
</html>