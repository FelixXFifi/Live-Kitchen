<div>
    <div class="flex items-end justify-between mb-8">
        <div class="flex gap-10">
            <div class="w-64">
                <label class="block text-[#0f2633] text-xs font-bold mb-2 uppercase tracking-widest">Date Chronology:</label>
                <select wire:model.live="sortDirection" class="w-full bg-white border border-gray-300 p-2 rounded-sm outline-none shadow-inner text-sm italic">
                    <option value="asc">Ascending (Oldest First)</option>
                    <option value="desc">Descending (Newest First)</option>
                </select>
            </div>

            <div class="w-64">
                <label class="block text-[#0f2633] text-xs font-bold mb-2 uppercase tracking-widest">Status order:</label>
                <select wire:model.live="statusFilter" class="w-full bg-white border border-gray-300 p-2 rounded-sm outline-none shadow-inner text-sm italic">
                    <option value="">All Statuses</option>
                    <option value="Awaiting approval">Awaiting approval</option>
                    <option value="In Production">In Production</option>
                    <option value="In Transit/Service">In Transit/Service</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
        </div>

        <button 
            wire:click="resetFilters" 
            class="bg-[#0f2633] text-[#f1e4bc] px-6 py-2 rounded-sm border-b-2 border-[#c2b280] hover:bg-[#244a5f] transition-all text-xs font-bold uppercase tracking-widest flex items-center gap-2"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Reset
        </button>
    </div>

    <div class="bg-[#f2f2f2] border-[3px] border-[#c2b280] shadow-2xl overflow-hidden relative">
        <table class="w-full text-center border-collapse">
            <thead>
                <tr class="bg-[#244a5f] text-[#f1e4bc] uppercase tracking-tighter text-sm italic">
                    <th class="p-4 border-r border-[#c2b280] w-16">NO.</th>
                    <th class="p-4 border-r border-[#c2b280]">Name</th>
                    <th class="p-4 border-r border-[#c2b280]">Total Order</th>
                    <th class="p-4 border-r border-[#c2b280]">Status Order</th>
                    <th class="p-4 border-r border-[#c2b280]">Event Location</th>
                    <th class="p-4">Payment Status</th>
                </tr>
            </thead>
            <tbody class="text-[#0f2633]">
                @forelse($orders as $index => $order)
                    <tr class="border-b border-gray-200 h-16 hover:bg-white transition-colors">
                        <td class="p-3 border-r border-[#c2b280] italic">{{ $orders->firstItem() + $index }}</td>
                        <td class="p-3 border-r border-[#c2b280] font-medium italic">{{ $order->customer_name }}</td>
                        
                        <td class="p-3 border-r border-[#c2b280] italic">
                            <a href="{{ route('order.detail', $order->id) }}" class="text-[#c2b280] hover:text-[#0f2633] font-bold underline decoration-dotted tracking-widest uppercase">
                                {{ $order->total_items }} Items
                            </a>
                        </td>

                        <td class="p-3 border-r border-[#c2b280] italic">{{ $order->status }}</td>
                        <td class="p-3 border-r border-[#c2b280] italic">{{ $order->location }}</td>
                        <td class="p-3 italic font-semibold">{{ $order->payment_status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-32 text-center">
                            <div class="flex flex-col items-center">
                                <span class="text-[#c2b280] text-3xl font-light italic tracking-[0.2em] uppercase mb-2">The Gallery is Awaiting Your Selection</span>
                                <div class="w-24 h-[1px] bg-[#c2b280] mb-4 opacity-50"></div>
                                <p class="text-[#0f2633]/60 text-xs uppercase tracking-[0.3em]">No exquisite orders have been curated for this period yet.</p>
                            </div>
                        </td>
                    </tr>
                    @for ($i = 0; $i < 4; $i++)
                    <tr class="h-16 border-b border-gray-200/20">
                        <td class="border-r border-[#c2b280]/10"></td>
                        <td class="border-r border-[#c2b280]/10"></td>
                        <td class="border-r border-[#c2b280]/10"></td>
                        <td class="border-r border-[#c2b280]/10"></td>
                        <td class="border-r border-[#c2b280]/10"></td>
                        <td class="opacity-0"></td>
                    </tr>
                    @endfor
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        {{ $orders->links() }}
    </div>
</div>