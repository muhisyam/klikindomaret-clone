<section data-section="summary">
    <div class="mb-4 space-y-4 p-4 rounded-lg bg-white">
        <div class="flex justify-between text-sm">
            <div class="text-light-gray-300">Total Harga Pesanan</div>
            <div>Rp {{ formatCurrencyIDR($normalTotal) }}</div>
        </div>

        <div class="flex justify-between text-sm">
            <div class="text-light-gray-300">Ongkos Kirim</div>
            <div>{{ $deliveryPrice ? 'Rp ' . formatCurrencyIDR($deliveryPrice) : 'GRATIS' }}</div>
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
        
        <x-button class="py-2 px-4 justify-center gap-2 w-full text-sm{{ $loading ? '' : ' hidden' }}" btn-checkout="loading" buttonStyle="secondary">
            <span class="loader-spin inset-0 inline-flex !h-4 !w-4 !bg-transparent after:!inset-0 after:!border-t-white"></span>
            Memuat Keranjang
        </x-button>
    
        <x-button 
            class="py-2 px-4 justify-center w-full text-sm{{ $loading ? ' hidden' : '' }}"
            btn-checkout="pay"
            buttonStyle="secondary"
            value="Pilih Opsi Pembayaran"
            wire:click="getPaymentToken"
            wire:loading.remove
        />

        <x-button 
            class="py-2 px-4 justify-center w-full text-sm hidden{{ $loading ? ' hidden' : '' }}" 
            btn-checkout="updateCart" 
            buttonStyle="secondary" 
            value="Perbarui Keranjang"
            wire:loading.remove
        />
    </div>

    <div class="p-6 rounded-lg flex bg-white">
        <input type="text" placeholder="Masukkan Voucher/Kupon" class="w-full text-sm border-0 border-b border-[#CCC] p-0 me-2 focus:ring-transparent">
        <button class="disabled bg-[#cfe1d1] text-white text-center rounded p-2">Gunakan</button>
    </div>
</section>
