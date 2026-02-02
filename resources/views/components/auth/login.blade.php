<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Online Kitchen | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #c5a059;
            --dark-navy: #0f1c2e;
            --soft-gold: #e2c275;
            --glass-bg: rgba(15, 28, 46, 0.85);
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }

        #particles { position: absolute; width: 100%; height: 100%; z-index: 1; }
        .gold-particle {
            position: absolute;
            background: radial-gradient(circle, var(--soft-gold) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.4;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }

        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            padding: 50px 40px;
            border-radius: 4px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            border: 1px solid rgba(197, 160, 89, 0.3);
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
            position: relative;
            z-index: 10;
        }

        .login-card::before, .login-card::after {
            content: "";
            position: absolute;
            width: 50px;
            height: 50px;
            border: 2px solid var(--primary-gold);
        }
        .login-card::before { top: 15px; left: 15px; border-right: none; border-bottom: none; }
        .login-card::after { bottom: 15px; right: 15px; border-left: none; border-top: none; }

        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-gold);
            font-size: 2.2rem;
            margin: 0 0 5px 0;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .subtitle {
            color: #ccc;
            font-size: 0.75rem;
            margin-bottom: 40px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .input-group { margin-bottom: 25px; text-align: left; }
        .input-group label {
            color: var(--primary-gold);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .input-group input {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(197, 160, 89, 0.4);
            padding: 10px 0;
            color: white;
            font-size: 1rem;
            transition: 0.3s;
            outline: none;
            box-sizing: border-box;
        }

        .input-group input:focus { border-bottom: 1px solid var(--primary-gold); }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: var(--primary-gold);
            border: none;
            color: var(--dark-navy);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.4s;
            margin-top: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .btn-login:hover {
            background: var(--soft-gold);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(197, 160, 89, 0.2);
        }

        .footer-links { margin-top: 30px; font-size: 0.8rem; }
        .footer-links a { color: #999; text-decoration: none; transition: 0.3s; }
        .footer-links a:hover { color: var(--primary-gold); }

        .error-message {
            color: #ff6b6b;
            font-size: 0.75rem;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .glow-hint {
            position: absolute;
            font-size: 12px;
            pointer-events: none;
            animation: fadeUp 1s forwards;
            z-index: 100;
        }

        @keyframes fadeUp {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-30px); }
        }
    </style>
</head>
<body>

    <div id="particles"></div>

    <div class="login-card">
        <h1>Login</h1>
        <p class="subtitle">Live Kitchen Experience</p>
        
        <form id="loginForm" action="{{ route('login.post') }}" method="POST">
            @csrf @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Your identity" required onkeypress="createSparkle(event)">
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Sign In</button>
        </form>

        <div class="footer-links">
            <a href="#">Forgot Credentials?</a>
            <span style="color: #555; margin: 0 10px;">|</span>
            <a href="#">Become a Member</a>
        </div>
    </div>

    <script>
        function createParticles() {
            const container = document.getElementById('particles');
            for (let i = 0; i < 20; i++) {
                const p = document.createElement('div');
                p.className = 'gold-particle';
                const size = Math.random() * 5 + 2 + 'px';
                p.style.width = size;
                p.style.height = size;
                p.style.left = Math.random() * 100 + 'vw';
                p.style.top = Math.random() * 100 + 'vh';
                p.style.animationDuration = (Math.random() * 10 + 10) + 's';
                p.style.animationDelay = (Math.random() * 5) + 's';
                container.appendChild(p);
            }
        }

        function createSparkle(e) {
            const hint = document.createElement('div');
            hint.className = 'glow-hint';
            hint.innerText = '✨';
            hint.style.left = e.pageX + 'px';
            hint.style.top = e.pageY + 'px';
            document.body.appendChild(hint);
            setTimeout(() => hint.remove(), 1000);
        }

        window.onload = createParticles;
    </script>
</body>
</html>