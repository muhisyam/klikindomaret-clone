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
    <aside class="sidebar w-1/5 h-screen bg-white m-4 rounded-lg">
        <header>
            <div class="logo">
                <a href="https://www.klikindomaret.com/">
                    <img class="h-8" src="{{ asset('img/header/logo.png') }}" alt="logo">
                </a>
            </div>
        </header>
    </aside>
</body>
</html>