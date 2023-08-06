@extends('admin.index')

@section('title')
List Produk
@endsection

@section('content')
<div class="user-list">
    <div class="user-list-content">
        <header class="header mb-6">
            <div class="top-section flex items-center justify-between">
                <div class="left-side min-w-[180px]"><h1 class="title text-2xl font-bold">Pengguna</h1></div>
                <div class="center-side relative">
                    <div class="greeting bg-[#fbde7e] text-[#0079c2] text-center rounded-lg py-1.5 px-6">
                        <div class="text-lg tracking-wide">Selamat <span class="time">Pagi</span>, <span class="name italic font-bold">Jordan!</span></div>
                        <div class="datetime absolute -bottom-5 w-full flex justify-center text-xs font-bold pt-1 -ms-6">Jum'at, 12 Agustus 2023</div>
                    </div>
                </div>
                <div class="right-side min-w-[180px]">
                    <div class="flex items-center float-right">
                        <button class="icon text-lg me-4"><i class="ri-notification-3-line"></i></button>
                        <button class="icon text-lg"><i class="ri-question-line"></i></button>
                        <div class="separator h-7 w-[1px] bg-[#ccc] mx-3"></div>
                        <a href="#" class="w-fit flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
                            <div class="icon h-6 me-2"><i class="ri-add-fill"></i></div>
                            <div class="text">Akun</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="bottom-section">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center text-sm">
                        <li class="inline-flex items-center text-[#95989A]">
                            <a href="#" class="inline-flex items-center hover:text-[#0079C2]">Pengguna</a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="ri-arrow-right-s-line text-[#95989A] mx-2"></i>
                                <span class="text-black">List Pengguna</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </header>
        <section class="data-filter-wrapper border border-[#eee] rounded-xl text-sm py-2 px-4 mb-4">
            <div class="top-section flex gap-2">
                <div class="list-tabs-section flex flex-1 gap-2 me-2">
                    <button class="item-tabs-section rounded py-2 px-4 hover:bg-[#f5f5f5]">Semua</button>
                    <button class="item-tabs-section flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5] active">
                        <div class="icon text-[#f9c828] me-1"><i class="ri-vip-crown-fill"></i></div>
                        <div class="label whitespace-nowrap me-1">Member</div>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">10</div>
                    </button>
                    <button class="item-tabs-section flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                        <div class="label whitespace-nowrap me-1">Non Member</div>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">1.258</div>
                    </button>
                    <button class="item-tabs-section flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                        <div class="label whitespace-nowrap me-1">Admin</div>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">10</div>
                    </button>
                </div>
                <div class="separator w-[1px] bg-[#eee] my-2"></div>
                <div class="count-page-show flex items-center ms-2">
                    <div class="label me-2">Tampilkan per Halaman</div>
                    <div class="input-count-page w-14 rounded p-2 hover:bg-[#f5f5f5]">
                        <select name="" id="" class="w-full bg-transparent">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div class="separator w-[1px] bg-[#eee] my-2"></div>
                <div class="count-page-show w-[268.5px] flex items-center ms-2">
                    <div class="info">Menampilkan <span>1 - 10</span> dari <span>15052</span> Hasil</div>
                </div>
            </div>
            <div class="separator h-[1px] bg-[#eee] my-2"></div>
            <div class="bottom-section flex gap-2">
                <div class="user-search-group flex flex-1 items-center rounded py-2 px-4">
                    <label for="user-search" class="h-5 me-4"><i class="ri-search-line"></i></label>
                    <input id="user-search" type="text" name="user-search" placeholder="Cari Pengguna..." class="w-full bg-transparent">
                </div>
                <div class="separator w-[1px] bg-[#eee] my-2"></div>
                <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                    <div class="icon h-5 me-1"><i class="ri-filter-3-fill"></i></div>
                    <div class="label">Filter</div>
                </button>
                <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                    <div class="icon h-5 me-1"><i class="ri-checkbox-circle-fill"></i></div>
                    <div class="label">Verifikasi</div>
                </button>   
                <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                    <div class="icon h-5 me-1"><i class="ri-time-fill"></i></div>
                    <div class="label">Terakhir Login</div>
                </button>   
                <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                    <div class="icon h-5 me-1"><i class="ri-hand-coin-fill"></i></div>
                    <div class="label">Poinku</div>
                </button>
                <div class="separator w-[1px] bg-[#eee] my-2"></div>
                <button class="layout-setting rounded py-2 px-3 hover:bg-[#f5f5f5]">
                    <div class="icon h-5"><i class="ri-list-settings-line"></i></div>
                </button>
                <div class="separator w-[1px] bg-[#eee] my-2"></div>
                <nav class="header-pagination" aria-label="Page navigation example">
                    <ul class="inline-flex">
                        <li>
                            <a href="#" class="block h-10 px-3 py-2 rounded hover:bg-[#f5f5f5]">
                                <div class="icon h-5"><i class="ri-arrow-left-s-line"></i></div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]">1</a>
                        </li>
                        <li>
                            <a href="#" class="block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]">2</a>
                        </li>
                        <li>
                            <a href="#" class="active block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]" aria-current="page" >3</a>
                        </li>
                        <li>
                            <a href="#" class="block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]">4</a>
                        </li>
                        <li>
                            <a href="#" class="block h-10 py-2 px-4 rounded hover:bg-[#f5f5f5]">5</a>
                        </li>
                        <li>
                            <a href="#" class="block h-10 px-3 py-2 rounded hover:bg-[#f5f5f5]">
                                <div class="icon h-5"><i class="ri-arrow-right-s-line"></i></div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
        <section class="data-table-wrapper border border-[#eee] rounded-xl p-4">
            <table class="w-full">
                <thead class="bg-[#f5f5f5] text-[#999] text-sm text-left uppercase rounded-t">
                    @include('admin.users.includes.table-header')
                </thead>
                <tbody class="text-sm">
                    @include('admin.users.includes.table-content')
                    <tr class="border-b">
                        <td class="py-2 px-3"><input type="checkbox" class="block m-auto"></td>
                        <td class="py-2 px-4">
                            <div class="user-info-wrapper flex">
                                <div class="media me-2">
                                    <img class="h-10 w-10 rounded-full" src="https://www.shutterstock.com/image-vector/young-man-beard-character-260nw-1374216479.jpg" alt="">
                                </div>
                                <div class="info">
                                    <div class="date">Jonathan Yesck</div>
                                    <div class="time text-xs font-light">-</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-2 px-4">joeyesck241</td>
                        <td class="py-2 px-4">0896 2141 4141</td>
                        <td class="py-2 px-4">-</td>
                        <td class="py-2 px-4">-</td>
                        <td class="py-2 px-4">
                            <div class="order-take-date">
                                <div class="date">22 Jun 2023,</div>
                                <div class="time text-xs font-light">23.00</div>
                            </div>
                        </td>
                        <td class="py-2 px-4">21</td>
                        <td class="py-2 px-4 text-center">
                            <button class="hover:bg-[#fbde7e] hover:text-[#0079c2] rounded p-1 px-2">
                                <div class="icon h-6 pt-0.5"><i class="ri-more-2-line"></i></div>
                            </button>
                        </td>
                    </tr>
                    @include('admin.users.includes.table-content')
                    @include('admin.users.includes.table-content')
                    @include('admin.users.includes.table-content')
                    @include('admin.users.includes.table-content')
                    @include('admin.users.includes.table-content')
                    @include('admin.users.includes.table-content')
                    @include('admin.users.includes.table-content')
                    @include('admin.users.includes.table-content')
                </tbody>
            </table>
        </section>
    </div>
</div>
@endsection