<div class="min-h-screen bg-[#0f2633] font-serif p-4 md:p-8 flex flex-col items-center">
    
    <div class="max-w-5xl w-full mb-6 text-center">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('admin.dashboard') }}" class="text-[#f1e4bc] hover:scale-105 transition-all duration-300 p-2 flex items-center gap-3 group">
                <div class="w-10 h-10 border border-[#f1e4bc]/30 rounded-full flex items-center justify-center group-hover:border-[#f1e4bc] transition-colors">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <span class="text-[10px] tracking-[0.2em] uppercase opacity-60 group-hover:opacity-100 transition-opacity font-bold">Back to Dashboard</span>
            </a>

            <h2 class="text-[#f1e4bc] text-[10px] md:text-xs tracking-[0.4em] uppercase opacity-60 font-bold">Management Suite</h2>
            <div class="w-24"></div> </div>
        
        <div class="h-[1px] bg-[#f1e4bc]/20 w-full mb-4"></div>
        <h1 class="text-[#f1e4bc] text-3xl md:text-4xl tracking-[0.5em] uppercase font-light">Add New Creation</h1>
    </div>

    <div class="max-w-5xl w-full bg-white rounded-sm shadow-[0_35px_60px_-15px_rgba(0,0,0,0.6)] overflow-hidden flex flex-col md:min-h-[550px]">
        <form wire:submit.prevent="save" class="grid grid-cols-1 lg:grid-cols-2 flex-1">
            
            <div class="p-8 md:p-12 space-y-8 border-r border-gray-100 flex flex-col justify-center bg-white">
                @if (session()->has('message'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-xs italic animate-pulse">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="relative group">
                    <label class="text-[#1a3a4a] text-[10px] uppercase tracking-[0.2em] font-black mb-2 block opacity-70 group-focus-within:opacity-100 transition-opacity">Designation</label>
                    <input type="text" wire:model="designation" placeholder="Enter menu name..." class="w-full border-b-2 border-gray-100 focus:border-[#1a3a4a] outline-none py-2 bg-transparent transition-all text-sm placeholder-gray-300 font-medium">
                    @error('designation') <span class="text-red-500 text-[10px] mt-1 italic">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="group">
                        <label class="text-[#1a3a4a] text-[10px] uppercase tracking-[0.2em] font-black mb-2 block opacity-70 group-focus-within:opacity-100">Classification</label>
                        <select wire:model="classification" class="w-full border-b-2 border-gray-100 focus:border-[#1a3a4a] outline-none py-2 bg-transparent appearance-none text-sm font-medium cursor-pointer">
                            <option value="">Select...</option>
                            <option value="Main course">Main course</option>
                            <option value="Best Seller">Best Seller</option>
                            <option value="Seasonal Specials">Seasonal Specials</option>
                            <option value="Signature Dish">Signature Dish</option>
                        </select>
                        @error('classification') <span class="text-red-500 text-[10px] mt-1 italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="group">
                        <label class="text-[#1a3a4a] text-[10px] uppercase tracking-[0.2em] font-black mb-2 block opacity-70 group-focus-within:opacity-100">Price (IDR)</label>
                        <input type="number" wire:model="price" placeholder="0" class="w-full border-b-2 border-gray-100 focus:border-[#1a3a4a] outline-none py-2 bg-transparent text-sm font-medium">
                        @error('price') <span class="text-red-500 text-[10px] mt-1 italic">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="group">
                        <label class="text-[#1a3a4a] text-[10px] uppercase tracking-[0.2em] font-black mb-2 block opacity-70 group-focus-within:opacity-100">Availability Status</label>
                        <div class="flex gap-4 mt-2">
                            <label class="flex items-center text-xs font-bold cursor-pointer">
                                <input type="radio" wire:model="availability" value="In Stock" class="mr-2 accent-[#1a3a4a]"> In Stock
                            </label>
                            <label class="flex items-center text-xs font-bold cursor-pointer">
                                <input type="radio" wire:model="availability" value="Out Of Stock" class="mr-2 accent-[#1a3a4a]"> Out of Stock
                            </label>
                        </div>
                    </div>

                    <div class="group">
                        <label class="text-[#1a3a4a] text-[10px] uppercase tracking-[0.2em] font-black mb-2 block opacity-70 group-focus-within:opacity-100">Narrative / Description</label>
                        <textarea wire:model="narrative" rows="3" placeholder="Tell the story of this creation..." class="w-full border-b-2 border-gray-100 focus:border-[#1a3a4a] outline-none py-2 bg-transparent resize-none text-sm font-medium placeholder-gray-300"></textarea>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-12 bg-gray-50 flex flex-col items-center justify-center space-y-6">
                <h3 class="text-[#1a3a4a] text-xs uppercase tracking-[0.3em] font-black self-start md:self-center mb-4">Visual Presentation</h3>
                
                <div class="relative w-full max-w-[320px] aspect-[4/5] border-4 border-double border-gray-200 group hover:border-[#c2b280] transition-all duration-500 flex items-center justify-center overflow-hidden bg-white shadow-inner">
                    @if ($photo)
                        <img src="{{ $photo->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover animate-fade-in">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <p class="text-white text-[10px] uppercase font-bold tracking-widest">Change Photo</p>
                        </div>
                    @else
                        <div class="text-center p-6 group-hover:scale-110 transition-transform duration-500">
                            <svg class="mx-auto h-16 w-16 text-gray-200 group-hover:text-[#c2b280] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="mt-4 text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em]">Upload Curation Image</p>
                        </div>
                    @endif
                    <input type="file" wire:model="photo" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                </div>
                
                @if($photo)
                <div class="bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100 flex items-center gap-2">
                    <span class="text-[9px] font-mono text-gray-400 uppercase tracking-tighter truncate max-w-[150px]">{{ $photo->getClientOriginalName() }}</span>
                    <button type="button" wire:click="$set('photo', null)" class="text-red-400 hover:text-red-600">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"></path></svg>
                    </button>
                </div>
                @endif

                @error('photo') <span class="text-red-500 text-[10px] italic">{{ $message }}</span> @enderror
            </div>
        </form>
    </div>

    <div class="max-w-5xl w-full mt-8 flex justify-center pb-8">
        <button wire:click="save" class="group relative bg-[#c2b280] hover:bg-[#1a3a4a] text-[#1a3a4a] hover:text-[#f1e4bc] font-bold py-4 px-32 rounded-sm shadow-[0_20px_50px_rgba(194,178,128,0.3)] transform transition-all duration-500 active:scale-95 uppercase tracking-[0.5em] text-sm overflow-hidden">
            <span class="relative z-10">Tambahkan ke Katalog</span>
            <div class="absolute inset-0 w-0 bg-[#1a3a4a] transition-all duration-500 ease-out group-hover:w-full"></div>
        </button>
    </div>
</div>