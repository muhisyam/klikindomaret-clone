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
        <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    </head>
    <body>
        <header class="header fixed w-full top-0 z-50 drop-shadow text-[#313131]">
            @include('frontend.components.navbar')
            @include('frontend.components.category')
            {{-- @include('frontend.components.clean-header') --}}
        </header>
        
        @include('frontend.components.login')
        {{-- @include('frontend.components.register') --}}
        
        <div class="container mx-auto max-w-7xl mt-30">
        {{-- <div class="container mx-auto max-w-7xl mt-24"> --}}
            @yield('content')
        </div>
            
        @include('frontend.components.overlay')
        @include('frontend.components.footer')
        {{-- @include('frontend.components.clean-footer') --}}

        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script> --}}
        @yield('scripts')
    </body>
</html>
