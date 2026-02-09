<div class="min-h-screen bg-[#DBE2E9] relative"
     x-data="{
        activeTab: 'all-menu',
        luxuryCartAnimation(menuId) {
            const item = document.getElementById('menu-card-' + menuId);
            const cart = document.getElementById('cart-icon-target');
            if (!item || !cart) return;
            
            const itemRect = item.getBoundingClientRect();
            const cartRect = cart.getBoundingClientRect();

            const particle = document.createElement('div');
            Object.assign(particle.style, {
                position: 'fixed',
                left: (itemRect.left + itemRect.width / 2) + 'px',
                top: (itemRect.top + itemRect.height / 2) + 'px',
                width: '40px',
                height: '40px',
                borderRadius: '50%',
                backgroundColor: '#C5A059',
                boxShadow: '0 0 20px 5px rgba(197, 160, 89, 0.6)',
                zIndex: '200',
                pointerEvents: 'none',
                transition: 'all 1.2s cubic-bezier(0.19, 1, 0.22, 1)',
                opacity: '0.8',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                color: 'white',
                fontSize: '12px',
                fontWeight: 'bold'
            });
            particle.innerHTML = '✧';
            document.body.appendChild(particle);

            requestAnimationFrame(() => {
                particle.style.transform = 'scale(1.5) rotate(180deg)';
                setTimeout(() => {
                    particle.style.left = (cartRect.left + cartRect.width / 2 - 10) + 'px';
                    particle.style.top = (cartRect.top + cartRect.height / 2 - 10) + 'px';
                    particle.style.transform = 'scale(0.2) rotate(720deg)';
                    particle.style.opacity = '0';

                    setTimeout(() => {
                        cart.style.transform = 'scale(1.2)';
                        cart.style.color = '#C5A059';
                        setTimeout(() => {
                            cart.style.transform = 'scale(1)';
                            cart.style.color = '';
                        }, 200);
                    }, 1000);
                }, 100);
            });
            setTimeout(() => particle.remove(), 1300);
        }
     }"
     @item-added-to-cart.window="luxuryCartAnimation($event.detail.menuId)">

    <style>
        html { scroll-behavior: smooth; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #C5A059; }
        [x-cloak] { display: none !important; }
        
        .bold-divider { 
            height: 1px !important; 
            background: linear-gradient(to right, transparent, #2D4A63, transparent);
            opacity: 0.2;
            border: none;
        }

        .menu-luxury-card {
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .menu-luxury-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(45, 74, 99, 0.08);
            border-color: #C5A059;
        }
    </style>

    {{-- NAVBAR --}}
    <div class="w-full bg-[#1e3243] py-3 px-6 md:px-12 flex justify-between items-center shadow-md z-[60] relative border-b border-white/5">
        <div class="text-white/80 text-[10px] tracking-widest uppercase font-bold">Live Kitchen</div>
        <div class="flex items-center gap-4">
            @auth
                <span class="text-[#C5A059] text-[10px] font-bold uppercase tracking-widest">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-white/60 text-[10px] font-bold uppercase tracking-widest hover:text-red-400">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white text-[10px] font-bold uppercase tracking-widest hover:text-[#C5A059]">Login</a>
                <a href="{{ route('register') }}" class="text-white text-[10px] font-bold uppercase tracking-widest hover:text-[#C5A059]">Register</a>
            @endauth
        </div>
    </div>

    {{-- BANNER ATAS --}}
    <div x-data="{ activeSlide: 1, loop() { setInterval(() => { this.activeSlide = this.activeSlide === 2 ? 1 : this.activeSlide + 1 }, 5000) } }"
        x-init="loop()"
        class="relative w-full h-48 md:h-[300px] overflow-hidden shadow-lg z-0" id="top"
        x-intersect:enter="activeTab = 'all-menu'">
        <div x-show="activeSlide === 1" x-transition.opacity.duration.1000ms class="absolute inset-0">
            <img src="{{ asset('images/j (1).png') }}" class="w-full h-full object-cover">
        </div>
        <div x-show="activeSlide === 2" x-transition.opacity.duration.1000ms class="absolute inset-0">
            <img src="{{ asset('images/h.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-black/20"></div>
    </div>

    <div class="flex flex-col lg:flex-row items-start max-w-full relative">
        
        {{-- SIDEBAR OPTIMIZED (DIPERLEBAR & FONT DIPERBESAR) --}}
        <aside class="w-full lg:w-[400px] bg-[#2D4A63] lg:h-screen lg:sticky lg:top-0 flex-shrink-0 shadow-2xl z-50 border-t-4 border-[#1e3243]">
            <div class="p-10 flex flex-col h-full">
                <div class="w-16 h-[2px] bg-[#C5A059] mb-4 opacity-80"></div>
                <h1 class="text-[#C5A059] text-4xl font-serif italic tracking-widest mb-12 uppercase text-center leading-tight">Live Kitchen</h1>

                <div class="relative mb-12">
                    <input type="text" wire:model.live="search" placeholder="Search menu..."
                        class="w-full bg-white/10 border border-white/20 rounded-sm py-4 px-5 text-white text-base focus:outline-none focus:ring-1 focus:ring-[#C5A059] placeholder:text-white/40">
                </div>

                <nav class="flex flex-col gap-3 overflow-y-auto pr-2 custom-scrollbar">
                    <a href="#top" 
                       @click="activeTab = 'all-menu'"
                       :class="activeTab === 'all-menu' ? 'bg-[#C5A059] text-white border-[#C5A059]' : 'text-[#C5A059] border-[#C5A059]/30 hover:bg-[#C5A059] hover:text-white'"
                       class="w-full text-left py-5 px-8 rounded-sm font-bold text-[13px] uppercase tracking-[0.3em] border transition-all duration-300 block">
                       <span>✧ ALL MENU</span>
                    </a>

                    @foreach(['Foods', 'Drinks', 'Desserts', 'Quick Bites', 'Healthy Options'] as $cat)
                        @php $slug = Str::slug($cat); @endphp
                        <a href="#{{ $slug }}" 
                           @click="activeTab = '{{ $slug }}'"
                           :class="activeTab === '{{ $slug }}' ? 'bg-[#C5A059] text-white border-[#C5A059]' : 'text-white border-white/10 hover:bg-[#C5A059]'"
                           class="w-full text-left py-5 px-8 rounded-sm font-bold text-[13px] uppercase tracking-[0.3em] border transition-all duration-300 group block">
                            <span class="group-hover:translate-x-3 inline-block transition-transform">{{ $cat }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 px-6 lg:px-16 pb-12 bg-[#f4f7f9] min-h-screen">
            
            {{-- 3 NAV CARDS --}}
            <div class="relative -mt-10 z-40 mb-14"> 
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('location.index') }}" class="bg-white py-6 rounded-sm border border-gray-100 text-[10px] font-bold text-[#2D4A63] uppercase tracking-widest shadow-xl hover:bg-[#2D4A63] hover:text-white transition-all text-center">Location</a>
                    <a id="cart-icon-target" href="{{ route('cart.index') }}" class="bg-white py-6 rounded-sm border border-gray-100 text-[10px] font-bold text-[#2D4A63] uppercase tracking-widest shadow-xl hover:bg-[#2D4A63] hover:text-white transition-all text-center">Shopping Cart</a>
                    <a href="{{ route('contact.index') }}" class="bg-white py-6 rounded-sm border border-gray-100 text-[10px] font-bold text-[#2D4A63] uppercase tracking-widest shadow-xl hover:bg-[#2D4A63] hover:text-white transition-all text-center">Contact Us</a>
                </div>
            </div>

            <div class="flex flex-col gap-y-16">
                @foreach(['Foods', 'Drinks', 'Desserts', 'Quick Bites', 'Healthy Options'] as $section)
                    @php $currentSlug = Str::slug($section); @endphp
                    <section class="scroll-mt-24" 
                             id="{{ $currentSlug }}"
                             x-intersect:enter="activeTab = '{{ $currentSlug }}'"
                             x-intersect.margin="-20% 0px -70% 0px">
                        
                        <div class="flex flex-col items-center mb-10">
                            <h2 class="text-3xl font-serif text-[#2D4A63] italic uppercase tracking-widest text-center px-4">
                                {{ $section }}
                            </h2>
                            <div class="bold-divider w-48 mt-2"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @php $filteredMenus = $menus->where('category', $section); @endphp
                            @forelse($filteredMenus as $menu)
                                <div id="menu-card-{{ $menu->id }}" class="menu-luxury-card bg-white flex flex-col group overflow-hidden">
                                    <div class="w-full h-56 bg-[#F5F5F5] overflow-hidden relative">
                                        @if($menu->image)
                                            <img src="{{ str_starts_with($menu->image, 'http') ? $menu->image : asset('images/' . $menu->image) }}" 
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                                                 alt="{{ $menu->name }}">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300 text-[10px] uppercase tracking-widest">No Image</div>
                                        @endif
                                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    </div>

                                    <div class="p-6 flex flex-col flex-1 text-center items-center">
                                        <h4 class="text-base font-serif font-bold text-[#2D4A63] uppercase tracking-wide group-hover:text-[#C5A059] transition-colors mb-2">
                                            {{ $menu->name }}
                                        </h4>
                                        <div class="w-8 h-px bg-gray-200 mb-4 transition-all group-hover:w-16 group-hover:bg-[#C5A059]"></div>
                                        <p class="text-[#C5A059] text-lg font-light tracking-tight mb-6">
                                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                                        </p>
                                        
                                        <button wire:click="selectMenu({{ $menu->id }})" 
                                                class="w-full py-3 border border-[#2D4A63] text-[#2D4A63] text-[9px] font-bold uppercase tracking-[0.3em] hover:bg-[#2D4A63] hover:text-white transition-all active:scale-95">
                                            Discover More
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-16 text-center border border-dashed border-gray-200 rounded-sm text-gray-400 font-serif italic">
                                    Our selection for {{ $section }} is currently being curated.
                                </div>
                            @endforelse
                        </div>
                    </section>
                @endforeach
            </div>
        </main>
    </div>

    {{-- MODAL --}}
    <div x-data="{ open: @entangle('showModal') }" x-show="open" class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-[#1e3243]/80 backdrop-blur-sm" @click="open = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div x-show="open" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 scale-95" 
                 x-transition:enter-end="opacity-100 scale-100" 
                 class="relative bg-white w-full max-w-2xl shadow-2xl rounded-sm overflow-hidden flex flex-col md:flex-row">
                
                @if($selectedMenu)
                    <div class="w-full md:w-1/2 h-64 md:h-auto">
                        <img src="{{ str_starts_with($selectedMenu->image, 'http') ? $selectedMenu->image : asset('images/' . $selectedMenu->image) }}" 
                             class="w-full h-full object-cover">
                    </div>

                    <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-2xl font-serif italic text-[#2D4A63] uppercase tracking-wider">{{ $selectedMenu->name }}</h3>
                            <button @click="open = false" class="text-gray-300 hover:text-red-500 text-2xl transition-colors">&times;</button>
                        </div>
                        <div class="mb-8">
                            <p class="text-gray-500 text-xs leading-relaxed italic border-l-2 border-[#C5A059] pl-4">
                                {{ $selectedMenu->description ?? 'A signature masterpiece crafted with the finest ingredients from our Live Kitchen.' }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-4">
                            <span class="text-2xl font-bold text-[#2D4A63]">Rp {{ number_format($selectedMenu->price, 0, ',', '.') }}</span>
                            <button wire:click="addToCart" class="bg-[#2D4A63] hover:bg-[#C5A059] text-white py-4 text-[10px] font-bold uppercase tracking-[0.2em] transition-all shadow-md active:scale-95">Add to My Selection</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>