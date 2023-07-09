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
    <aside class="sidebar w-1/6 h-screen p-4">
        @include('admin.components.sidebar')
    </aside>
    <div class="w-5/6 rounded-s-3xl bg-white h-screen p-8">
        <header class="header mb-6">
            @include('admin.components.header')
        </header>
        <main class="w-full h-full border border-[#eee] rounded-xl p-4">
            <h1 class="title text-[#0079c2] text-xl font-bold mb-4">Input Category</h1>
            <form action="">
                <div class="item-input-group flex items-center gap-4 mb-4">
                    <label for="form-select-level" class="w-1/6 text-[#959595]">Level Kategori</label>
                    <select id="form-select-level" name="" class="min-w-[41.6%] border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
                        <option value="" selected>Pilih level...</option>
                        <option value="">Level 1</option>
                        <option value="">Level 2</option>
                        <option value="">Level 3</option>
                    </select>
                </div>
                <div class="item-input-group flex items-center gap-4 mb-4">
                    <label for="form-select-level" class="w-1/6 text-[#959595]">Induk Kategori</label>
                    <select id="form-select-level" name="" class="min-w-[41.6%] border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
                        <option value="" selected>Pilih induk...</option>
                        <option value="">Makanan</option>
                        <option value="">Minuman</option>
                    </select>
                </div>
                <div class="item-input-group flex items-center gap-4 mb-4">
                    <label for="form-input-first-name" class="w-1/6 text-[#959595]">Nama Kategori</label>
                    <input id="form-input-first-name" type="text" name="first-name"" class="min-w-[41.6%] border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
                </div>
                <div class="item-input-group flex items-center gap-4 mb-4">
                    <label for="form-input-first-name" class="w-1/6 text-[#959595]">Slug</label>
                    <input id="form-input-first-name" type="text" name="first-name"" class="min-w-[41.6%] border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
                </div>
                <div class="item-input-group flex items-center gap-4 mb-4">
                    <label for="form-input-first-name" class="w-1/6 text-[#959595]">Gambar Icon Kategori</label>
                    <input type="file" name="" id="" class="py-2">
                </div>
            </form>
        </main>
    </div>
</body>
</html>