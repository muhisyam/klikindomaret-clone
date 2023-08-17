@extends('admin.index')

@section('title')
List Produk
@endsection

@section('content')
<div class="user-list">
    @php
        $dataHeader = [
            'pagename' => 'Data Pengguna',
            'breadcrumb_pages' => [
                [
                    'info' => 'first',
                    'label' => 'Pengguna', 
                    'link' => 'users'
                ],
                [
                    'info' => 'last',
                    'label' => 'Data Pengguna'
                ],
            ],
            'navigation' => [
                'info' => 'add',
                'url' => '/user/create',
                'icon' => 'ri-add-fill',
                'label' => 'Akun'
            ]
        ]
    @endphp
    <section class="data-filter-wrapper border border-[#eee] rounded-xl text-sm py-2 px-4 mb-4">
        <section class="top-section flex gap-2">
            <ul class="list-tabs-section flex flex-1 gap-2 me-2">
                <li class="item-tabs-section">
                    <button class="rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Tab filter data table">Semua</button>
                </li>
                <li class="item-tabs-section">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5] active" aria-label="Tab filter data table">
                        <div class="icon text-[#f9c828] me-1"><i class="ri-vip-crown-fill"></i></div>
                        <h2 class="label whitespace-nowrap me-1">Member</h2>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">10</div>
                    </button>
                </li>
                <li class="item-tabs-section">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Tab filter data table">
                        <h2 class="label whitespace-nowrap me-1">Non Member</h2>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">1.258</div>
                    </button>
                </li>
                <li class="item-tabs-section">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Tab filter data table">
                        <h2 class="label whitespace-nowrap me-1">Admin</h2>
                        <div class="count bg-[#fbde7e] text-[#0079c2] text-xs font-normal rounded py-0.5 px-1.5">10</div>
                    </button>
                </li>
            </ul>
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
                <p class="info">Menampilkan <span>1 - 10</span> dari <span>15052</span> Hasil</p>
            </div>
        </section>
        <div class="separator h-[1px] bg-[#eee] my-2"></div>
        <section class="bottom-section flex gap-2">
            <div class="user-search-group flex flex-1 items-center rounded py-2 px-4">
                <label for="user-search" class="h-5 me-4"><i class="ri-search-line"></i></label>
                <input id="user-search" type="text" name="user-search" placeholder="Cari Pengguna..." class="w-full bg-transparent">
            </div>
            <div class="separator w-[1px] bg-[#eee] my-2"></div>
            <ul class="list-filter-table flex gap-2">
                <li class="item-filter-table">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Table filter">
                        <div class="icon h-5 me-1"><i class="ri-filter-3-fill"></i></div>
                        <div class="label">Filter</div>
                    </button>
                </li>
                <li class="item-filter-table">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Table filter">
                        <div class="icon h-5 me-1"><i class="ri-checkbox-circle-fill"></i></div>
                        <div class="label">Verifikasi</div>
                    </button>   
                </li>
                <li class="item-filter-table">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Table filter">
                        <div class="icon h-5 me-1"><i class="ri-time-fill"></i></div>
                        <div class="label">Terakhir Login</div>
                    </button>   
                </li>
                <li class="item-filter-table">
                    <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]" aria-label="Table filter">
                        <div class="icon h-5 me-1"><i class="ri-hand-coin-fill"></i></div>
                        <div class="label">Poinku</div>
                    </button>
                </li>
            </ul>
            <div class="separator w-[1px] bg-[#eee] my-2"></div>
            <button class="layout-setting rounded py-2 px-3 hover:bg-[#f5f5f5]" aria-label="Setting layout table">
                <div class="icon h-5"><i class="ri-list-settings-line"></i></div>
            </button>
            <div class="separator w-[1px] bg-[#eee] my-2"></div>
            <nav class="header-pagination" aria-label="Page navigation">
                <ul class="inline-flex">
                    <li>
                        <a href="#" class="block h-10 px-3 py-2 rounded hover:bg-[#f5f5f5]" aria-label="Previous page">
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
                        <a href="#" class="block h-10 px-3 py-2 rounded hover:bg-[#f5f5f5]" aria-label="Next page">
                            <div class="icon h-5"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
    </section>
    <section class="data-table-wrapper border border-[#eee] rounded-xl p-4">
        <table class="w-full">
            <thead class="bg-[#f5f5f5] text-[#999] text-sm text-left uppercase rounded-t">
                @include('admin.users.includes.table-header')
            </thead>
            <tbody class="text-sm">
                @include('admin.users.includes.table-content')
                <tr class="border-b">
                    <td class="py-2 px-3"><input type="checkbox" class="block m-auto" aria-label="Checkbox select data"></td>
                    <td class="py-2 px-4">
                        <div class="user-info-wrapper flex">
                            <div class="media me-2">
                                <img class="h-10 w-10 rounded-md" src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=580&q=80" alt="">
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
                        <button class="hover:bg-[#fbde7e] hover:text-[#0079c2] rounded p-1 px-2" aria-label="Data action">
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
@endsection