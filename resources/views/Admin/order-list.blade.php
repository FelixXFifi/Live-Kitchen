<div class="min-h-screen bg-[#f3f4f6]">
    {{-- Top Navbar: Desain Sesuai Referensi & Ikon Rumah Aktif --}}
    <div class="bg-[#0f2633] flex items-center border-b-2 border-[#c2b280] shadow-md">
        {{-- Tombol Home untuk kembali ke Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" class="p-4 border-r border-[#c2b280]/30 hover:bg-[#244a5f] transition-all cursor-pointer group" title="Back to Dashboard">
            <svg class="w-8 h-8 text-[#f1e4bc] group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
        </a>
        
        <div class="pl-8 py-4">
            <h1 class="text-2xl font-serif tracking-[0.3em] text-[#f1e4bc] uppercase italic">Order List</h1>
        </div>
    </div>

    {{-- Content Area --}}
    <div class="max-w-[95%] mx-auto px-4 py-8">
        
        {{-- Filter Bar: Compact & Professional --}}
        <div class="flex flex-col md:flex-row items-end justify-between gap-4 mb-6">
            <div class="flex flex-wrap gap-6">
                {{-- Date Filter --}}
                <div class="w-56">
                    <label class="block text-[#0f2633] text-[10px] font-bold mb-1.5 uppercase tracking-widest">Date Chronology:</label>
                    <select wire:model.live="sortDirection" class="w-full bg-white border border-gray-300 px-3 py-1.5 text-xs italic outline-none shadow-sm focus:border-[#c2b280] cursor-pointer">
                        <option value="desc">Descending (Newest First)</option>
                        <option value="asc">Ascending (Oldest First)</option>
                    </select>
                </div>

                {{-- Status Filter --}}
                <div class="w-56">
                    <label class="block text-[#0f2633] text-[10px] font-bold mb-1.5 uppercase tracking-widest">Status Order:</label>
                    <select wire:model.live="statusFilter" class="w-full bg-white border border-gray-300 px-3 py-1.5 text-xs italic outline-none shadow-sm focus:border-[#c2b280] cursor-pointer">
                        <option value="">All Statuses</option>
                        <option value="Awaiting approval">Awaiting approval</option>
                        <option value="In Production">In Production</option>
                        <option value="In Transit/Service">In Transit/Service</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>

            {{-- Reset Button --}}
            <button wire:click="resetFilters" class="flex items-center gap-2 px-6 py-2 bg-[#0f2633] text-[#f1e4bc] text-[10px] font-bold uppercase tracking-widest rounded-sm border-b-2 border-[#c2b280] hover:bg-[#244a5f] transition-all shadow-md active:translate-y-0.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Reset
            </button>
        </div>

        {{-- Luxury Table Container --}}
        <div class="bg-white border-2 border-[#c2b280] shadow-2xl overflow-hidden rounded-sm relative">
            
            {{-- Loading State --}}
            <div wire:loading class="absolute inset-0 bg-white/50 backdrop-blur-[1px] z-10 flex items-center justify-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#0f2633]"></div>
            </div>

            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-[#244a5f] text-[#f1e4bc] uppercase tracking-[0.1em] text-[11px] italic">
                        <th class="p-4 border-r border-[#c2b280]/40 w-16">No.</th>
                        <th class="p-4 border-r border-[#c2b280]/40">Name</th>
                        <th class="p-4 border-r border-[#c2b280]/40">Total Order</th>
                        <th class="p-4 border-r border-[#c2b280]/40">Status Order</th>
                        <th class="p-4 border-r border-[#c2b280]/40">Event Location</th>
                        <th class="p-4">Payment Status</th>
                    </tr>
                </thead>
                <tbody class="text-[#0f2633] text-xs">
                    @forelse($orders as $index => $order)
                        <tr class="border-b border-gray-200 hover:bg-[#fcfaf5] transition-colors h-14">
                            <td class="p-2 border-r border-[#c2b280]/10 italic text-gray-400">
                                {{ $orders->firstItem() + $index }}
                            </td>
                            <td class="p-2 border-r border-[#c2b280]/10 font-medium italic">
                                {{ $order->customer_name }}
                            </td>
                            <td class="p-2 border-r border-[#c2b280]/10">
                                <a href="{{ route('order.detail', $order->id) }}" class="text-[#c2b280] hover:text-[#0f2633] font-bold underline decoration-dotted tracking-widest uppercase transition-colors">
                                    {{ $order->total_items }} Items
                                </a>
                            </td>
                            <td class="p-2 border-r border-[#c2b280]/10">
                                <span class="inline-flex items-center gap-1.5 italic">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $order->status == 'Completed' ? 'bg-green-500' : 'bg-amber-500 animate-pulse' }}"></span>
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="p-2 border-r border-[#c2b280]/10 text-gray-500 italic px-4">
                                <span class="truncate block max-w-xs mx-auto" title="{{ $order->location }}">{{ $order->location }}</span>
                            </td>
                            <td class="p-2 font-bold italic uppercase tracking-tighter">
                                <span class="{{ $order->payment_status == 'Paid' ? 'text-green-700' : 'text-red-600' }}">
                                    {{ $order->payment_status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-32 text-center bg-[#fcfaf5]">
                                <div class="flex flex-col items-center">
                                    <span class="text-[#c2b280] text-3xl font-light italic tracking-[0.2em] uppercase mb-2">The Gallery is Awaiting Your Selection</span>
                                    <div class="w-24 h-[1px] bg-[#c2b280] mb-4 opacity-50"></div>
                                    <p class="text-[#0f2633]/60 text-[10px] uppercase tracking-[0.3em]">No exquisite orders have been curated for this period yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination: Compact Design --}}
        <div class="mt-8 flex justify-center scale-90">
            {{ $orders->links() }}
        </div>
    </div>
</div>