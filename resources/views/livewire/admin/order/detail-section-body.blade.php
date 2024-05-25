<section class="flex gap-4" wire:init="loadContent">

    @unless (is_null($order))

    @php
        $delivery = $order['deliveries'];
        $user     = $order['user'];
        $pickup   = $order['pickup_address'];
    @endphp

    <div class="space-y-4 border border-light-gray-100 rounded-xl p-4 h-[460px] w-2/3 overflow-auto">
        <div class="space-y-2">
            <h2 class="mb-4 font-bold">Pembayaran</h2>
            <div class="py-2 px-4 rounded-md grid grid-cols-3 divide-x bg-light-gray-50 text-sm">
                <div class="flex gap-2 items-center pe-4">
                    <span class="text-xs font-light">Channel:</span>
                    <span class="grow text-sm text-center">{{ $order['payment_channel'] }}</span>
                </div>
                <div class="flex gap-2 items-center px-4">
                    <span class="text-xs font-light">Nomor VA:</span>
                    <span class="grow text-sm text-center">{{ $order['va_number'] }}</span>
                </div>
                <div class="flex gap-2 items-center px-4">
                    <span class="text-xs font-light">Tanggal:</span>
                    <span class="grow text-sm text-center">{{ $order['payment_success'] }}</span>
                </div>
            </div>
            <div class="flex justify-between text-sm">
                <span>Subtotal</span>
                <span>{{ formatCurrencyIDR($order['subtotal']) }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span>Ongkos Kirim</span>
                <span>{{ $delivery['delivery_price'] ? formatCurrencyIDR($delivery['delivery_price']) : 'Gratis' }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="font-bold">Total pembayaran</span>
                <span class="text-primary-600 font-bold">{{ formatCurrencyIDR($order['grandtotal']) }}</span>
            </div>
        </div>
        <hr>
        <div class="space-y-2">
            <h2 class="mb-4 font-bold">List Produk</h2>

        @foreach ($order['products'] as $product)
            
            <div @class([
                    'flex items-center gap-4', 
                    '!m-0' => $loop->first
            ])>
                <img class="w-16 rounded-md" src="{{ asset('img/uploads/products/promina-bayi-7-tahun/17057662930.jpg') }}" alt="Product Image">
                {{-- <img class="w-16 rounded-md" src="{{ asset('img/uploads/products/' . $product['product_slug'] . '/' . $product['product_image']) }}" alt="Product Image"> --}}
                <div class="flex-grow">
                    <div class="text-sm font-bold">{{ $product['product_name'] }}</div>
                    <div class="text-sm font-light">x{{ $product['quantity'] }} | {{ formatCurrencyIDR($product['product_price']) }}</div>
                </div>
                <div class="text-sm font-bold">{{ formatCurrencyIDR($product['subtotal']) }}</div>
            </div>
            
        @endforeach

        </div>
    </div>
    <div class="space-y-4 border border-light-gray-100 rounded-xl p-4 h-[460px] w-1/3 overflow-auto">
        <h2 class="mb-4 font-bold">Pengiriman</h2>
        <div class="space-y-2 text-sm">
            <div class="flex gap-2 items-center">
                <span class="w-16 shrink-0 text-xs font-light">Keterangan:</span>
                <span class="grow text-sm">{{ $order['pickup_info'] }}</span>
            </div>
            <div class="flex gap-2 items-center">
                <span class="w-16 shrink-0 text-xs font-light">Jenis:</span>
                <span class="grow text-sm">{{ $delivery['delivery_option'] }}</span>
            </div>
            <div class="flex gap-2 items-center">
                <span class="w-16 shrink-0 text-xs font-light">Tanggal:</span>
                <span class="grow text-sm">{{ $delivery['expected_pickup_date'] }}</span>
            </div>
            <div class="flex gap-2 items-center">
                <span class="w-16 shrink-0 text-xs font-light">Waktu:</span>
                <span class="grow text-sm">{{ $delivery['expected_time_between'] }}</span>
            </div>
            <div class="flex gap-2 items-center">
                <span class="w-16 shrink-0 text-xs font-light">Dikirim:</span>
                <span class="grow text-sm">{{ $order['order_completed'] }}</span>
            </div>
        </div>

        <hr>

        <h2 class="mb-4 font-bold">Kustomer</h2>
        <div class="space-y-2 text-sm">
            <div class="flex gap-2 items-center">
                <span class="w-11 shrink-0 text-xs font-light">Nama:</span>
                <span class="grow text-sm">{{ $user['fullname'] }}</span>
            </div>
            <div class="flex gap-2 items-center">
                <span class="w-11 shrink-0 text-xs font-light">Email:</span>
                <span class="grow text-sm">{{ $user['email'] }}</span>
            </div>
            <div class="flex gap-2 items-center">
                <span class="w-11 shrink-0 text-xs font-light">No. HP:</span>
                <span class="grow text-sm">{{ $user['mobile_number'] }}</span>
            </div>
        </div>
        
        <hr>

        <h2 class="mb-4 font-bold">Alamat Pengiriman</h2>
        <div class="space-y-2 text-sm">
            <div class="flex items-center">
                <span class="w-16 shrink-0 text-xs font-light">Penerima:</span>
                <span class="grow text-sm">{{ $pickup['reciever_name'] }}</span>
            </div>
            <div class="flex items-center">
                <span class="w-16 shrink-0 text-xs font-light">No. HP:</span>
                <span class="grow text-sm">{{ $pickup['reciever_phone_number'] }}</span>
            </div>
            <div class="flex items-baseline">
                <span class="w-16 shrink-0 text-xs font-light">Alamat:</span>
                <address class="grow text-sm">{{ $pickup['place_address'] }}</address>
            </div>
            <div class="flex items-center">
                <span class="w-16 shrink-0 text-xs font-light">Kode Pos:</span>
                <span class="grow text-sm">{{ $pickup['place_postal_code'] }}</span>
            </div>
        </div>
        <x-nav-link href="#" target="_blank" class="text-secondary text-sm" value="Lihat lokasi"/>
    </div>

    @else

    <div class="w-full flex gap-4">
        <div class="space-y-2 border border-light-gray-100 rounded-xl p-4 h-[460px] w-2/3">
            <div class="!mb-4 rounded-lg h-6 w-52 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-md py-2 px-4 grid grid-cols-3 gap-4 bg-light-gray-50">
                <div class="rounded h-5 w-full bg-light-gray-100 animate-pulse"></div>
                <div class="rounded h-5 w-full bg-light-gray-100 animate-pulse"></div>
                <div class="rounded h-5 w-full bg-light-gray-100 animate-pulse"></div>
            </div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>

            <hr class="!my-4">

            <div class="!mb-4 rounded-lg h-6 w-52 bg-light-gray-100 animate-pulse"></div>
            <div class="flex gap-4">
                <div class="rounded-lg h-12 w-16 bg-light-gray-100 animate-pulse"></div>
                <div class="rounded-lg h-5 w-60 bg-light-gray-100 animate-pulse"></div>
            </div>
            <div class="flex gap-4">
                <div class="rounded-lg h-12 w-16 bg-light-gray-100 animate-pulse"></div>
                <div class="rounded-lg h-5 w-60 bg-light-gray-100 animate-pulse"></div>
            </div>
            <div class="flex gap-4">
                <div class="rounded-lg h-12 w-16 bg-light-gray-100 animate-pulse"></div>
                <div class="rounded-lg h-5 w-60 bg-light-gray-100 animate-pulse"></div>
            </div>
        </div>

        <div class="space-y-2 border border-light-gray-100 rounded-xl p-4 h-[460px] w-1/3">
            <div class="!mb-4 rounded-lg h-6 w-52 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>

            <hr class="!my-4">

            <div class="!mb-4 rounded-lg h-6 w-52 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>

            <hr class="!my-4">

            <div class="!mb-4 rounded-lg h-6 w-52 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>
            <div class="rounded-lg h-5 w-40 bg-light-gray-100 animate-pulse"></div>
        </div>
    </div>

    @endunless
    
</section>