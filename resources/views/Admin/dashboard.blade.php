<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Live Kitchen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        body { font-family: 'Poppins', sans-serif; background-color: #dce4eb; }
        
        /* Shadow tebal sesuai gambar referensi */
        .custom-shadow {
            box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.1);
        }
        
        /* Siku Emas di pojok kiri atas kartu */
        .gold-corner {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 20px;
            height: 20px;
            border-top: 3px solid #c2a978;
            border-left: 3px solid #c2a978;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <nav class="bg-[#2c4c58] p-4 flex justify-between items-center text-[#c2a978] shadow-md px-10">
        <h1 class="text-xl tracking-widest uppercase font-serif">Live Kitchen</h1>
        <div class="flex items-center gap-6 text-sm font-semibold">
            <a href="#" class="hover:text-white transition">DASHBOARD</a>
            <a href="#" class="hover:text-white transition">MENU</a>
            <a href="#" class="hover:text-white transition">PESANAN</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-transparent border border-[#c2a978] hover:bg-[#c2a978] hover:text-[#2c4c58] px-4 py-1 rounded transition">LOGOUT</button>
            </form>
            <div class="w-10 h-10 bg-[#c2a978] rounded-full flex items-center justify-center text-[#2c4c58] font-bold">S</div>
        </div>
    </nav>

    <div class="h-64 bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1200&q=80');">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/40"></div>
        <div class="absolute bottom-8 left-12 text-white z-10">
            <h2 class="text-4xl font-serif font-bold mb-2">Welcome Back, Salsabilla</h2>
            <p class="text-lg opacity-90 italic">Kelola dapur mewahmu hari ini.</p>
        </div>
    </div>

    <main class="p-12 -mt-16 relative z-10 flex-grow">
        
        <div class="flex flex-wrap gap-6 mb-12">
            @php
                $stats = [
                    ['label' => 'Jumlah Menu:', 'value' => '24'],
                    ['label' => 'Menu Kosong:', 'value' => '3'],
                    ['label' => 'Total Pesanan:', 'value' => '12'],
                    ['label' => 'Status Website:', 'value' => 'Aktif', 'highlight' => true],
                ];
            @endphp

            @foreach($stats as $stat)
            <div class="bg-white w-60 h-32 relative custom-shadow flex flex-col justify-center items-center border border-gray-100 transform transition hover:translate-y-[-5px]">
                <div class="gold-corner"></div>
                <p class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">{{ $stat['label'] }}</p>
                <p class="text-3xl font-serif font-bold {{ isset($stat['highlight']) ? 'text-green-600' : 'text-[#2c4c58]' }}">
                    {{ $stat['value'] }}
                </p>
            </div>
            @endforeach
        </div>

        <div class="bg-white p-10 custom-shadow inline-block min-w-[500px] border border-gray-100">
            <h2 class="text-2xl font-serif font-bold mb-1 text-[#2c4c58]">Quick Action</h2>
            <p class="text-gray-500 mb-8 italic text-sm font-light">Tambahkan item baru ke dalam menu anda untuk pengalaman pelanggan yang lebih baik.</p>

            <a href="{{ route('admin.menu.create') }}" class="inline-flex items-center bg-[#c2a978] hover:bg-[#b09660] text-black font-bold py-4 px-10 rounded-lg transition-all shadow-sm active:scale-95">
                <span class="bg-black text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 text-sm font-bold">+</span>
                Tambahkan ke menu
            </a>
        </div>

        <hr class="mt-20 border-[#c2a978] border-t-2 opacity-30">
    </main>

    <footer class="bg-[#2c4c58] h-32 mt-auto flex items-center justify-center">
        <p class="text-[#c2a978] text-xs opacity-50 tracking-[0.3em]">© 2026 LIVE KITCHEN LUXURY MANAGEMENT</p>
    </footer>

</body>
</html>