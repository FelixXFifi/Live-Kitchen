<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Live Kitchen Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Montserrat', sans-serif; 
            margin: 0;
            padding: 0;
        }
        .font-serif-luxury { font-family: 'Playfair Display', serif; }
        
        /* Background Styling - DISESUAIKAN AGAR TIDAK HITAM */
        .luxury-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Glassmorphism Effect untuk Box */
        .glass-box {
            background: rgba(22, 37, 52, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="luxury-bg">

    <div class="w-full flex items-center justify-center px-4 py-10">
        
        <div class="relative w-full max-w-[450px] glass-box p-10 md:p-12 shadow-2xl rounded-sm">
            
            <div class="absolute top-6 left-6 w-10 h-10 border-t border-l border-[#C5A059]/60"></div>
            <div class="absolute bottom-6 right-6 w-10 h-10 border-b border-r border-[#C5A059]/60"></div>

            <div class="text-center mb-10">
                <h1 class="font-serif-luxury text-[#C5A059] text-4xl italic tracking-widest uppercase">Register</h1>
                <p class="text-white/50 text-[10px] tracking-[0.4em] uppercase mt-4 font-bold">Join Live Kitchen Experience</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-7">
                @csrf

                <div class="group">
                    <label class="block text-[#C5A059] text-[9px] uppercase font-bold tracking-[0.2em] mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full bg-transparent border-b border-white/20 py-2 text-white text-sm focus:outline-none focus:border-[#C5A059] transition-all placeholder:text-white/10" 
                           placeholder="Enter your name">
                    @error('name') <p class="text-red-400 text-[10px] mt-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="group">
                    <label class="block text-[#C5A059] text-[9px] uppercase font-bold tracking-[0.2em] mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-transparent border-b border-white/20 py-2 text-white text-sm focus:outline-none focus:border-[#C5A059] transition-all placeholder:text-white/10" 
                           placeholder="your@email.com">
                    @error('email') <p class="text-red-400 text-[10px] mt-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="group">
                    <label class="block text-[#C5A059] text-[9px] uppercase font-bold tracking-[0.2em] mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full bg-transparent border-b border-white/20 py-2 text-white text-sm focus:outline-none focus:border-[#C5A059] transition-all placeholder:text-white/10" 
                           placeholder="••••••••">
                    @error('password') <p class="text-red-400 text-[10px] mt-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="group">
                    <label class="block text-[#C5A059] text-[9px] uppercase font-bold tracking-[0.2em] mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full bg-transparent border-b border-white/20 py-2 text-white text-sm focus:outline-none focus:border-[#C5A059] transition-all placeholder:text-white/10" 
                           placeholder="••••••••">
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-[#C5A059] hover:bg-[#b38f4d] text-[#162534] font-bold py-4 uppercase tracking-[0.3em] text-[11px] transition-all shadow-xl active:scale-95">
                        Create Account
                    </button>
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('login') }}" class="text-white/40 text-[9px] uppercase tracking-widest hover:text-[#C5A059] transition-colors">
                        Already a Member? <span class="text-white font-bold border-b border-white/20 ml-1">Sign In</span>
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>