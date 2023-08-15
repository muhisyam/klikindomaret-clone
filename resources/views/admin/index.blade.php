<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin - @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <aside class="sidebar w-1/6 h-screen p-4">
        @include('admin.components.sidebar')
    </aside>
    <div class="w-5/6 rounded-s-3xl bg-white h-screen p-8">
        {{-- <header class="header mb-6">
            @include('admin.components.header')
        </header> --}}
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    {{-- Jquery just for select2 purpose only(✌ ͡• ₃ ͡•)✌ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- Thanks for the tolerance(👍 ͡• ₃ ͡•)👍 --}}
    
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="{{ asset('js/admin/app.js') }}"></script>
    @yield('scripts')
</body>
</html>