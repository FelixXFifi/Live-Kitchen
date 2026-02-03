<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Location | Excellence Dining</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-[#DBE2E9] flex items-center justify-center p-6 font-serif">

    <div class="max-w-6xl w-full bg-[#1e3243] text-[#D4B57F] shadow-2xl border border-[#D4B57F]/20 overflow-hidden flex flex-col md:flex-row">

        <div class="md:w-2/5 p-12 flex flex-col justify-center">
            <h1 class="text-3xl tracking-[0.4em] uppercase mb-10 font-light">Live Kitchen</h1>

            <div class="space-y-8">
                <div>
                    <h3 class="text-[10px] tracking-[0.3em] uppercase opacity-50 mb-3">Address</h3>
                    <p class="text-sm tracking-widest leading-relaxed uppercase">
                        Grand Pavilion No. 88<br>
                        Culinary District, Excellence Avenue<br>
                        Balikpapan, Indonesia
                    </p>
                </div>

                <div>
                    <h3 class="text-[10px] tracking-[0.3em] uppercase opacity-50 mb-3">Hours of Excellence</h3>
                    <div class="text-xs tracking-widest uppercase space-y-2">
                        <p>Mon — Fri : 18:00 – 23:00</p>
                        <p>Sat — Sun : 17:00 – 00:00</p>
                    </div>
                </div>

                <div class="pt-10">
                    <a href="https://maps.google.com" target="_blank" class="inline-block px-8 py-3 border border-[#D4B57F] text-[#D4B57F] hover:bg-[#D4B57F] hover:text-[#1e3243] transition-all duration-700 uppercase tracking-[0.3em] text-[10px]">
                        Open Navigation
                    </a>
                </div>
            </div>
        </div>

        <div class="md:w-3/5 h-[500px] md:h-auto bg-[#0f1d24] relative">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1000.8369555763772!2d116.84314207820293!3d-1.255003044324004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df147002e32a71d%3A0xa4763b045f7a9840!2sSMK%20Airlangga%20Balikpapan!5e1!3m2!1sid!2sid!4v1769066134634!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade
                class="w-full h-full border-0 opacity-60 contrast-125"
                allowfullscreen=""
                loading="lazy">
            </iframe>
            <div class="absolute inset-0 pointer-events-none border-l border-[#D4B57F]/20"></div>
        </div>
    </div>
</body>
</html>
