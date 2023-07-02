@extends('frontend.index')

@section('content')

<div class="checkout mb-6">
    <div class="checkout-wrapper flex gap-6">
        <div class="left-side checkout-info w-2/3 min-h-screen">
            <div id="alert" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50" role="alert">
                <i class="ri-information-fill text-[#0079C2] scale-[1.5] leading-none"></i>
                <div class="ml-3 text-sm font-medium">
                    Pastikan kamu sudah menandai titik lokasi dengan benar pada alamat yang dipilih untuk pengantaran pesanan.
                </div>
                <button type="button" class="ml-auto bg-blue-50 text-[#0079C2] rounded-lg p-1.5 hover:bg-blue-200 grid h-8 w-8" data-dismiss-target="#alert" aria-label="Close">
                    <i class="ri-close-line scale-[1.5]"></i>
                </button>
            </div>
            <div class="free-ongkir-wrapper flex bg-white text-sm rounded-lg py-3 px-4 mb-4">
                <i class="ri-takeaway-fill text-[#0079C2] mr-2"></i>
                Yuk, tambah belanjaan kamu supaya dapat gratis ongkos kirim!
                <button class="text-[#0079C2] ml-1">
                    Lihat Selengkapnya
                </button>
            </div>
            <div class="product-cart-wrapper bg-white rounded-lg p-5">
                <div class="product-cart-content">
                    <div class="item-cart-1 border border-[#EEE] rounded" data-store-code="">
                        <div class="header flex bg-[#F9F9F9] border-b border-[#EEE] text-sm py-2 px-4">
                            <i class="ri-store-3-line text-[#FF6363] mr-2"></i>
                            <div class="store-name text-[#FF6363] font-bold mr-1">Toko Indomaret</div>
                            <div class="total-product text-[#313131]">(<span>2</span> Item)</div>
                        </div>
                        <div class="list-product-wrapper">
                            <div class="item-product-1 flex p-4">
                                <div class="media w-1/12 mr-2">
                                    <img src="https://assets.klikindomaret.com/products/20122571/20122571_thumb.jpg?Version.20.03.1.01" alt="Product Image">
                                </div>
                                <div class="info w-11/12 flex text-sm">
                                    <div class="name w-1/2 mr-2">
                                        <a class="hover:text-[#0079C2]" href="#">Chilgo 3+ Susu Pertumbuhan Vanila 700G Chilgo 3+ Susu Pertumbuhan Vanila 700G Chilgo 3+ Susu Pertumbuhan Vanila 700G Chilgo 3+ Susu Pertumbuhan Vanila 700G Chilgo 3+ Susu Pertumbuhan Vanila 700G Chilgo 3+ Susu Pertumbuhan Vanila 700G Chilgo 3+ Susu Pertumbuhan Vanila 700G Chilgo 3+ Susu Pertumbuhan Vanila 700G</a>
                                    </div>
                                    <div class="summary w-1/2 flex items-center">
                                        <div class="price w-1/3">
                                            <div class="discount-wrapper flex items-center text-[10px] mb-2">
                                                <div class="left-side max-w-[40px] h-6 rounded bg-[#FAE7D4] text-[#F28418] text-center font-bold py-1 px-1.5 me-2">
                                                    <span>50%</span>
                                                </div>
                                                <div class="right-side text-[#95989A] leading-none line-through">
                                                    <div>Rp 99.000</div>
                                                </div>
                                            </div>
                                            <div class="price-wrapper">
                                                <div class="line-clamp-1 text-[#F28418] text-sm text-ellipsis leading-none">Rp 111.142.500</div>
                                            </div>
                                        </div>
                                        <div class="price-qty flex items-center justify-between w-2/3">
                                            <div class="qty text-center">
                                                <span>Qty</span>
                                                <div class="input-qty-wrapper my-1">
                                                    <button type="button" class="h-8 inline-flex text-[#C5C5C5] text-sm font-bold border border-[#C5C5C5] rounded p-2 hover:bg-[#0079C2] hover:text-white hover:border-[#0079C2]" id="btn-min-qty">
                                                        <i class="ri-subtract-line leading-none"></i>
                                                    </button>
                                                    <input type="number" class="w-10 h-8 text-center border-0 border-b border-[#C5C5C5] p-0 mx-1 focus:ring-transparent focus:border-[#C5C5C5]" value="1" id="input-qty">
                                                    <button type="button" class="h-8 inline-flex text-[#C5C5C5] text-sm font-bold border border-[#C5C5C5] rounded p-2 hover:bg-[#0079C2] hover:text-white hover:border-[#0079C2]" id="btn-plus-qty">
                                                        <i class="ri-add-line leading-none"></i>
                                                    </button>
                                                </div>
                                                <span class="error-stock text-[#BF1F1F] text-[10px]">Persediaan tidak mencukupi</span>
                                            </div>
                                            <div class="subtotal">Rp 111.200.000</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-product-2 flex p-4">
                                <div class="media w-1/12 mr-2">
                                    <img src="https://assets.klikindomaret.com/products/20122571/20122571_thumb.jpg?Version.20.03.1.01" alt="Product Image">
                                </div>
                                <div class="info w-11/12 flex text-sm">
                                    <div class="name w-1/2 mr-2">
                                        <a class="hover:text-[#0079C2]" href="#">Chilgo 3+ Susu Pertumbuhan Vanila 700G</a>
                                    </div>
                                    <div class="summary w-1/2 flex items-center">
                                        <div class="price w-1/3">
                                            <div class="price-wrapper">
                                                <div class="line-clamp-1 text-sm text-ellipsis leading-none">Rp 111.142.500</div>
                                            </div>
                                        </div>
                                        <div class="price-qty flex items-center justify-between w-2/3">
                                            <div class="qty text-center">
                                                <span>Qty</span>
                                                <div class="input-qty-wrapper my-1">
                                                    <button type="button" class="h-8 inline-flex text-[#C5C5C5] text-sm font-bold border border-[#C5C5C5] rounded p-2 hover:bg-[#0079C2] hover:text-white hover:border-[#0079C2]" id="btn-min-qty">
                                                        <i class="ri-subtract-line leading-none"></i>
                                                    </button>
                                                    <input type="number" class="w-10 h-8 text-center border-0 border-b border-[#C5C5C5] p-0 mx-1 focus:ring-transparent focus:border-[#C5C5C5]" value="1" id="input-qty">
                                                    <button type="button" class="h-8 inline-flex text-[#C5C5C5] text-sm font-bold border border-[#C5C5C5] rounded p-2 hover:bg-[#0079C2] hover:text-white hover:border-[#0079C2]" id="btn-plus-qty">
                                                        <i class="ri-add-line leading-none"></i>
                                                    </button>
                                                </div>
                                                <span class="error-stock text-[#BF1F1F] text-[10px]">Persediaan tidak mencukupi</span>
                                            </div>
                                            <div class="subtotal">Rp 111.200.000</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="subtotal flex bg-[#F9F9F9] border-t border-[#EEE] text-sm font-bold py-2 px-4">
                            <div class="left-side w-2/3 text-end">Subtotal:</div>
                            <div class="right-side ms-auto">Rp 111.157.500</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-side checkout-summary w-1/3 bg-white"></div>
    </div>
</div>

@endsection