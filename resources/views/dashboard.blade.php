<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Executive Dashboard | Live Kitchen</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #c5a059;
            --dark-navy: #0f1c2e;
            --deep-navy: #08121f;
            --soft-gold: #e2c275;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--deep-navy);
            font-family: 'Poppins', sans-serif;
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Container Partikel Emas */
        #particles {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; z-index: 0;
        }

        .gold-particle {
            position: absolute;
            background: radial-gradient(circle, var(--soft-gold) 0%, transparent 70%);
            border-radius: 50%;
            opacity: 0.4;
            animation: float-up 12s infinite linear;
        }

        @keyframes float-up {
            0% { transform: translateY(110vh) scale(0.5); opacity: 0; }
            50% { opacity: 0.6; }
            100% { transform: translateY(-10vh) scale(1.2); opacity: 0; }
        }

        /* Navbar */
        nav {
            background: var(--dark-navy);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--primary-gold);
            position: relative;
            z-index: 10;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            color: var(--primary-gold);
            font-size: 1.5rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .btn-logout {
            background: var(--primary-gold);
            color: var(--dark-navy);
            padding: 8px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.8rem;
            transition: 0.3s;
        }

        /* Main Content */
        .container {
            position: relative;
            z-index: 5;
            padding: 50px 20px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        /* Card Mewah */
        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 35px;
            border-radius: 12px;
            border: 1px solid rgba(197, 160, 89, 0.3);
            text-align: center;
            transition: 0.4s;
            position: relative;
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: var(--primary-gold);
            box-shadow: 0 10px 30px rgba(197, 160, 89, 0.2);
        }

        /* Aksen Siku Emas */
        .card::before {
            content: "";
            position: absolute;
            top: 10px; left: 10px;
            width: 20px; height: 20px;
            border-top: 2px solid var(--primary-gold);
            border-left: 2px solid var(--primary-gold);
        }

        .card h3 {
            color: var(--soft-gold);
            font-size: 0.9rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0;
        }

        .card .value {
            font-size: 3.5rem;
            font-weight: 700;
            display: block;
            margin-top: 15px;
            text-shadow: 0 0 10px rgba(197, 160, 89, 0.3);
        }

        .status-badge {
            color: #10b981;
            font-size: 1.3rem;
            font-weight: 600;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .dot {
            width: 12px; height: 12px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 10px #10b981;
        }
    </style>
</head>
<body>

    <div id="particles"></div>

    <nav>
        <div class="logo">Live Kitchen</div>
        <div class="user-info" style="display: flex; align-items: center; gap: 20px;">
            <span style="color: var(--soft-gold); font-size: 0.9rem;">Halo, Salsabilla</span>
            <a href="/" class="btn-logout">KELUAR</a>
        </div>
    </nav>

    <div class="container">
        <div class="stats-grid">
            <div class="card">
                <h3>Total Pesanan</h3>
                <span class="value">24</span>
            </div>

            <div class="card">
                <h3>Menu Tersedia</h3>
                <span class="value">12</span>
            </div>

            <div class="card">
                <h3>Status Kantin</h3>
                <div class="status-badge">
                    <div class="dot"></div> BUKA
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi buat butiran emas melayang
        function createGoldDust() {
            const container = document.getElementById('particles');
            for (let i = 0; i < 40; i++) {
                const p = document.createElement('div');
                p.className = 'gold-particle';
                const size = Math.random() * 4 + 2 + 'px';
                p.style.width = size;
                p.style.height = size;
                p.style.left = Math.random() * 100 + 'vw';
                p.style.animationDuration = (Math.random() * 10 + 8) + 's';
                p.style.animationDelay = (Math.random() * 5) + 's';
                container.appendChild(p);
            }
        }
        // Pastikan dijalankan setelah halaman siap
        window.addEventListener('DOMContentLoaded', createGoldDust);
    </script>
</body>
</html>