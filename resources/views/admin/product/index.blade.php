@extends('admin.index')

@section('title')
List Produk
@endsection

@section('content')
<div class="product-list">
    <div class="product-list-content">
        <h1 class="title text-[#0079c2] text-xl font-bold mb-4">List Produk</h1>
        <section class="product-list-header flex justify-between border border-[#eee] rounded-xl p-4 mb-4">
            <div class="product-filter-wrapper text-sm flex gap-4">
                <div class="product-search-group flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <label for="product-search" class="h-5 me-4"><i class="ri-search-line"></i></label>
                    <input id="product-search" type="text" name="product-search" placeholder="Cari Produk..." class="bg-transparent">
                </div>
                <button class="flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <div class="label pe-2">Urutkan</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
                <button class="flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <div class="label pe-2">Kategori</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
                <button class="flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <div class="label pe-2">Harga</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
                <button class="flex items-center bg-[#f5f5f5] rounded py-2 px-4">
                    <div class="label pe-2">Toko</div>
                    <div class="icon h-5"><i class="ri-arrow-down-s-line"></i></div>
                </button>
            </div>
            <div class="product-input-wrapper">
                <a href="#" class="flex items-center bg-[#0079c2] text-white rounded py-2 px-4">
                    <div class="icon h-6 me-2"><i class="ri-add-line"></i></div>
                    <div class="text">Tambah Produk</div>
                </a>
            </div>
        </section>
        <section class="product-list-wrapper border border-[#eee] rounded-xl p-4">
            <table class="w-full">
                <thead class="bg-[#fbde7e] text-[#0079c2] text-sm text-left rounded-t font-bold">
                    <tr>
                        <th class="rounded-tl py-2 px-4">No.</th>
                        <th class="py-2 px-4">Nama Produk</th>
                        <th class="py-2 px-4">Kategori</th>
                        <th class="py-2 px-4">Toko</th>
                        <th class="py-2 px-4">Stok</th>
                        <th class="py-2 px-4">Harga</th>
                        <th class="py-2 px-4">Terjual</th>
                        <th class="rounded-tr py-2 px-4"></th>
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
                    <tr class="border-b">
                        <td class="py-2 px-4">2</td>
                        <td class="w-96 py-2 px-4">
                            <div class="product-info-wrapper relative flex items-center">
                                <div class="media w-10 me-3">
                                    <img src="https://assets.klikindomaret.com/products/20035630/20035630_thumb.jpg?Version.20.01.1.01" alt="">
                                </div>
                                <div class="name line-clamp-1 text-ellipsis">
                                    Bebelac 3 Susu Pertumbuhan Fos & Gos Vanila 800G
                                </div>
                                <div class="banner-info absolute -top-1 left-12 flex items-center gap-1 blink">
                                    <div class="stock-info text-[#c33] rounded-full">
                                        <span class="icon h-3 block -mt-2"><i class="ri-error-warning-fill"></i></span>
                                    </div>
                                    <div class="discount-info h-3 bg-[#fae7d4] text-[#f28418] text-[8px] rounded-full px-0.5">
                                        <span class="icon block -mt-1"><i class="ri-percent-fill"></i></span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="font-light cursor-pointer py-2 px-4 hover:text-[#0079c2]">Bahan Puding & Agar Agar</td>
                        <td class="font-light cursor-pointer py-2 px-4 hover:text-[#0079c2]">Warehouse 1 Jakarta</td>
                        <td class="text-right font-light py-2 px-4">509</td>
                        <td class="text-right font-light py-2 px-4">
                            <div class="price-wrapper">
                                <div class="normal-price text-[#95989A] text-xs line-through">
                                    Rp <span>1.500.000</span>
                                </div>
                                <div class="discout-price">
                                    Rp <span>150.000</span>
                                </div>
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
        </section>
    </div>
</div>
@endsection