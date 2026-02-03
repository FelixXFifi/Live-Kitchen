<div x-data="{ showModal: false }" class="flex flex-col h-screen bg-[#D1DCE8] overflow-hidden selection:bg-[#D4B57F] selection:text-white">
    <div class="flex flex-none h-14 items-stretch shadow-lg border-b border-[#D4B57F]/10">
        <a href="/" class="relative bg-[#5B788E] text-[#D4B57F] flex items-center px-8 font-serif text-sm tracking-[0.3em] uppercase z-20 hover:bg-[#4A6375] transition-all duration-500">
            Home
            <div class="absolute top-0 -right-3.5 w-0 h-0 border-t-[28px] border-t-transparent border-b-[28px] border-b-transparent border-l-[14px] border-l-[#5B788E]"></div>
        </a>
        <div class="relative bg-[#345061] text-[#D4B57F] flex items-center px-12 font-serif text-sm tracking-[0.3em] uppercase z-10 -ml-1">
            Food Cart
            <div class="absolute top-0 -right-3.5 w-0 h-0 border-t-[28px] border-t-transparent border-b-[28px] border-b-transparent border-l-[14px] border-l-[#345061]"></div>
        </div>
        <div class="flex-1 bg-[#5B788E]"></div>
    </div>

    <div class="flex-1 overflow-y-auto p-6 sm:p-10 space-y-6 custom-scrollbar">
        @if(count($cart) > 0)
            @foreach ($cart as $item)
                <div class="bg-white/80 backdrop-blur-sm rounded-sm shadow-[10px_10px_0px_0px_rgba(52,80,97,0.1)] flex p-6 border border-[#D4B57F]/10 max-w-5xl mx-auto group hover:shadow-xl transition-all duration-700">
                    
                    <div class="w-32 h-24 bg-[#DBE2E9] rounded-sm flex-none overflow-hidden relative shadow-inner">
                         <div class="absolute inset-0 bg-[#345061]/5 group-hover:bg-transparent transition-colors z-10"></div>
                        @if(!empty($item['image']))
                            <img src="{{ asset('images/' . $item['image']) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                 alt="{{ $item['name'] }}"
                                 onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-[#345061]/10 text-[#345061]/30 text-[8px] uppercase tracking-widest text-center p-2 font-serif\'>Culinary<br>Masterpiece</div>'">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-[#345061]/10 text-[#345061]/30 text-[8px] uppercase tracking-widest text-center p-2 font-serif">
                                Image Not<br>Curated
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 px-6 flex flex-col justify-between">
                        <h3 class="text-2xl font-serif font-light text-[#345061] tracking-tight italic">{{ $item['name'] }}</h3>

                        <div class="flex justify-between items-end">
                            <div class="text-[10px] tracking-[0.2em] uppercase font-serif text-gray-400">
                                <p class="mb-2 italic">Culinary Quantity</p>
                                <div class="flex items-center gap-4 text-[#345061]">
                                    <button wire:click="decrement({{ $item['id'] }})" class="w-8 h-8 rounded-full border border-[#345061]/20 flex items-center justify-center hover:bg-[#345061] hover:text-white transition-all text-sm">－</button>
                                    <span class="text-lg font-bold w-6 text-center">{{ $item['qty'] }}</span>
                                    <button wire:click="increment({{ $item['id'] }})" class="w-8 h-8 rounded-full border border-[#345061]/20 flex items-center justify-center hover:bg-[#345061] hover:text-white transition-all text-sm">+</button>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <div class="text-right">
                                    <p class="text-gray-400 text-[9px] uppercase font-serif tracking-[0.3em] mb-1">Investment</p>
                                    <p class="text-xl font-bold font-serif text-[#345061]">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                                </div>

                                <button wire:click="removeItem({{ $item['id'] }})" class="p-2 text-gray-300 hover:text-red-800 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="flex flex-col items-center justify-center h-full text-center py-20 animate-fade-in">
                <div class="w-28 h-28 border border-[#D4B57F]/20 rounded-full flex items-center justify-center mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#D4B57F] opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-[#345061] font-serif text-4xl font-extralight italic mb-4 tracking-wide">The table is set, but your selection is empty</h2>
                <a href="/" class="px-14 py-4 border border-[#345061] text-[#345061] font-serif text-[10px] uppercase tracking-[0.5em] hover:bg-[#345061] hover:text-[#D4B57F] transition-all duration-700 mt-10">
                    Discover Our Menu
                </a>
            </div>
        @endif
    </div>

    @if(count($cart) > 0)
    <div class="bg-[#2A4557] px-8 py-10 flex-none border-t border-[#D4B57F]/30 shadow-[0_-10px_30px_rgba(0,0,0,0.2)]">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row justify-between items-center text-[#D4B57F] font-serif gap-8">
            <div class="flex flex-col items-center md:items-start">
                <span class="text-[9px] tracking-[0.4em] uppercase opacity-60 mb-1">Selected Delicacies</span>
                <span class="text-3xl font-light italic">{{ count($cart) }} Items</span>
            </div>
            
            <button @click="showModal = true" class="w-full md:w-1/2 bg-[#D4B57F] text-[#2A4557] py-5 uppercase tracking-[0.5em] font-bold text-[11px] shadow-xl hover:bg-white transition-all duration-500 active:scale-95">
                Proceed to Reservation
            </button>

            <div class="flex flex-col items-center md:items-end">
                <span class="text-[9px] tracking-[0.4em] uppercase opacity-60 mb-1">Total Appreciation</span>
                <span class="text-4xl font-bold tracking-tighter text-white">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
    @endif

    <div x-show="showModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
         x-cloak>
        
        <div @click.away="showModal = false" class="bg-white p-8 rounded-sm shadow-2xl max-w-sm w-full text-center font-serif border border-[#D4B57F]/20">
            <h3 class="text-[#345061] text-2xl mb-4 italic font-light">Finalize Selection?</h3>
            <p class="text-gray-500 text-[10px] mb-8 uppercase tracking-[0.2em] leading-relaxed">You are about to be redirected to our reservation sanctuary.</p>
            
            <div class="flex gap-4">
                <button @click="showModal = false" class="flex-1 py-3 border border-gray-200 text-gray-400 uppercase tracking-widest text-[9px] hover:bg-gray-50 transition-all">
                    Return
                </button>
                <button wire:click="checkout" class="flex-1 py-3 bg-[#345061] text-[#D4B57F] uppercase tracking-widest text-[9px] font-bold hover:bg-[#2A4557] transition-all">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(52, 80, 97, 0.05); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #D4B57F; }
        @keyframes fade-in { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fade-in 1s ease-out forwards; }
    </style>
</div>