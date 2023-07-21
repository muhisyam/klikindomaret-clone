@extends('admin.index')

@section('title')
List Produk
@endsection

@section('content')
<div class="order-list">
    <div class="order-list-content">
        <header class="header flex items-center justify-between mb-4">
            <h1 class="title text-[#0079c2] text-2xl font-bold">Pemesanan</h1>
            <a href="#" class="flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
                <div class="icon h-6 me-2"><i class="ri-printer-fill"></i></div>
                <div class="text">Cetak</div>
            </a>
        </header>
        <section class="order-list-header flex gap-2 border border-[#eee] rounded-xl text-sm py-2 px-4 mb-4">
            <div class="order-search-group flex flex-1 items-center rounded py-2 px-4">
                <label for="order-search" class="h-5 me-4"><i class="ri-search-line"></i></label>
                <input id="order-search" type="text" name="order-search" placeholder="Cari Produk..." class="w-full bg-transparent">
            </div>
            <div class="separator w-[1px] bg-[#eee] my-2"></div>
            <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                <div class="icon h-5 me-1"><i class="ri-filter-3-fill"></i></div>
                <div class="label">Urutkan</div>
            </button>
            <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                <div class="icon h-5 me-1"><i class="ri-calendar-2-fill"></i></div>
                <div class="label">Tanggal</div>
            </button>
            <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                <div class="icon h-5 me-1"><i class="ri-information-fill"></i></div>
                <div class="label">Status</div>
            </button>   
            <button class="flex items-center rounded py-2 px-4 hover:bg-[#f5f5f5]">
                <div class="icon h-5 me-1"><i class="ri-takeaway-fill"></i></div>
                <div class="label">Pengambilan</div>
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
        </section>
        <section class="product-list-wrapper border border-[#eee] rounded-xl p-4">
            <table class="w-full">
                <thead class="bg-[#f5f5f5] text-[#888] text-sm text-left uppercase rounded-t">
                    <tr>
                        <th class="py-3 px-4 rounded-tl">Ref.</th>
                        <th class="py-3 px-4">Dibuat</th>
                        <th class="py-3 px-4">Kostumer</th>
                        <th class="py-3 px-4">List Produk</th>
                        <th class="py-3 px-4 text-[#414141]">Pengambilan</th>
                        <th class="py-3 px-4">Lokasi</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Pengantaran</th>
                        <th class="py-3 px-4">Harga</th>
                        <th class="py-3 px-4 rounded-tr"></th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b">
                        <td class="py-2 px-4 font-bold">#1445</td>
                        <td class="py-2 px-4">
                            <div class="order-created-date">
                                <div class="date">15 Jul 2023</div>
                                <div class="time text-xs font-light">16.00</div>
                            </div>
                        </td>
                        <td class="py-2 px-4">Linguistiq Joe</td>
                        <td class="py-2 px-4">
                            <div class="list-products flex">
                                <div class="info me-1"><span>1</span> Produk</div>
                                <button class="icon h-5 hover:text-[#0079c2]"><i class="ri-eye-fill"></i></button>
                            </div>
                        </td>
                        <td class="py-2 px-4">
                            <div class="order-take-date">
                                <div class="date">17 Jul 2023</div>
                                <div class="time text-xs font-light">10.00</div>
                            </div>
                        </td>
                        <td class="py-2 px-4">
                            <div class="order-take-place">
                                <div class="info">Ambil Ditoko</div>
                                <div class="address flex text-xs font-light">
                                    <div class="address-info me-1">Lokasi</div>
                                    <button class="icon h-4 hover:text-[#0079c2]"><i class="ri-eye-fill"></i></button>
                                </div>
                            </div>
                        </td>
                        <td class="py-2 px-4">
                            <div class="status bg-green-100 text-green-700 font-bold text-center rounded-lg p-1">
                                <div class="info">Dalam Perjalanan</div>
                            </div>
                        </td>
                        <td class="py-2 px-4">
                            <div class="status flex">
                                <div class="icon h-5 text-green-600 scale-[0.6] me-1"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                <div class="info">Selesai</div>
                            </div>
                        </td>
                        <td class="py-2 px-4">
                            <div class="price flex justify-between">
                                <div class="left-side">Rp</div>
                                <div class="right-side">3.600.000</div>
                            </div>
                        </td>
                        <td class="py-2 px-4 text-center">
                            <button class="hover:bg-[#fbde7e] hover:text-[#0079c2] rounded p-1 px-2">
                                <div class="icon h-6 pt-0.5"><i class="ri-more-2-line"></i></div>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</div>
@endsection