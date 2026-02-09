<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Live Kitchen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        body { font-family: 'Poppins', sans-serif; background-color: #dce4eb; }
        
        .custom-shadow {
            box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.1);
        }
        
        .gold-corner {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 20px;
            height: 20px;
            border-top: 3px solid #c2a978;
            border-left: 3px solid #c2a978;
        }

        [x-cloak] { display: none !important; }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #c2a978; }
    </style>
</head>
<body class="min-h-screen flex flex-col" 
    x-data="{ 
        statusOpen: false, 
        actionOpen: false,
        selectedMenu: { id: null, name: '' },
        currentStatus: '{{ $stats['status_website'] ?? 'At Service' }}' 
    }">

    <nav class="bg-[#2c4c58] p-4 flex justify-between items-center text-[#c2a978] shadow-md px-10">
        <h1 class="text-xl tracking-widest uppercase font-serif">Live Kitchen</h1>
        <div class="flex items-center gap-6 text-sm font-semibold">
            
            <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition uppercase tracking-widest">Dashboard</a>
            <a href="{{ route('manajemen.menu') }}" class="hover:text-white transition uppercase tracking-widest">Menu</a>
            <a href="{{ route('admin.orders') }}" class="hover:text-white transition uppercase tracking-widest">Pesanan</a>
            <a href="{{ route('admin.messages') }}" class="hover:text-white transition">View Messages</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-transparent border border-[#c2a978] hover:bg-[#c2a978] hover:text-[#2c4c58] px-4 py-1 rounded transition">LOGOUT</button>
            </form>
            
            {{-- <div class="w-10 h-10 bg-[#c2a978] rounded-full flex items-center justify-center text-[#2c4c58] font-bold uppercase">
            
            <form action="{{ route('logout') }}" method="POST" class="inline ml-4">
                @csrf
                <button type="submit" class="bg-transparent border border-[#c2a978] hover:bg-[#c2a978] hover:text-[#2c4c58] px-4 py-1 rounded-sm text-[10px] tracking-[0.2em] transition">LOGOUT</button>
            </form> --}}
            
            <div class="w-10 h-10 bg-[#c2a978] rounded-full flex items-center justify-center text-[#2c4c58] font-bold uppercase shadow-inner border-2 border-[#2c4c58]">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
    </nav>

    {{-- <div class="h-64 bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1200&q=80');">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/40"></div>
        <div class="absolute bottom-8 left-12 text-white z-10">
            <h2 class="text-4xl font-serif font-bold mb-2">Welcome Back, {{ Auth::user()->name }}</h2>
            <p class="text-lg opacity-90 italic">Kelola dapur mewahmu hari ini.</p> --}}

    <div class="h-64 bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1600&q=80');">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0f1d22]/80 to-transparent"></div>
        <div class="absolute bottom-8 left-12 text-white z-10">
            <h2 class="text-4xl font-serif font-bold mb-2">Welcome Back, {{ Auth::user()->name }}</h2>
            <p class="text-lg opacity-90 italic font-light tracking-wide">Kelola dapur mewahmu hari ini.</p>
        </div>
    </div>

    <main class="p-12 -mt-16 relative z-10 flex-grow">
        
        <div class="flex flex-wrap gap-6 mb-12">

            {{-- <div class="bg-white w-60 h-32 relative custom-shadow flex flex-col justify-center items-center border border-gray-100">
                <div class="gold-corner"></div>
                <p class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Jumlah Menu:</p>
                <p class="text-3xl font-serif font-bold text-[#2c4c58]">{{ $stats['jumlah_menu'] ?? 0 }}</p>
            </div>

            <div class="bg-white w-60 h-32 relative custom-shadow flex flex-col justify-center items-center border border-gray-100">
                <div class="gold-corner"></div>
                <p class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Menu Kosong:</p>
                <p class="text-3xl font-serif font-bold text-red-800">{{ $stats['menu_kosong'] ?? 0 }}</p>
            </div>

            <div class="bg-white w-60 h-32 relative custom-shadow flex flex-col justify-center items-center border border-gray-100">
                <div class="gold-corner"></div>
                <p class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Total Pesanan:</p>
                <p class="text-3xl font-serif font-bold text-[#2c4c58]">{{ $stats['jumlah_pesanan'] ?? 0 }}</p>
            </div>

            <div @click="statusOpen = true" class="bg-white w-60 h-32 relative custom-shadow flex flex-col justify-center items-center border border-gray-100 transform transition hover:translate-y-[-5px] cursor-pointer group">
                <div class="gold-corner"></div>
                <p class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2 group-hover:text-[#c2a978]">Status Website:</p>
                <p class="text-2xl font-serif font-bold transition-colors" 
                   :class="currentStatus === 'At Service' || currentStatus === 'Aktif' ? 'text-green-600' : 'text-red-800'" 
                   x-text="currentStatus"></p>
                <span class="text-[9px] text-gray-400 mt-2 opacity-0 group-hover:opacity-100 transition-opacity uppercase italic tracking-tighter">Click to change presence</span> --}}
                
            <div class="bg-white w-64 h-32 relative custom-shadow flex flex-col justify-center items-center border border-gray-100">
                <div class="gold-corner"></div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Jumlah Menu</p>
                <p class="text-3xl font-serif font-bold text-[#2c4c58]">{{ $stats['jumlah_menu'] ?? 0 }}</p>
            </div>

            <div class="bg-white w-64 h-32 relative custom-shadow flex flex-col justify-center items-center border border-gray-100">
                <div class="gold-corner"></div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 text-center text-red-800/60">Menu Habis</p>
                <p class="text-3xl font-serif font-bold text-red-800">{{ $stats['menu_kosong'] ?? 0 }}</p>
            </div>

            <div class="bg-white w-64 h-32 relative custom-shadow flex flex-col justify-center items-center border border-gray-100">
                <div class="gold-corner"></div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Total Pesanan</p>
                <p class="text-3xl font-serif font-bold text-[#2c4c58]">{{ $stats['jumlah_pesanan'] ?? 0 }}</p>
            </div>

            <div @click="statusOpen = true" class="bg-white w-64 h-32 relative custom-shadow flex flex-col justify-center items-center border border-gray-100 transform transition hover:translate-y-[-5px] cursor-pointer group">
                <div class="gold-corner"></div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 group-hover:text-[#c2a978]">Status Website</p>
                <p class="text-2xl font-serif font-bold transition-colors" 
                   :class="currentStatus === 'At Service' || currentStatus === 'Aktif' ? 'text-green-600' : 'text-red-800'" 
                   x-text="currentStatus"></p>
                <span class="text-[9px] text-gray-300 mt-2 opacity-0 group-hover:opacity-100 transition-opacity uppercase italic tracking-tighter">Click to toggle presence</span>
            </div>
        </div>

        <div class="w-full h-[1px] bg-[#2c4c58] opacity-10 mb-12"></div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-10 custom-shadow border border-gray-100 relative">
                    <div class="gold-corner"></div>
                    <h2 class="text-2xl font-serif font-bold mb-1 text-[#2c4c58]">Quick Action</h2>
                    
                    {{-- <p class="text-gray-500 mb-8 italic text-sm font-light leading-relaxed">Tambahkan item baru ke dalam menu anda untuk pengalaman pelanggan yang lebih baik.</p>

                    <a href="{{ route('admin.menu.create') }}" class="inline-flex items-center bg-[#c2a978] hover:bg-[#b09660] text-black font-bold py-4 px-8 rounded-lg transition-all shadow-sm active:scale-95 w-full justify-center">
                        <span class="bg-black text-white rounded-full w-5 h-5 flex items-center justify-center mr-3 text-xs font-bold">+</span> --}}


                    <p class="text-gray-400 mb-8 italic text-xs font-light leading-relaxed">Tambahkan item baru ke dalam menu anda untuk pengalaman pelanggan yang lebih baik.</p>

                    <a href="{{ route('admin.menu.create') }}" class="inline-flex items-center bg-[#c2a978] hover:bg-[#b09660] text-[#2c4c58] font-black uppercase tracking-widest text-[11px] py-4 px-8 rounded-sm transition-all shadow-sm active:scale-95 w-full justify-center">
                        <span class="bg-[#2c4c58] text-[#c2a978] rounded-full w-5 h-5 flex items-center justify-center mr-3 text-xs font-bold">+</span>
                        Tambahkan Menu Baru
                    </a>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="flex items-center gap-4 mb-8">
                    {{-- <h2 class="text-2xl font-serif text-[#2c4c58] italic uppercase tracking-widest whitespace-nowrap">Current Gallery</h2> --}}
                    <h2 class="text-2xl font-serif text-[#2c4c58] italic uppercase tracking-[0.2em] whitespace-nowrap">Current Gallery</h2>
                    <div class="h-[1px] bg-[#2c4c58] flex-1 opacity-20"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[600px] overflow-y-auto pr-4 custom-scrollbar">
                    @forelse($menus as $menu)
                        <div class="bg-white p-4 rounded-sm shadow-sm flex gap-4 relative border border-gray-100 items-center hover:shadow-md transition-all group">
                            <div class="w-20 h-20 bg-[#f8f9fa] rounded-sm flex-shrink-0 overflow-hidden border border-gray-100">
                                @if($menu->image)
                                    {{-- <img src="{{ asset('images/' . $menu->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-300 uppercase">No Image</div> --}}

                                    
                                    <img src="{{ asset('storage/' . $menu->image) }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                         onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=200'">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-300 uppercase italic">No Image</div>
                                @endif
                            </div>

                            <div class="flex flex-col flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-[#2c4c58] font-serif uppercase tracking-tight truncate group-hover:text-[#c2a978] transition-colors">
                                    {{ $menu->name }}
                                </h4>
                                {{-- <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1">{{ $menu->category }}</p>
                                <p class="text-[#2c4c58] text-sm font-bold font-sans"> --}}

                                    
                                <p class="text-[9px] text-gray-400 uppercase tracking-widest mb-1">{{ $menu->category }}</p>
                                <p class="text-[#c2a978] text-sm font-bold font-sans">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="flex gap-2">
                                {{-- <a href="#" class="p-2 text-gray-400 hover:text-[#2c4c58] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-10 border-2 border-dashed border-gray-200 text-gray-400 italic">
                            Belum ada menu di database. --}}

                            
                                <button @click="selectedMenu = { id: '{{ $menu->id }}', name: '{{ $menu->name }}' }; actionOpen = true" 
                                        class="p-2 text-gray-300 hover:text-[#c2a978] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-20 border-2 border-dashed border-gray-200 text-gray-400 italic font-light">
                            <p class="uppercase tracking-widest text-[10px]">Gallery is currently empty</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- <hr class="mt-20 border-[#c2a978] border-t-2 opacity-30">
    </main>

    <div x-show="statusOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div @click="statusOpen = false" class="absolute inset-0 bg-[#2c4c58]/80 backdrop-blur-sm transition-opacity"></div>
        <div class="relative bg-white w-full max-w-md p-8 custom-shadow border-t-4 border-[#c2a978]" @click.away="statusOpen = false">
            <h3 class="text-2xl font-serif font-bold text-[#2c4c58] text-center mb-2">Establishment Presence</h3>
            <p class="text-gray-400 text-center text-xs italic mb-8">Set the current atmosphere of your culinary gallery.</p>
            
            <div class="space-y-4">
                <button @click="currentStatus = 'At Service'; statusOpen = false" 
                    class="w-full flex items-center justify-between p-4 border border-gray-100 hover:border-[#c2a978] hover:bg-gray-50 transition text-left">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest text-[#2c4c58]">At Your Service</p>
                        <p class="text-[10px] text-gray-400 italic">Kitchen is open and welcoming guests.</p> --}}

                        
        <hr class="mt-20 border-[#c2a978] border-t-2 opacity-10">
    </main>

    <div x-show="actionOpen" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        <div @click="actionOpen = false" x-show="actionOpen" x-transition:enter="transition opacity-0 ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0 bg-[#0f1d22]/90 backdrop-blur-sm"></div>
        
        <div x-show="actionOpen" x-transition:enter="transition transform opacity-0 scale-95 ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" 
            class="relative bg-white w-full max-w-sm p-8 custom-shadow border-t-4 border-[#c2a978]">
            
            <div class="text-center mb-8">
                <p class="text-[10px] uppercase tracking-[0.3em] text-[#c2a978] font-bold mb-2">Menu Curation</p>
                <h3 class="text-xl font-serif font-bold text-[#2c4c58] uppercase" x-text="selectedMenu.name"></h3>
                <div class="h-[1px] w-12 bg-gray-100 mx-auto mt-4"></div>
            </div>
            
            <div class="flex flex-col gap-3">
                <a :href="'/admin/menu/edit/' + selectedMenu.id" class="flex items-center justify-between px-6 py-4 border border-gray-100 hover:border-[#2c4c58] hover:bg-gray-50 transition-all group">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#2c4c58]">Modify Creation</span>
                    <svg class="w-4 h-4 text-[#c2a978]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </a>

                <form :action="'/admin/menu/delete/' + selectedMenu.id" method="POST" onsubmit="return confirm('Arsipkan karya kuliner ini selamanya?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex items-center justify-between px-6 py-4 border border-red-50 hover:bg-red-50 transition-all group text-left">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-red-800">Archive Item</span>
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </form>
            </div>

            <button @click="actionOpen = false" class="w-full mt-8 text-[9px] uppercase tracking-[0.3em] text-gray-400 hover:text-black transition-colors font-black">Close Suite</button>
        </div>
    </div>

    <div x-show="statusOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div @click="statusOpen = false" class="absolute inset-0 bg-[#2c4c58]/80 backdrop-blur-sm"></div>
        <div class="relative bg-white w-full max-w-md p-8 custom-shadow border-t-4 border-[#c2a978]">
            <h3 class="text-2xl font-serif font-bold text-[#2c4c58] text-center mb-2">Establishment Presence</h3>
            <p class="text-gray-400 text-center text-[10px] italic uppercase tracking-widest mb-8">Set the current atmosphere</p>
            
            <div class="space-y-4">
                <button @click="currentStatus = 'At Service'; statusOpen = false" 
                    class="w-full flex items-center justify-between p-4 border border-gray-100 hover:border-[#c2a978] hover:bg-gray-50 transition text-left group">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-widest text-[#2c4c58]">At Your Service</p>
                        <p class="text-[9px] text-gray-400 italic">Kitchen is open and welcoming guests.</p>
                    </div>
                    <div class="w-3 h-3 rounded-full bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.5)]"></div>
                </button>

                <button @click="currentStatus = 'In Silent Mode'; statusOpen = false" 
                    {{-- class="w-full flex items-center justify-between p-4 border border-gray-100 hover:border-red-800 hover:bg-gray-50 transition text-left">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest text-[#2c4c58]">In Silent Mode</p>
                        <p class="text-[10px] text-gray-400 italic">Resting the flames. No new orders.</p> --}}

                        
                    class="w-full flex items-center justify-between p-4 border border-gray-100 hover:border-red-800 hover:bg-gray-50 transition text-left group">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-widest text-[#2c4c58]">In Silent Mode</p>
                        <p class="text-[9px] text-gray-400 italic">Resting the flames. No new orders.</p>
                    </div>
                    <div class="w-3 h-3 rounded-full bg-red-800 shadow-[0_0_10px_rgba(153,27,27,0.5)]"></div>
                </button>

                {{-- <button @click="statusOpen = false" class="w-full mt-6 text-[10px] uppercase tracking-widest text-gray-400 hover:text-[#2c4c58] font-bold">Close</button> --}}
                <button @click="statusOpen = false" class="w-full mt-6 text-[9px] uppercase tracking-[0.2em] text-gray-400 hover:text-[#2c4c58] font-bold">Return to Dashboard</button>
            </div>
        </div>
    </div>

    {{-- <footer class="bg-[#2c4c58] h-32 mt-auto flex flex-col items-center justify-center space-y-2">
        <div class="h-[1px] w-20 bg-[#c2a978] opacity-30"></div>
        <p class="text-[#c2a978] text-[10px] opacity-50 tracking-[0.4em] uppercase">© 2026 LIVE KITCHEN LUXURY MANAGEMENT</p> --}}

        
    <footer class="bg-[#2c4c58] h-32 mt-auto flex flex-col items-center justify-center space-y-4">
        <div class="h-[1px] w-20 bg-[#c2a978] opacity-30"></div>
        <p class="text-[#c2a978] text-[9px] opacity-60 tracking-[0.4em] uppercase">© 2026 LIVE KITCHEN LUXURY MANAGEMENT</p>
    </footer>

</body>
</html>