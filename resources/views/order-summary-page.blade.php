<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary | Statement</title>
    @vite('resources/css/app.css')
    @livewireStyles
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;600&display=swap');
        
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }

        body { 
            background: radial-gradient(circle at center, #1a303d 0%, #0f1c24 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Tekstur Grain Halus */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            opacity: 0.04;
            pointer-events: none;
            background-image: url("https://www.transparenttextures.com/patterns/stardust.png");
            z-index: 1;
        }

        .main-container {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body class="antialiased">
    <div class="fixed top-0 right-0 w-96 h-96 bg-[#f1e4bc] opacity-[0.03] blur-[100px] rounded-full -mr-48 -mt-48"></div>

    <div class="py-16 main-container">
        @livewire('order-summary')
        
        <div class="mt-8 text-center">
            <a href="/" class="text-[10px] text-[#f1e4bc] uppercase tracking-[0.4em] opacity-40 hover:opacity-100 transition-all border-b border-transparent hover:border-[#f1e4bc]">
                &larr; Back to Home
            </a>
        </div>
    </div>

    @livewireScripts
</body>
</html>