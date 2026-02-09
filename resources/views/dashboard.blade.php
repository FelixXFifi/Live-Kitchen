<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Live Kitchen</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-navy: #1a3c4a;
            --bg-light: #d8e2eb;
            --gold-accent: #c5b081;
            --white: #ffffff;
            --transition: all 0.3s ease;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: #333;
        }

        /* --- NAVBAR --- */
        .navbar {
            background-color: var(--primary-navy);
            padding: 15px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .navbar h1 {
            color: var(--gold-accent);
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            letter-spacing: 2px;
            margin: 0;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .nav-links a {
            color: #d1d1d1;
            text-decoration: none;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
        }

        .nav-links a:hover { color: var(--gold-accent); }
        .nav-links a.active { color: var(--gold-accent); font-weight: 600; }

        .profile-section {
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 1px solid rgba(255,255,255,0.1);
            padding-left: 20px;
        }

        .logout-btn {
            color: #ff6b6b;
            font-size: 0.75rem;
            text-decoration: none;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 600;
        }

        .profile-circle {
            width: 35px;
            height: 35px;
            background-color: var(--gold-accent);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: var(--primary-navy);
        }

        /* --- HERO BANNER --- */
        .hero-banner {
            width: 100%;
            height: 180px;
            overflow: hidden;
            position: relative;
        }

        .hero-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.6);
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 60px;
            transform: translateY(-50%);
            color: white;
        }

        .hero-text h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin: 0;
            color: var(--gold-accent);
        }

        /* --- MAIN CONTENT --- */
        .container {
            padding: 40px 60px;
            max-width: 1300px;
            margin: 0 auto;
        }

        /* --- STATS CARDS --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: var(--white);
            padding: 25px;
            text-align: center;
            position: relative;
            box-shadow: 8px 8px 0px rgba(26, 60, 74, 0.1);
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 12px 12px 0px rgba(197, 176, 129, 0.2);
        }

        .stat-card::before {
            content: "";
            position: absolute;
            top: 10px;
            left: 10px;
            width: 25px;
            height: 25px;
            border-top: 3px solid var(--gold-accent);
            border-left: 3px solid var(--gold-accent);
        }

        .stat-card h3 {
            font-size: 0.85rem;
            font-weight: 500;
            margin: 10px 0;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card p {
            font-size: 2.2rem;
            font-weight: 600;
            margin: 0;
            color: var(--primary-navy);
        }

        /* --- QUICK ACTION --- */
        .quick-action-card {
            background: var(--white);
            padding: 40px;
            max-width: 500px;
            box-shadow: 8px 8px 0px rgba(26, 60, 74, 0.1);
            border-left: 5px solid var(--gold-accent);
        }

        .quick-action-card h2 {
            margin: 0 0 10px 0;
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--primary-navy);
        }

        .quick-action-card p {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 25px;
        }

        .btn-add-menu {
            background-color: var(--gold-accent);
            color: var(--primary-navy);
            border: none;
            padding: 14px 30px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            border-radius: 4px;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
        }

        .btn-add-menu:hover {
            background-color: var(--primary-navy);
            color: var(--gold-accent);
            transform: scale(1.02);
        }

        .divider {
            height: 2px;
            background: linear-gradient(to right, var(--gold-accent), transparent);
            margin-top: 60px;
            opacity: 0.5;
        }

        /* --- FOOTER --- */
        .footer {
            background-color: var(--primary-navy);
            padding: 30px 60px;
            color: rgba(255,255,255,0.5);
            font-size: 0.8rem;
            text-align: center;
            margin-top: 60px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h1>Live Kitchen</h1>
        
        <div class="nav-links">
            <div class="nav-links">
         <a href="/dashboard" class="active">Dashboard</a> 
         <a href="/manajemen-menu">Menu</a>               
          <a href="#">Pesanan</a>
</div></a>
        </div>

        <div class="profile-section">
            <a href="index.html" class="logout-btn">Logout</a>
            <div class="profile-circle">S</div>
        </div>
    </nav>

    <div class="hero-banner">
        <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1920&q=80" alt="Kitchen Banner">
        <div class="hero-text">
            <h2>Welcome Back, Salsabilla</h2>
            <p>Kelola dapur mewahmu hari ini.</p>
        </div>
    </div>

    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Jumlah menu:</h3>
                <p>24</p>
            </div>
            <div class="stat-card">
                <h3>Menu Kosong:</h3>
                <p>3</p>
            </div>
            <div class="stat-card">
                <h3>Total Pesanan:</h3>
                <p>12</p>
            </div>
            <div class="stat-card">
                <h3>Status Site:</h3>
                <p style="font-size: 1.5rem; color: #2ecc71;">ONLINE</p>
            </div>
        </div>

        <div class="quick-action-card">
            <h2>Quick Action</h2>
            <p>Ingin menambah menu spesial baru untuk pelanggan?</p>
            <button class="btn-add-menu" onclick="alert('Fitur Tambah Menu segera hadir!')">
                <span style="font-size: 1.4rem; font-weight: bold;">+</span> Tambahkan ke menu
            </button>
        </div>

        <div class="divider"></div>
    </div>

    <div class="footer">
        &copy; 2026 Luxury Live Kitchen Experience Admin Panel
    </div>

</body>
</html>
