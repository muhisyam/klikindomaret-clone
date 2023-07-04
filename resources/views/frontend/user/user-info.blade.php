@extends('frontend.index')

@section('content')

<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center text-sm">
        <li class="inline-flex items-center text-[#95989A]">
            <a href="#" class="inline-flex items-center hover:text-[#0079C2]">
                Beranda
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <span class="icon h-5 text-[#95989A] mx-2"><i class="ri-arrow-right-s-line"></i></span>
                <span class="text-black">Informasi Akun</span>
            </div>
        </li>
    </ol>
</nav>

<main class="user-info">
    <div class="user-info-wrapper flex">
        <section class="left-side w-1/6 me-4">
            <aside class="sidebar-wrapper text-sm">
                <ul>
                    <li class="active ">
                        <a href="#" class="block text-[#9C9C9C] rounded mb-1 hover:bg-[#E1EEFF] hover:text-[#0079C2] p-3 pl-5">
                            Informasi Akun
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block text-[#9C9C9C] rounded mb-1 hover:bg-[#E1EEFF] hover:text-[#0079C2] p-3 pl-5">
                            Daftar Transaksi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block text-[#9C9C9C] rounded mb-1 hover:bg-[#E1EEFF] hover:text-[#0079C2] p-3 pl-5">
                            Resolusi Komplain
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block text-[#9C9C9C] rounded mb-1 hover:bg-[#E1EEFF] hover:text-[#0079C2] p-3 pl-5">
                            Favorit
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block text-[#9C9C9C] rounded mb-1 hover:bg-[#E1EEFF] hover:text-[#0079C2] p-3 pl-5">
                            Notifikasi<span class="ms-3">(<span>1</span>)</span>
                        </a>
                    </li>
                </ul>
            </aside>
        </section>
        <section class="right-side w-5/6 bg-white rounded-lg p-5">
            <div class="user-info-content">
                <h1 class="title font-bold mb-8">Informasi Akun</h1>
                <div class="form-info-wrapper">
                    @include('frontend.user.includes.user_info.user-form')
                </div>
            </div>
        </section>
    </div>
</main>

<div class="h-[1000px]"></div>

@endsection