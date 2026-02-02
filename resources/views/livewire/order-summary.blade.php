<div class="max-w-md mx-auto bg-[#1a3a4a] text-[#f1e4bc] font-serif shadow-2xl overflow-hidden border border-[#f1e4bc]/20">
    <div class="p-6 border-b border-[#f1e4bc]/20 flex items-center gap-4">
        <div class="border-2 border-[#f1e4bc] p-1">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </div>
        <h1 class="text-xl font-light tracking-widest uppercase">Order Summary & Statement</h1>
    </div>

    <div class="p-6 space-y-6">
        <div class="bg-white/5 p-4 rounded-sm border border-white/10 text-sm">
            <div class="flex justify-between mb-3 border-b border-[#f1e4bc]/20 pb-2">
                <span>Reserved under the name of:</span> 
                <span class="font-bold uppercase tracking-widest">{{ $reservation['name'] ?? 'Guest' }}</span>
            </div>
            <div class="space-y-1 opacity-80">
                <div class="flex justify-between"><span>Date of Service:</span> <span>{{ $reservation['date'] ?? '-' }}</span></div>
                <div class="flex justify-between"><span>Preferred Commencement:</span> <span>{{ $reservation['commencement'] ?? '-' }}</span></div>
                <div class="flex justify-between"><span>Occasion Type:</span> <span>{{ $reservation['occasion'] ?? '-' }}</span></div>
                <div class="flex justify-between"><span>Event Location:</span> <span>{{ $reservation['location'] ?? '-' }}</span></div>
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="text-2xl mb-4 font-light italic">Detailed Activities:</h2> 
            
            <div class="flex justify-between text-[10px] uppercase tracking-widest opacity-70 mb-2 px-1">
                <span>Description</span>
                <span>Amount</span>
            </div>

            <div class="space-y-3">
                @forelse($items as $item)
                {{-- Card Item Mewah dengan Logika Anti-Error --}}
                <div class="bg-white/10 text-[#f1e4bc] p-4 flex gap-4 rounded-sm border border-[#f1e4bc]/10 shadow-lg transition-all hover:bg-white/15">
                    <div class="w-10 h-10 bg-[#f1e4bc]/10 rounded-sm flex items-center justify-center">
                        <i class="fas fa-receipt opacity-50"></i>
                    </div>
                    
                    <div class="flex-1">
                        <p class="font-bold text-sm uppercase tracking-wide">{{ $item['name'] ?? 'Unnamed Item' }}</p>
                        <div class="flex justify-between text-[11px] mt-1 opacity-80 font-sans">
                            {{-- Mendukung data dari session (qty) maupun database (quantity) --}}
                            <span>Qty: {{ $item['qty'] ?? $item['quantity'] ?? 1 }}</span>
                            <span>@ Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="self-center font-bold text-sm font-sans text-right min-w-[100px]">
                        Rp {{ number_format(($item['qty'] ?? $item['quantity'] ?? 1) * ($item['price'] ?? 0), 0, ',', '.') }}
                    </div>
                </div>
                @empty
                <div class="text-center py-10 border border-dashed border-[#f1e4bc]/20 rounded-sm">
                    <p class="text-xs italic opacity-50 uppercase tracking-widest text-[#f1e4bc]">No items recorded in database.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white/5 p-4 rounded-sm border border-white/10 space-y-3 text-sm">
            <div class="flex justify-between text-xs opacity-70">
                <span>Total Volume of Service:</span> 
                <span>{{ $totalVolume }} Units</span>
            </div>
            <div class="flex justify-between">
                <span>Subtotal:</span> 
                <span class="font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between border-b border-[#f1e4bc]/20 pb-3 italic text-xs">
                <span>Bespoke Service Premium (5%):</span> 
                <span>Rp {{ number_format($servicePremium, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between items-center pt-2">
                <span class="text-lg font-bold uppercase tracking-tighter">Total Balance Due:</span>
                <span class="text-xl font-bold border-b-2 border-[#f1e4bc]">Rp {{ number_format($totalBalance, 0, ',', '.') }}</span>
            </div>
        </div>

        <p class="text-[11px] text-center italic opacity-80 px-4 leading-relaxed font-serif">
            "With our compliments and appreciation. Your reservation is now secured, and our concierge team is preparing for your arrival."
        </p>
    </div>
</div>