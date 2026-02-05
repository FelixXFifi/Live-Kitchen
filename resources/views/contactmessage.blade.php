<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Concierge | Excellence Dining</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[#DBE2E9] flex items-center justify-center p-6 font-serif">

    <div class="max-w-5xl w-full bg-[#1e3243] text-[#D4B57F] shadow-2xl border border-[#D4B57F]/20 overflow-hidden flex flex-col md:flex-row">
        
        <div class="md:w-1/3 bg-[#162a3a] p-10 flex flex-col justify-center border-r border-[#D4B57F]/10">
            <h2 class="text-2xl tracking-[0.3em] uppercase mb-8 font-light">Concierge</h2>
            
            <div class="space-y-8">
                <div>
                    <h3 class="text-[10px] tracking-[0.3em] uppercase opacity-50 mb-2">Service Hotline</h3>
                    <p class="text-sm tracking-widest">+62 812 5385 4905</p>
                </div>

                <div>
                    <h3 class="text-[10px] tracking-[0.3em] uppercase opacity-50 mb-2">Instant Inquiry</h3>
                    <a href="https://wa.me/6281253854905" target="_blank" class="inline-flex items-center gap-3 px-6 py-3 border border-[#D4B57F] text-[#D4B57F] hover:bg-[#D4B57F] hover:text-[#1e3243] transition-all duration-500 uppercase tracking-[0.2em] text-[10px] mt-2">
                        <span>Contact Us</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="md:w-2/3 p-12">
            <div class="mb-10 text-right md:text-left">
                <h1 class="text-3xl tracking-[0.4em] uppercase mb-4 font-light">Direct Message</h1>
                <p class="italic text-sm opacity-60">Complete the form below for formal inquiries.</p>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 bg-[#D4B57F]/10 border border-[#D4B57F]/30 text-[#D4B57F] text-[10px] tracking-widest uppercase text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <input type="text" name="name" required placeholder="YOUR NAME" class="bg-transparent border-b border-[#D4B57F]/30 py-2 focus:outline-none focus:border-[#D4B57F] transition-all uppercase text-xs tracking-widest text-[#D4B57F]">
                    <input type="email" name="email" required placeholder="EMAIL ADDRESS" class="bg-transparent border-b border-[#D4B57F]/30 py-2 focus:outline-none focus:border-[#D4B57F] transition-all uppercase text-xs tracking-widest text-[#D4B57F]">
                </div>

                <input type="text" name="subject" required placeholder="SUBJECT" class="w-full bg-transparent border-b border-[#D4B57F]/30 py-2 focus:outline-none focus:border-[#D4B57F] transition-all uppercase text-xs tracking-widest text-[#D4B57F]">
                <textarea name="message" rows="4" required placeholder="MESSAGE" class="w-full bg-transparent border-b border-[#D4B57F]/30 py-2 focus:outline-none focus:border-[#D4B57F] transition-all uppercase text-xs tracking-widest resize-none text-[#D4B57F]"></textarea>

                <div class="pt-4">
                    <button type="submit" class="w-full md:w-auto px-12 py-4 border border-[#D4B57F] text-[#D4B57F] hover:bg-[#D4B57F] hover:text-[#1e3243] transition-all duration-700 uppercase tracking-[0.5em] text-[10px]">
                        Submit Form
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>