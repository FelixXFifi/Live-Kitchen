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
        .custom-scrollbar::-webkit-scrollbar { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #C5A059; }
        [x-cloak] { display: none !important; }
        
        .bold-divider { 
            height: 2px !important; 
            background-color: #2D4A63;
            opacity: 0.4;
            border: none;
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

    {{-- BANNER ATAS (SUDAH DIKECILIN) --}}
    <div x-data="{ activeSlide: 1, loop() { setInterval(() => { this.activeSlide = this.activeSlide === 2 ? 1 : this.activeSlide + 1 }, 5000) } }"
        x-init="loop()"
        class="relative w-full h-48 md:h-[280px] overflow-hidden shadow-lg z-10" id="top"
        x-intersect:enter="activeTab = 'all-menu'">
        <div x-show="activeSlide === 1" x-transition.opacity.duration.1000ms class="absolute inset-0">
            <img src="{{ asset('images/j (1).png') }}" class="w-full h-full object-cover">
        </div>
        <div x-show="activeSlide === 2" x-transition.opacity.duration.1000ms class="absolute inset-0">
            <img src="{{ asset('images/h.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-black/20"></div> {{-- Gelapkan sedikit agar lebih elegan --}}
    </div>

    <div class="flex flex-col lg:flex-row items-start max-w-full relative">
        {{-- SIDEBAR --}}
        <aside class="w-full lg:w-80 bg-[#2D4A63] lg:h-screen lg:sticky lg:top-0 flex-shrink-0 shadow-2xl z-50 border-t-4 border-[#1e3243]">
            <div class="p-8 flex flex-col h-full">
                <div class="w-12 h-[2px] bg-[#C5A059] mb-2 opacity-80"></div>
                <h1 class="text-[#C5A059] text-3xl font-serif italic tracking-widest mb-10 uppercase text-center">Live Kitchen</h1>

                <div class="relative mb-8">
                    <input type="text" wire:model.live="search" placeholder="Search menu..."
                        class="w-full bg-white/10 border border-white/20 rounded-sm py-3 px-4 text-white text-sm focus:outline-none focus:ring-1 focus:ring-[#C5A059] placeholder:text-white/40">
                </div>

                <nav class="flex flex-col gap-1 overflow-y-auto pr-2 custom-scrollbar">
                    <a href="#top" 
                       @click="activeTab = 'all-menu'"
                       :class="activeTab === 'all-menu' ? 'bg-[#C5A059] text-white border-[#C5A059]' : 'text-[#C5A059] border-[#C5A059]/30 hover:bg-[#C5A059] hover:text-white'"
                       class="w-full text-left py-4 px-6 rounded-sm font-bold text-[11px] uppercase tracking-[0.2em] border transition-all duration-300 block">
                        <span>✧ ALL MENU</span>
                    </a>

                    @foreach(['Foods', 'Drinks', 'Desserts', 'Quick Bites', 'Healthy Options'] as $cat)
                        @php $slug = Str::slug($cat); @endphp
                        <a href="#{{ $slug }}" 
                           @click="activeTab = '{{ $slug }}'"
                           :class="activeTab === '{{ $slug }}' ? 'bg-[#C5A059] text-white border-[#C5A059]' : 'text-white border-white/5 hover:bg-[#C5A059]'"
                           class="w-full text-left py-4 px-6 rounded-sm font-bold text-[11px] uppercase tracking-[0.2em] border transition-all duration-300 group block">
                            <span class="group-hover:translate-x-2 inline-block transition-transform">{{ $cat }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 px-6 lg:px-16 pb-12 bg-[#DBE2E9] min-h-screen">
            <div class="relative pt-6 z-40 mb-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('location.index') }}" class="bg-white py-5 rounded-sm border border-gray-100 text-[10px] font-bold text-[#2D4A63] uppercase shadow-md hover:shadow-xl hover:-translate-y-1 transition-all text-center">Location</a>
                    <a id="cart-icon-target" href="{{ route('cart.index') }}" class="bg-white py-5 rounded-sm border border-gray-100 text-[10px] font-bold text-[#2D4A63] uppercase shadow-md hover:shadow-xl hover:-translate-y-1 transition-all text-center">Shopping Cart</a>
                    <a href="{{ route('contact.index') }}" class="bg-white py-5 rounded-sm border border-gray-100 text-[10px] font-bold text-[#2D4A63] uppercase shadow-md hover:shadow-xl hover:-translate-y-1 transition-all text-center">Contact Us</a>
                </div>
            </div>

            <div class="flex flex-col gap-y-12">
                @foreach(['Foods', 'Drinks', 'Desserts', 'Quick Bites', 'Healthy Options'] as $section)
                    @php $currentSlug = Str::slug($section); @endphp
                    <section class="space-y-6 scroll-mt-24" 
                             id="{{ $currentSlug }}"
                             x-intersect:enter="activeTab = '{{ $currentSlug }}'"
                             x-intersect.margin="-20% 0px -70% 0px">
                        
                        <div class="flex items-center gap-4">
                            <div class="bold-divider flex-1"></div>
                            <h2 class="text-2xl font-serif text-[#2D4A63] italic uppercase tracking-wider text-center px-4">
                                {{ $section }}
                            </h2>
                            <div class="bold-divider flex-1"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @php $filteredMenus = $menus->where('category', $section); @endphp
                            @forelse($filteredMenus as $menu)
                                <div id="menu-card-{{ $menu->id }}" class="bg-white p-4 rounded-sm shadow-sm flex flex-col gap-4 relative border border-gray-100 hover:shadow-lg transition-all group">
                                    <div class="w-full h-44 bg-[#F5F5F5] rounded-sm flex-shrink-0 overflow-hidden border border-gray-100">
                                        @if($menu->image)
                                            <img src="{{ str_starts_with($menu->image, 'http') ? $menu->image : asset('images/' . $menu->image) }}" 
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                 alt="{{ $menu->name }}" loading="lazy">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300 text-[10px]">No Image</div>
                                        @endif
                                    </div>

                                    <div class="flex flex-col flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-[#2D4A63] font-serif uppercase group-hover:text-[#C5A059] transition-colors line-clamp-2 h-10">{{ $menu->name }}</h4>
                                        <div class="mt-2 border-t border-gray-50 pt-3 flex justify-between items-center">
                                            <p class="text-[#2D4A63] text-base font-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                            <button wire:click="selectMenu({{ $menu->id }})" class="w-9 h-9 rounded-full border border-gray-100 text-[#2D4A63] flex items-center justify-center hover:bg-[#C5A059] hover:text-white transition-all shadow-sm active:scale-95">
                                                <span class="text-xl">+</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-10 text-center border-2 border-dashed border-gray-200 rounded-sm text-gray-400 text-[10px] italic">
                                    Menu {{ $section }} belum tersedia.
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
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="open = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="relative bg-white w-full max-w-md shadow-2xl rounded-sm border-t-4 border-[#C5A059] p-6">
                @if($selectedMenu)
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-2xl font-serif italic text-[#2D4A63] uppercase tracking-wider">{{ $selectedMenu->name }}</h3>
                        <button @click="open = false" class="text-gray-400 hover:text-[#2D4A63] text-2xl">&times;</button>
                    </div>
                    
                    <div class="w-full h-56 bg-gray-100 rounded-sm mb-4 overflow-hidden">
                        <img src="{{ str_starts_with($selectedMenu->image, 'http') ? $selectedMenu->image : asset('images/' . $selectedMenu->image) }}" 
                             class="w-full h-full object-cover">
                    </div>

                    <div class="mb-6">
                        <p class="text-gray-600 text-sm leading-relaxed italic">
                            {{ $selectedMenu->description ?? 'Hidangan istimewa yang dibuat dengan bahan pilihan terbaik dari dapur Live Kitchen.' }}
                        </p>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                        <span class="text-2xl font-bold text-[#2D4A63]">Rp {{ number_format($selectedMenu->price, 0, ',', '.') }}</span>
                        <button wire:click="addToCart" class="bg-[#2D4A63] hover:bg-[#C5A059] text-white px-8 py-3 rounded-sm text-[10px] font-bold uppercase tracking-[0.2em] transition-all shadow-md active:scale-95">Add to Order</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>