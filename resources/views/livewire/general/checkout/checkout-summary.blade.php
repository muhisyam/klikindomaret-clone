<section data-section="summary">
    <div class="mb-4 space-y-4 p-4 rounded-lg bg-white">
        <div class="flex justify-between text-sm">
            <div class="text-light-gray-300">Total Harga Pesanan</div>
            <div>Rp {{ formatCurrencyIDR($normalTotal) }}</div>
        </div>

        <div class="flex justify-between text-sm">
            <div class="text-light-gray-300">Ongkos Kirim</div>
            <div>GRATIS</div>
        </div>

        <hr>

        <div class="flex justify-between text-primary-600 text-sm">
            <div class="">Total Diskon</div>
            <div>(Rp {{ formatCurrencyIDR($discountTotal) }})</div>
        </div>

        <hr>

        <div class="flex justify-between text-sm font-bold">
            <div class="">Total Pembayaran</div>
            <div>Rp {{ formatCurrencyIDR($grandTotal) }}</div>
        </div>

        <x-button class="py-2 px-4 justify-center w-full text-sm" buttonStyle="secondary" value="Pilih Opsi Pembayaran"/>
        {{-- <button class="w-full bg-[#0079C2] text-white text-sm text-center font-bold rounded py-2 px-4" data-page-name="" data-flag="" data-store-code="">Bayar</button> --}}
        {{-- <button class="w-full flex items-center justify-center bg-[#0079C2] text-white text-sm font-bold rounded py-2 px-4">
            <span class="icon leading-none me-2"><i class="ri-refresh-line"></i></span>
            <span>Perbarui Keranjang</span>
        </button> --}}
    </div>

    <div class="p-6 rounded-lg flex bg-white">
        <input type="text" placeholder="Masukkan Voucher/Kupon" class="w-full text-sm border-0 border-b border-[#CCC] p-0 me-2 focus:ring-transparent">
        <button class="disabled bg-[#cfe1d1] text-white text-center rounded p-2">Gunakan</button>
    </div>
</section>
