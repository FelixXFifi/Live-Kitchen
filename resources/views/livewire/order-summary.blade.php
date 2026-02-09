<div class="max-w-md mx-auto bg-[#1a3a4a] text-[#f1e4bc] font-serif shadow-2xl overflow-hidden border border-[#f1e4bc]/20">
    {{-- Header --}}
    <div class="p-6 border-b border-[#f1e4bc]/20 flex items-center gap-4">
        <div class="border-2 border-[#f1e4bc] p-1">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </div>
        <h1 class="text-xl font-light tracking-widest uppercase">Order Summary & Statement</h1>
    </div>

    <div class="p-6 space-y-6">
        {{-- Detail Reservasi --}}
        <div class="bg-white/5 p-4 rounded-sm border border-white/10 text-sm">
            <div class="flex justify-between mb-3 border-b border-[#f1e4bc]/20 pb-2">
                <span>Reserved under:</span> 
                <span class="font-bold uppercase tracking-widest">{{ $reservation['name'] ?? 'Guest' }}</span>
            </div>
            <div class="space-y-1 opacity-80">
                <div class="flex justify-between"><span>Date:</span> <span>{{ $reservation['date'] ?? '-' }}</span></div>
                <div class="flex justify-between"><span>Time:</span> <span>{{ $reservation['commencement'] ?? '-' }}</span></div>
                <div class="flex justify-between"><span>Occasion:</span> <span>{{ $reservation['occasion'] ?? '-' }}</span></div>
                <div class="flex justify-between"><span>Location:</span> <span>{{ $reservation['location'] ?? '-' }}</span></div>
            </div>
        </div>

        {{-- Daftar Item --}}
        <div class="space-y-4">
            <h2 class="text-2xl font-light italic">Detailed Activities:</h2> 
            <div class="space-y-3">
                @forelse($items as $item)
                <div class="bg-white/10 text-[#f1e4bc] p-4 flex gap-4 rounded-sm border border-[#f1e4bc]/10 shadow-lg items-center">
                    
                    {{-- BAGIAN GAMBAR (Ganti dari Icon ke Gambar Asli) --}}
                    <div class="w-14 h-14 bg-[#1a3a4a] rounded-sm flex-shrink-0 overflow-hidden border border-[#f1e4bc]/30 shadow-inner">
                        @if(!empty($item['image']))
                            <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset('images/' . $item['image']) }}" 
                                 class="w-full h-full object-cover grayscale-[20%] hover:grayscale-0 transition-all duration-500"
                                 alt="{{ $item['name'] }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-[#f1e4bc]/5">
                                <i class="fas fa-utensils opacity-20"></i>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-sm uppercase tracking-wide truncate">{{ $item['name'] ?? 'Item' }}</p>
                        <div class="flex justify-between text-[11px] mt-1 opacity-80">
                            <span>Qty: {{ $item['qty'] ?? $item['quantity'] ?? 1 }}</span>
                            <span>@ Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="font-bold text-sm text-right min-w-[90px]">
                        Rp {{ number_format(($item['qty'] ?? $item['quantity'] ?? 1) * ($item['price'] ?? 0), 0, ',', '.') }}
                    </div>
                </div>
                @empty
                <p class="text-center opacity-50 italic">No activities found.</p>
                @endforelse
            </div>
        </div>

        {{-- Ringkasan Biaya --}}
        <div class="bg-white/5 p-4 rounded-sm border border-white/10 space-y-3 text-sm">
            <div class="flex justify-between text-xs opacity-70">
                <span>Total Items:</span> <span>{{ $totalVolume ?? 0 }} Units</span>
            </div>
            <div class="flex justify-between">
                <span>Subtotal:</span> <span class="font-bold">Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between border-b border-[#f1e4bc]/20 pb-3 italic text-xs">
                <span>Service Premium (5%):</span> <span>Rp {{ number_format($servicePremium ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center pt-2">
                <span class="text-lg font-bold uppercase">Total Due:</span>
                <span class="text-xl font-bold border-b-2 border-[#f1e4bc]">Rp {{ number_format($totalBalance ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        <p class="text-[11px] text-center italic opacity-80 font-serif">
            "Your reservation is now secured. Our team is preparing for your arrival."
        </p>
    </div>
</div>