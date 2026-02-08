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
                    <button onclick="LiveChatWidget.call('maximize')" class="inline-flex items-center gap-3 px-6 py-3 border border-[#D4B57F] text-[#D4B57F] hover:bg-[#D4B57F] hover:text-[#1e3243] transition-all duration-500 uppercase tracking-[0.2em] text-[10px] mt-2 cursor-pointer">
                        <span>Contact Us</span>
                    </button>
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

    <script>
        window.__lc = window.__lc || {};
        window.__lc.license = 19496329;
        window.__lc.integration_name = "manual_channels";
        window.__lc.product_name = "livechat";
        ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
    </script>
    <noscript><a href="https://www.livechat.com/chat-with/19496329/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
    </body>
</html>