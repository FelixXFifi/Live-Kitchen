<x-layouts.app>
    <div class="p-6 md:p-12 bg-[#DBE2E9] min-h-screen font-serif">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-end mb-12 border-b border-[#1e3243]/10 pb-6">
                <div>
                    <h1 class="text-3xl tracking-[0.3em] uppercase text-[#1e3243] font-light">Concierge Inbox</h1>
                    <p class="italic text-sm text-[#1e3243]/60 mt-2">Private messages from your esteemed guests.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="text-[10px] tracking-[0.2em] uppercase text-[#C5A059] border border-[#C5A059] px-6 py-2 hover:bg-[#C5A059] hover:text-white transition-all">
                    Back to Dashboard
                </a>
            </div>

            <div class="bg-[#1e3243] shadow-2xl border border-[#D4B57F]/20 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#162a3a] text-[#D4B57F] text-[10px] uppercase tracking-[0.3em]">
                            <th class="p-6 font-light border-b border-[#D4B57F]/10">Timestamp</th>
                            <th class="p-6 font-light border-b border-[#D4B57F]/10">Guest Details</th>
                            <th class="p-6 font-light border-b border-[#D4B57F]/10">Inquiry Subject</th>
                            <th class="p-6 font-light border-b border-[#D4B57F]/10">Message</th>
                            {{-- Penambahan kolom Action --}}
                            <th class="p-6 font-light border-b border-[#D4B57F]/10 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-[#D4B57F]/80">
                        @forelse($messages as $message)
                        <tr class="border-b border-[#D4B57F]/5 hover:bg-white/5 transition-colors">
                            <td class="p-6 text-[10px] tracking-widest opacity-50">
                                {{ $message->created_at->format('d.M.Y') }}<br>
                                {{ $message->created_at->format('H:i') }}
                            </td>
                            <td class="p-6">
                                <span class="block text-xs font-bold tracking-widest uppercase text-[#D4B57F]">{{ $message->name }}</span>
                                <span class="text-[10px] italic opacity-60">{{ $message->email }}</span>
                            </td>
                            <td class="p-6">
                                <span class="text-[10px] uppercase tracking-wider border-l border-[#D4B57F]/30 pl-3">
                                    {{ $message->subject }}
                                </span>
                            </td>
                            <td class="p-6">
                                <p class="text-xs leading-relaxed italic opacity-80 max-w-md">
                                    "{{ $message->message }}"
                                </p>
                            </td>
                            {{-- Penambahan Tombol Delete --}}
                            <td class="p-6 text-right">
                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry from {{ $message->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[10px] tracking-[0.2em] uppercase text-red-400 hover:text-red-200 transition-all">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center">
                                <p class="text-[10px] uppercase tracking-[0.5em] opacity-40">No inquiries at the moment</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>