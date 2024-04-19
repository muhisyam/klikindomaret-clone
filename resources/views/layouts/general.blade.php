<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Klik Indomaret - Clone</title>

        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

        @vite(['resources/css/app.css','resources/js/app.js'])

        {{-- Fonts --}}
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

        <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/general.css') }}" rel="stylesheet">
        <link href="{{ asset('css/components.css') }}" rel="stylesheet">
        
        <script src="{{ asset('js/swiper-bundle.min.js') }}" async></script>
    </head>
    <body>
        <header class="sticky top-0 z-50 drop-shadow w-full text-black">
            @include('frontend.components.navbar')
        </header>
        
        <main {{ $attributes->merge(['class' => 'container mx-auto max-w-7xl mt-6']) }}>
            {{ $slot }}
        </main>
            
        @include('frontend.components.footer')

        
        <div id="components-container" class="relative z-[60]">
            @stack('components')
            <div separate-modal-overlay=""></div>
        </div>

        <script type="module" src="{{ asset('js/general.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        @stack('scripts')
    </body>
</html>
