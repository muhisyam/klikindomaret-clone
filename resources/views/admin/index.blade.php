<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <aside class="sidebar w-1/6 h-screen pt-4 px-6">
        <header class="logo mb-6">
            <a href="https://www.klikindomaret.com/">
                <img class="h-8" src="{{ asset('img/header/logo.png') }}" alt="logo">
            </a>
        </header>
        <section class="search mb-6">
            <div class="search-input-wrapper relative bg-white/40 rounded py-2 px-4">
                <input type="text" placeholder="Search..." class="w-5/6 bg-transparent border-none focus:ring-transparent">
                <span class="icon absolute top-1 right-2 bg-[#f9c828] text-white text-sm rounded py-1 px-2">
                    <i class="ri-search-line"></i>
                </span>
            </div>
        </section>
        <section class="menu">
            <div class="title uppercase text-xs">Main menu</div>
            <ul>
                <li class="py-2">Dashboard</li>
                <li class="py-2">Category</li>
                <li class="py-2">Produk</li>
                <li class="py-2">Setting</li>
            </ul>
        </section>
    </aside>
    <div class="container w-5/6 rounded-3xl bg-white h-screen">

    </div>
</body>
</html>