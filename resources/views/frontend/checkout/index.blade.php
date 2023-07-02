@extends('frontend.index')

@section('content')

<div class="checkout mb-6">
    <div class="checkout-wrapper relative flex gap-6">
        <div class="left-side checkout-info w-3/4">
            <div id="alert" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50" role="alert">
                <i class="ri-information-fill text-[#0079C2] scale-[1.5] leading-none"></i>
                <div class="ml-3 text-sm font-medium">
                    Pastikan kamu sudah menandai titik lokasi dengan benar pada alamat yang dipilih untuk pengantaran pesanan.
                </div>
                <button type="button" class="ml-auto bg-blue-50 text-[#0079C2] rounded-lg p-1.5 hover:bg-blue-200 grid h-8 w-8" data-dismiss-target="#alert" aria-label="Close">
                    <i class="ri-close-line scale-[1.5]"></i>
                </button>
            </div>
            <div class="free-ongkir flex bg-white text-sm rounded-lg py-3 px-4 mb-4">
                <span class="icon text-[#0079C2] mr-2"><i class="ri-takeaway-fill"></i></span>
                Yuk, tambah belanjaan kamu supaya dapat gratis ongkos kirim!
                <button class="text-[#0079C2] ml-1">
                    Lihat Selengkapnya
                </button>
            </div>
            <div class="product-cart bg-white rounded-lg p-5">
                <div class="product-cart-wrapper">
                    <div class="item-cart-1 border border-[#EEE] rounded" data-store-code="">
                        <div class="header flex items-center bg-[#F9F9F9] border-b border-[#EEE] text-sm py-2 px-4">
                            <span class="icon text-[#FF6363] text-base mr-2"><i class="ri-store-3-line"></i></span>
                            <div class="store-name text-[#FF6363] font-bold mr-1">Toko Indomaret</div>
                            <div class="total-product text-[#313131]">(<span>2</span> Item)</div>
                        </div>
                        <div class="list-product-wrapper">
                            <div class="item-product-1 relative flex p-4" id="cart-id214124" data-cart-id="id214124" data-product-id="" data-plu="" data-price="">
                                <div class="media w-1/12 mr-2">
                                    <img src="https://assets.klikindomaret.com/products/20122571/20122571_thumb.jpg?Version.20.03.1.01" alt="Product Image">
                                </div>
                                <div class="info w-11/12 flex text-sm">
                                    <div class="name w-1/2 mr-4">
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
                                <div class="button-delete-product absolute top-0 right-0">
                                    <button class="h-8 bg-red-600 text-white rounded-bl-full py-1 ps-8 pe-6" data-tooltip-target="delete-product-tooltip" data-tooltip-placement="bottom">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="item-product-2 relative flex p-4" id="cart-id79879" data-cart-id="id79879" data-product-id="" data-plu="" data-price="">
                                <div class="media w-1/12 mr-2">
                                    <img src="https://assets.klikindomaret.com/products/20122571/20122571_thumb.jpg?Version.20.03.1.01" alt="Product Image">
                                </div>
                                <div class="info w-11/12 flex text-sm">
                                    <div class="name w-1/2 mr-4">
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
                                <div class="button-delete-product absolute top-0 right-0">
                                    <button class="h-8 bg-red-600 text-white rounded-bl-full py-1 ps-8 pe-6" data-tooltip-target="delete-product-tooltip" data-tooltip-placement="bottom">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="subtotal flex bg-[#F9F9F9] border-t border-[#EEE] text-sm font-bold py-2 px-4">
                            <div class="left-side w-2/3 text-end">Subtotal:</div>
                            <div class="right-side ms-auto">Rp 111.157.500</div>
                        </div>
                        <div id="delete-product-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Hapus produk ini
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-side checkout-summary w-1/4">
            <div class="summary-wrapper sticky top-20">
                <div class="change-address bg-white rounded-lg cursor-pointer py-2 px-4 mb-4">
                    <div class="change-address-content flex">
                        <span class="icon text-[#0079C2] me-2"><i class="ri-map-pin-fill"></i></span>
                        <div class="info text-xs line-clamp-1 text-ellipsis leading-6"><strong>Ambil di: </strong><span class="address">JANTI-SLEMAN (FWFU), JL JANTI 03 RT008/004 KEL CATURTUNGGAL KEC DEPOK KAB SLEMAN YOGYAKARTA</span></div>
                        <span class="icon text-[#0079C2] ms-2"><i class="ri-arrow-down-s-line"></i></span>
                    </div>
                </div>
                <div class="product-summary bg-white rounded-lg p-4 mb-4">
                    <div class="price-summary-wrapper mb-4">
                        <div class="total-price flex justify-between text-sm mb-4">
                            <div class="label text-[#95989A]">Total Harga Pesanan</div>
                            <div class="info">Rp 111.200.000</div>
                        </div>
                        <div class="shipping-cost flex justify-between text-sm mb-4">
                            <div class="label text-[#95989A]">Ongkos Kirim</div>
                            <div class="info">GRATIS</div>
                        </div>
                        <hr>
                        <div class="total-dicount flex justify-between text-[#F28418] text-sm my-4">
                            <div class="label">Total Diskon</div>
                            <div class="info">(Rp <span>200.000</span>)</div>
                        </div>
                        <hr>
                        <div class="subtotal flex justify-between text-sm font-bold mt-4">
                            <div class="label">Total Pembayaran</div>
                            <div class="info">Rp 111.200.000</div>
                        </div>
                    </div>
                    <div class="button-summary-wrapper w-full">
                        <button class="w-full bg-[#0079C2] text-white text-sm text-center font-bold rounded py-2 px-4" data-page-name="" data-flag="" data-store-code="">Pilih Metode Pembayaran</button>
                        {{-- <button class="w-full bg-[#0079C2] text-white text-sm text-center font-bold rounded py-2 px-4" data-page-name="" data-flag="" data-store-code="">Bayar</button> --}}
                        {{-- <button class="w-full flex items-center justify-center bg-[#0079C2] text-white text-sm font-bold rounded py-2 px-4">
                            <span class="icon leading-none me-2"><i class="ri-refresh-line"></i></span>
                            <span>Perbarui Keranjang</span>
                        </button> --}}
                    </div>
                </div>
                <div class="input-coupon-voucher bg-white rounded-lg p-4">
                    <div class="input-voucher-wrapper flex">
                        <input type="text" placeholder="Masukkan Voucher/Kupon" class="w-full text-sm border-0 border-b border-[#CCC] p-0 me-2 focus:ring-transparent">
                        <button class="disabled bg-[#09C01A] text-white text-center rounded p-2">Gunakan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection