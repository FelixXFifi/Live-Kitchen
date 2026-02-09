<div class="max-w-md mx-auto bg-[#1a3a4a] text-[#f1e4bc] font-serif shadow-2xl overflow-hidden border border-[#f1e4bc]/20">
    {{-- Header --}}
    <div class="p-6 border-b border-[#f1e4bc]/20 flex items-center gap-4">
        <div class="border-2 border-[#f1e4bc] p-1">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04M12 21.355r-1.178-.094A11.956 11.956 0 013.382 12.04v-.07a11.956 11.956 0 018.618-11.026"></path>
            </svg>
        </div>
        <div class="flex-1">
            <h1 class="text-xl font-light tracking-widest uppercase">Order Summary & Statement</h1>
            <p class="text-[10px] opacity-60 tracking-tighter uppercase">
                Transaction ID: #RES-{{ $reservation->id ?? '000' }}-{{ time() }}
            </p>
        </div>
    </div>

    <div class="p-6 space-y-6">
        {{-- Detail Reservasi --}}
        <div class="bg-white/5 p-4 rounded-sm border border-white/10 text-sm">
            <div class="flex justify-between mb-3 border-b border-[#f1e4bc]/20 pb-2">
                <span class="opacity-70">Reserved under:</span> 
                <span class="font-bold uppercase tracking-widest">{{ $reservation->name ?? $reservation['name'] ?? 'Guest' }}</span>
            </div>
            <div class="space-y-1 opacity-90">
                <div class="flex justify-between">
                    <span>Date:</span> 
                    <span class="font-medium">{{ isset($reservation->date) ? \Carbon\Carbon::parse($reservation->date)->format('d M Y') : ($reservation['date'] ?? '-') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Time:</span> 
                    <span class="font-medium">{{ $reservation->time ?? $reservation['time'] ?? $reservation['commencement'] ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Occasion:</span> 
                    <span class="font-medium uppercase text-[12px]">{{ $reservation->occasion ?? $reservation['occasion'] ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Location:</span> 
                    <span class="font-medium">{{ $reservation->location ?? $reservation['location'] ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- INFO PEMBAYARAN: LOGIKA DINAMIS --}}
        @php
            // Menyesuaikan dengan value di reservation.blade.php (midtrans vs cod)
            $method = strtolower($paymentMethod ?? '');
            $isCash = ($method === 'cod' || $method === 'cash');
        @endphp

        <div class="{{ $isCash ? 'bg-orange-400/10 border-orange-400/50' : 'bg-[#f1e4bc]/10 border-[#f1e4bc]' }} p-3 border-l-4 flex justify-between items-center text-sm shadow-inner transition-colors duration-500">
            <span class="italic opacity-80">Payment Method:</span>
            <span class="font-bold uppercase tracking-tighter text-[11px] flex items-center gap-2">
                @if($isCash)
                    <i class="fas fa-hand-holding-usd text-orange-400"></i>
                    <span class="text-orange-400">Pay at Spot (Unpaid)</span>
                @else
                    <svg class="w-4 h-4 text-[#f1e4bc]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Midtrans Secure Gateway
                @endif
            </span>
        </div>

        {{-- Daftar Item --}}
        <div class="space-y-4">
            <h2 class="text-2xl font-light italic">Detailed Activities:</h2> 
            <div class="space-y-3">
                @forelse($items as $item)
                <div class="group bg-white/10 text-[#f1e4bc] p-4 flex gap-4 rounded-sm border border-[#f1e4bc]/10 shadow-lg items-center transition-colors hover:bg-white/[0.15]">
                    
                    {{-- BAGIAN GAMBAR --}}
                    <div class="w-14 h-14 bg-[#1a3a4a] rounded-sm flex-shrink-0 overflow-hidden border border-[#f1e4bc]/30 shadow-inner">
                        @php
                            $imgName = $item['image'] ?? $item['picture'] ?? '';
                            $imagePath = !empty($imgName) 
                                ? (str_starts_with($imgName, 'http') ? $imgName : asset('images/' . $imgName)) 
                                : null;
                        @endphp

                        @if($imagePath)
                            <img src="{{ $imagePath }}" 
                                 class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700"
                                 alt="{{ $item['name'] ?? 'Item' }}"
                                 onerror="this.src='https://via.placeholder.com/150?text=No+Image'">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-[#f1e4bc]/5">
                                <svg class="w-6 h-6 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Informasi Item --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-sm uppercase tracking-wide truncate group-hover:text-white transition-colors">
                            {{ $item['name'] ?? 'Item' }}
                        </p>
                        <div class="flex justify-between text-[11px] mt-1 opacity-70">
                            <span>Qty: {{ $item['qty'] ?? $item['quantity'] ?? 1 }}</span>
                            <span>@ Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Total Per Baris --}}
                    <div class="font-bold text-sm text-right min-w-[90px]">
                        Rp {{ number_format(($item['qty'] ?? $item['quantity'] ?? 1) * ($item['price'] ?? 0), 0, ',', '.') }}
                    </div>
                </div>
                @empty
                <div class="text-center p-8 border border-dashed border-white/20 rounded-sm">
                    <p class="opacity-50 italic">No activities found.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Ringkasan Biaya --}}
        <div class="bg-white/5 p-4 rounded-sm border border-white/10 space-y-3 text-sm">
            <div class="flex justify-between text-xs opacity-60">
                <span>Total Items Volume:</span> 
                <span>{{ $totalVolume ?? 0 }} Units</span>
            </div>
            <div class="flex justify-between">
                <span>Subtotal:</span> 
                <span class="font-bold">Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between border-b border-[#f1e4bc]/20 pb-3 italic text-[11px] opacity-80">
                <span>Service Premium (5%):</span> 
                <span>Rp {{ number_format($servicePremium ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center pt-2">
                <span class="text-lg font-bold uppercase tracking-tighter">Total Due:</span>
                <span class="text-xl font-bold border-b-2 border-[#f1e4bc] px-1">
                    Rp {{ number_format($totalBalance ?? 0, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- Footer Nota: Pesan Berdasarkan Pilihan --}}
        <div class="space-y-2">
            <p class="text-[11px] text-center italic opacity-80 font-serif leading-tight px-4">
                @if($isCash)
                    "Your reservation is recorded. Please finalize payment of 
                    <span class="font-bold">Rp {{ number_format($totalBalance ?? 0, 0, ',', '.') }}</span> 
                    upon arrival at the venue."
                @else
                    "Your reservation is now secured via Midtrans Secure Gate.<br>Our team is preparing for your arrival."
                @endif
            </p>
            <div class="flex justify-center opacity-30">
                <div class="h-px w-12 bg-[#f1e4bc]"></div>
            </div>
        </div>
    </div>
</div>