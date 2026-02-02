<div class="min-h-screen bg-[#d1dce8] py-8 px-4 flex flex-col items-center">
    
    <div class="w-full max-w-3xl mb-6">
        <a href="{{ route('order.list') }}" class="inline-flex items-center gap-3 text-[#0f2633] hover:text-[#c2b280] transition-all duration-300 uppercase text-sm font-black tracking-[0.2em] group">
            <div class="bg-[#0f2633] group-hover:bg-[#c2b280] p-2 rounded-full transition-colors">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </div>
            <span>Back to Gallery</span>
        </a>
    </div>

    <div class="w-full max-w-3xl bg-white shadow-2xl border-[1px] border-gray-200 relative overflow-hidden flex flex-col">
        
        <div class="h-1.5 bg-[#0f2633] shrink-0"></div>
        <div class="h-1 bg-[#c2b280] shrink-0"></div>

        <div class="p-10 flex-grow">
            <div class="flex justify-between items-start mb-12">
                <div>
                    <h1 class="text-[#0f2633] text-3xl font-light tracking-[0.25em] uppercase mb-1">Order Receipt</h1>
                    <p class="text-[#c2b280] italic text-sm tracking-widest uppercase font-medium">Culinary Gallery Excellence</p>
                </div>
                <div class="text-right uppercase tracking-tighter leading-tight">
                    <p class="text-xs font-bold text-[#0f2633]">REF. NO: #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-[10px] text-gray-400 font-bold">ISSUED: {{ now()->format('d M Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-8 mb-12 text-[#0f2633]">
                <div class="border-b border-gray-100 pb-2">
                    <label class="block text-[10px] uppercase tracking-widest text-[#c2b280] font-black mb-1">Client Name</label>
                    <p class="italic text-sm font-bold tracking-tight">{{ $order->customer_name }}</p>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <label class="block text-[10px] uppercase tracking-widest text-[#c2b280] font-black mb-1">Occasion</label>
                    <p class="italic text-sm font-bold tracking-tight">{{ $order->occasion_type ?? 'Gala Dinner Exclusive' }}</p>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <label class="block text-[10px] uppercase tracking-widest text-[#c2b280] font-black mb-1">Service Date</label>
                    <p class="italic text-sm font-bold tracking-tight">{{ \Carbon\Carbon::parse($order->date)->format('d M Y') }}</p>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <label class="block text-[10px] uppercase tracking-widest text-[#c2b280] font-black mb-1">Commencement</label>
                    <p class="italic text-sm font-bold tracking-tight">{{ $order->commencement_time ?? '19:00 PM' }}</p>
                </div>
                <div class="col-span-2 border-b border-gray-100 pb-2">
                    <label class="block text-[10px] uppercase tracking-widest text-[#c2b280] font-black mb-1">Event Location</label>
                    <p class="italic text-sm font-bold tracking-tight">{{ $order->location }}</p>
                </div>
            </div>

            <table class="w-full mb-10">
                <thead>
                    <tr class="border-b-2 border-[#0f2633] text-[10px] uppercase tracking-[0.3em] text-[#0f2633] font-black">
                        <th class="text-left py-3">Service Description</th>
                        <th class="text-center py-3">Activities</th>
                        <th class="text-right py-3">Volume</th>
                    </tr>
                </thead>
                <tbody class="text-xs italic font-bold">
                    <tr class="border-b border-gray-50">
                        <td class="py-5 text-[#0f2633]">Gala Dinner Culinary Curation</td>
                        <td class="py-5 text-center">{{ $order->total_items }} Activities</td>
                        <td class="py-5 text-right">{{ $order->total_volume ?? 'High Volume (Bespoke)' }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-end mb-10">
                <div class="w-72 space-y-2.5">
                    <div class="flex justify-between text-xs uppercase tracking-widest font-bold">
                        <span class="text-gray-400">Subtotal</span>
                        <span class="text-[#0f2633]">IDR {{ number_format($order->subtotal ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-xs uppercase tracking-widest font-bold">
                        <span class="text-[#c2b280]">Premium (5%)</span>
                        <span class="text-[#c2b280]">+ {{ number_format($bespokePremium, 0, ',', '.') }}</span>
                    </div>
                    <div class="pt-3 border-t-2 border-[#0f2633] flex justify-between text-sm uppercase tracking-[0.2em] font-black text-[#0f2633]">
                        <span>Total Due</span>
                        <span>IDR {{ number_format($totalBalance, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-16 flex justify-between items-end">
                <div class="italic">
                    <p class="text-[10px] uppercase tracking-widest font-black not-italic text-[#c2b280] mb-2">Order Status</p>
                    <p class="text-[#0f2633] uppercase text-xs font-bold tracking-widest mb-1">{{ $order->status }}</p>
                    <p class="text-xs text-[#0f2633] font-black underline decoration-[#c2b280] decoration-2">Payment: {{ $order->payment_status }}</p>
                </div>
                <div class="text-center w-48">
                    <div class="border-b border-gray-300 h-10 mb-2"></div>
                    <p class="text-[9px] uppercase tracking-[0.2em] text-gray-400 font-black">Verified Curator</p>
                </div>
            </div>
        </div>

        <div class="bg-[#f9f9f9] py-5 text-center border-t border-gray-100 shrink-0">
            <p class="text-[9px] uppercase tracking-[0.5em] text-gray-400 font-bold">Thank you for curating your event with us</p>
        </div>
    </div>
</div>