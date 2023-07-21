@extends('admin.index')

@section('title')
List Produk
@endsection

@section('content')
<div class="product-list">
    <div class="product-list-content">
        <header class="header flex items-center justify-between mb-4">
            <h1 class="title text-[#0079c2] text-2xl font-bold">Pemesanan</h1>
            <a href="#" class="flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
                <div class="icon h-6 me-2"><i class="ri-printer-fill"></i></div>
                <div class="text">Cetak</div>
            </a>
        </header>
        <section class="product-list-header flex justify-between border border-[#eee] rounded-xl py-2 px-4 mb-4">
            <div class="product-filter-wrapper text-sm flex gap-4">
                {{-- <div class="product-search-group flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <label for="product-search" class="h-5 me-4"><i class="ri-search-line"></i></label>
                    <input id="product-search" type="text" name="product-search" placeholder="Cari Produk..." class="bg-transparent w-64">
                </div> --}}
                <button class="flex items-center px-4 border-e border-[#ccc] hover:bg-[#0079c2] py-2">
                    <div class="icon h-5 me-1"><i class="ri-calendar-2-fill"></i></div>
                    <div class="label me-1">Tanggal</div>
                </button>
                {{-- <button class="flex items-center bg-[#fbde7e] text-[#0079c2] rounded py-2 px-4">
                    <div class="icon h-5 me-1"><i class="ri-filter-2-fill"></i></div>
                    <div class="label me-1">Urutkan</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
                <button class="flex items-center bg-[#fbde7e] text-[#0079c2] rounded py-2 px-4">
                    <div class="icon h-5 me-1"><i class="ri-calendar-2-fill"></i></div>
                    <div class="label me-1">Tanggal</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
                <button class="flex items-center bg-[#fbde7e] text-[#0079c2] rounded py-2 px-4">
                    <div class="icon h-5 me-1"><i class="ri-file-info-fill"></i></div>
                    <div class="label me-1">Status</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
                <button class="flex items-center bg-[#fbde7e] text-[#0079c2] rounded py-2 px-4">
                    <div class="icon h-5 me-1"><i class="ri-takeaway-fill"></i></div>
                    <div class="label pe-2">Pengambilan</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button> --}}
            </div>
            {{-- <div class="product-input-wrapper">
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text-sm">
                      <li>
                        <a href="#" class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                            <i class="ri-arrow-left-s-line"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">1</a>
                      </li>
                      <li>
                        <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
                      </li>
                      <li>
                        <a href="#" aria-current="page" class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                      </li>
                      <li>
                        <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">4</a>
                      </li>
                      <li>
                        <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">5</a>
                      </li>
                      <li>
                        <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                      </li>
                    </ul>
                  </nav>
            </div> --}}
        </section>
        {{-- <section class="product-list-wrapper border border-[#eee] rounded-xl p-4">
            <table class="w-full">
                <thead class="bg-[#fbde7e] text-[#0079c2] text-sm text-left uppercase rounded-t font-bold">
                    <tr>
                        <th class="rounded-tl py-3 px-4">Ref.</th>
                        <th class="py-3 px-4">Dibuat</th>
                        <th class="py-3 px-4">Kostumer</th>
                        <th class="py-3 px-4">Banyak Produk</th>
                        <th class="py-3 px-4">Tgl Pengambilan</th>
                        <th class="py-3 px-4">Tmpt Pengambilan</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="text-right py-3 px-4">Harga</th>
                        <th class="rounded-tr py-3 px-4"></th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b">
                        <td class="py-2 px-4">1</td>
                        <td class="w-96 py-2 px-4">
                            <div class="product-info-wrapper flex items-center">
                                <div class="media w-10 me-3">
                                    <img src="https://assets.klikindomaret.com/products/20035630/20035630_thumb.jpg?Version.20.01.1.01" alt="">
                                </div>
                                <div class="name line-clamp-1 text-ellipsis">
                                    Bebelac 3 Susu Pertumbuhan Fos & Gos Vanila 800G
                                </div>
                            </div>
                        </td>
                        <td class="font-light cursor-pointer py-2 px-4 hover:text-[#0079c2]">Bahan Puding & Agar Agar</td>
                        <td class="font-light cursor-pointer py-2 px-4 hover:text-[#0079c2]">Warehouse 1 Jakarta</td>
                        <td class="text-right font-light py-2 px-4">509</td>
                        <td class="text-right font-light py-2 px-4">
                            <div class="price">
                                Rp <span>1.500.00</span>
                            </div>
                        </td>
                        <td class="text-right font-light py-2 px-4">2206</td>
                        <td class="text-right py-2 p-4">
                            <button class="hover:bg-[#fbde7e] hover:text-[#0079c2] rounded p-1 px-2">
                                <div class="icon h-6 pt-0.5"><i class="ri-more-2-line"></i></div>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section> --}}
    </div>
</div>
@endsection