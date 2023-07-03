<div class="item-modal modal" id="popup-free-shipping">
    <div class="modal-wrapper w-96 bg-white rounded-lg p-5">
        <div class="modal-content">
            <div class="media w-32 mx-auto mb-4">
                <img src="https://www.klikindomaret.com/Assets/image/image-free-ongkir.png" alt="Free Shipping Image">
            </div>
            <div class="desc mb-4">
                Dapatkan gratis ongkos kirim dengan pembelanjaan minimal tertentu dalam satu penjual sebagai berikut:
            </div>
            <div class="list-info mb-6">
                <div class="item-info-1 mb-2">
                    <div class="media w-24">
                        <img src="https://assets.klikindomaret.com/images/klikindomaret/icon_pilihan_waktu.png">
                    </div>
                    <div class="desc text-xs">
                        Belanja produk toko Indomaret minimal <strong>Rp 100.000</strong>
                    </div>
                </div>
                <div class="item-info-1">
                    <div class="media w-24">
                        <img src="https://assets.klikindomaret.com/images/klikindomaret/icon_express.png">
                    </div>
                    <div class="desc text-xs">
                        Belanja produk toko Indomaret minimal <strong>Rp 150.000</strong>
                    </div>
                </div>
            </div>
            <div class="button-close-modal">
                <button class="w-full border border-[#0079C2] text-[#0079C2] text-sm font-bold rounded py-2" onclick="openModal(this)" data-button-role="hide-modal" data-modal-hide="#popup-free-shipping">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="item-modal modal" id="popup-delete-product">
    <div class="modal-wrapper w-96 bg-white rounded-lg p-5">
        <div class="modal-content text-center">
            <div class="media w-32 mx-auto mb-4">
                <img src="{{ asset('img/checkout/image-delete-product.png') }}" alt="Delete Product Image">
            </div>
            <div class="desc font-bold mb-4">
                Apakah anda yakin ingin menghapus produk ini dari keranjang?
            </div>
            <div class="product-name text-[#95989A] text-sm mb-6">
                "<span>Chilgo 3+ Susu Pertumbuhan Vanila 700G</span>"
            </div>
            <div class="list-action flex gap-4">
                <div class="button-close-modal flex-1">
                    <button class="w-full border border-[#0079C2] text-[#0079C2] text-sm font-bold rounded py-2" onclick="openModal(this)" data-button-role="hide-modal" data-modal-hide="#popup-delete-product">Batal</button>
                </div>
                <div class="button-delete-product flex-1">
                    <button class="w-full bg-[#C33] border border-[#C33] text-white text-sm font-bold rounded py-2" data-modal-hide="#popup-delete-product">Hapus Produk</button>
                </div>
            </div>
        </div>
    </div>
</div>