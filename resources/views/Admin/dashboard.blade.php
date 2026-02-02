<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Live Kitchen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#dce4eb]">

    <div class="min-h-screen flex flex-col">
        <nav class="bg-[#2c4c58] p-4 flex justify-between items-center text-[#c2a978] shadow-md">
            <h1 class="text-xl tracking-widest uppercase font-serif">Live Kitchen</h1>
            <div class="w-10 h-10 bg-gray-300 rounded-full border-2 border-[#c2a978]"></div>
        </nav>

        <div class="h-32 bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1200&q=80');">
            <div class="absolute inset-0 bg-pink-500/10"></div>
        </div>

        <main class="p-8 flex-grow">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                @php
                    $cards = [
                        ['label' => 'Jumlah menu:', 'value' => $stats['jumlah_menu']],
                        ['label' => 'Jumlah Menu Kosong:', 'value' => $stats['menu_kosong']],
                        ['label' => 'Jumlah Pesanan:', 'value' => $stats['jumlah_pesanan']],
                        ['label' => 'Status Website:', 'value' => $stats['status_website']],
                    ];
                @endphp

                @foreach($cards as $card)
                <div class="bg-white p-6 shadow-md relative border-l-4 border-[#c2a978] transform transition hover:scale-105">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ $card['label'] }}</p>
                    <p class="text-3xl text-center mt-3 font-serif font-bold text-[#2c4c58]">{{ $card['value'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="bg-white p-8 shadow-md inline-block min-w-[450px] border border-gray-100">
                <h2 class="text-2xl font-serif font-bold mb-1 text-[#2c4c58]">Quick Action</h2>
                <p class="text-gray-500 mb-8 italic text-sm font-light">Tambahkan item baru ke dalam menu anda.</p>

                <a href="{{ route('admin.menu.create') }}" class="inline-flex items-center bg-[#c2a978] hover:bg-[#b09660] text-black font-bold py-3 px-8 rounded-lg transition-all shadow-sm hover:shadow-md active:scale-95">
                    <span class="bg-black text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 text-sm">+</span>
                    Tambahkan ke menu
                </a>
            </div>

            <hr class="mt-16 border-[#c2a978] border-t-2 opacity-30">
        </main>

        <footer class="bg-[#2c4c58] h-32 mt-auto"></footer>
    </div>

</body>
</html>
