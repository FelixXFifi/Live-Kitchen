<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail | Culinary Gallery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#d1dce8] font-serif">
    <main class="py-12">
        <livewire:order-detail :id="$orderId" />
    </main>
    @livewireScripts
</body>
</html>