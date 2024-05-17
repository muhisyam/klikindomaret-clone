<div class="modal w-[1000px] bg-white rounded-xl overflow-hidden{{ $showCondition ? ' show' : '' }}" data-trigger-modal="{{ $section }}">

    @php $orderModel = new \App\Models\Order @endphp

    <section class="flex items-center {{ $orderModel::getHeaderStyle($order['user_order_status']) }}">
        <div class="p-6 w-1/3 bg-white text-black">
            <span class="font-light">Pesanan</span>
            <h4 class="font-bold">#{{ $order['order_key'] }}</h4>
        </div>

        <x-button class="p-6 items-center gap-6" data-switch-section="order-status" data-section-opened="order-detail-info">
            <x-icon class="h-6" src="{{ asset('img/icons/icon-transaction-' . $order['status_icon'] . '.webp') }}"/>
            <span class="font-bold">{{ $order['user_order_status'] }}</span>
            <x-icon class="h-5 transition-transform rotate-180 {{ $orderModel::getIconColorStyle($order['user_order_status']) }}" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}"/>
        </x-button>

        <x-button class="ml-auto mr-6" data-target-modal="{{ $section }}" :preventClose="false">
            <x-icon class="w-5 grayscale" src="{{ asset('img/icons/icon-header-close.webp') }}"/>
        </x-button>
    </section>

    @unless (is_null($order['order_key']))

    <section class="h-[600px] overflow-auto" data-section="order-detail-info">
        {{-- Body order information --}}
        <div class="flex">
            <div class="p-6 w-1/3 space-y-4">
                <div>

                    @php $orderDate = explode('|', $order['created_at']) @endphp

                    <span class="text-xs font-light">Pesanan</span>
                    <div class="text-sm font-bold">{{ $orderDate[0] }}</div>
                    <div class="text-sm font-light">{{ $orderDate[1] }}</div>
                </div>
                <div>
                    <span class="text-xs font-light">Pembayaran</span>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-bold">{{ $order['payment_channel'] }}</div>
                            <div class="text-sm font-light">{{ $order['va_number'] ?? '-' }}</div>
                        </div>
                        <x-button class="p-4" buttonStyle="secondary"></x-button>
                    </div>
                    <span class="text-xs text-primary-600 font-light">Batas waktu pembayaran: 00j:12m:36d</span>
                </div>
            </div>
            <div class="p-6 w-1/3">
                <span class="text-xs font-light">Ringkasan Pembayaran</span>

                @php $totalWithoutShipping = 0; /*TODO: Add total each supp ['Toko' => 1231, 'Ware' => 123...]*/ @endphp
            @foreach ($order['products'] as $supplierName => $groupedBySupplier)
                
                    @php 
                        $totalEachSupplier = 0;

                        foreach ($groupedBySupplier as $product) { 
                            $totalEachSupplier += $product['subtotal'];
                        }

                        $totalWithoutShipping += $totalEachSupplier;
                    @endphp
                
                <div class="flex justify-between text-sm">
                    <span>Subtotal {{ $supplierName }}</span>
                    <span>{{ formatCurrencyIDR($totalEachSupplier) }}</span>
                </div>
                
            @endforeach
                @php $totalShipping = $order['grandtotal'] - $totalWithoutShipping @endphp

                <div class="flex justify-between text-sm">
                    <span>Ongkos Kirim</span>
                    <span>{{ formatCurrencyIDR($totalShipping) }}</span>
                </div>
                <div class="my-2 border-b-2 border-dashed border-light-gray-400"></div>
                <div class="flex justify-between text-sm">
                    <span class="font-bold">Total pembayaran</span>
                    <span class="text-primary-600 font-bold">{{ formatCurrencyIDR($order['grandtotal']) }}</span>
                </div>
            </div>
            <div class="space-y-2 p-6 w-1/3">
                <x-button class="mx-auto py-1.5 justify-center w-52 text-sm" buttonStyle="outline-secondary" value="Petunjuk Pembayaran"/>
                <x-button class="mx-auto py-1.5 justify-center w-52 text-sm" buttonStyle="outline-secondary" value="Batalkan Transaksi"/>
                <div class="text-center text-sm">Butuh bantuan? <a href="#" class="text-secondary">Klik di sini</a></div>
            </div>
        </div>

        {{-- Body product each supplier --}}
        <div>

        @foreach ($order['products'] as $supplierName => $groupedBySupplier)

            @php $supplierIcon = $supplierName === 'Toko Indomaret' ? 'store' : strtolower($supplierName) @endphp

            <div class="mb-6 mx-6 rounded-lg border border-light-gray-100 overflow-hidden">
                {{-- Header --}}
                <div class="py-1.5 flex items-center justify-center gap-2 bg-light-gray-50">
                    <x-icon class="w-5" src="{{ asset('img/icons/icon-send-by-' . $supplierIcon . '.webp') }}"/>
                    <div class="text-sm font-bold">{{ $supplierName }}</div>
                </div>
    
                {{-- Body --}}
                <div class="p-4 space-y-4">

                    {{-- Deliveries --}}
                    @php $delivery = $order['deliveries'][$supplierName] @endphp

                    <div class="flex items-center gap-2">
                        <img class="h-5" src="{{ asset('img/checkout/choose-' . $delivery['delivery_option'] . '.webp') }}" alt="">
                        <div class="text-xs">{{ formatToIdnLocale(\Carbon\Carbon::parse($delivery['expected_pickup_date']), 'j M Y') }} {{ $delivery['expected_time_between'] ? '| ' . $delivery['expected_time_between'] . ' WIB' : ''}}</div>
                    </div>
        
                    {{-- Pickup Address --}}
                    <div>
                        <span class="text-xs font-light">{{ $order['pickup_info'] === 'Diambil' ? 'Diambil di Toko' : 'Alamat Pengiriman' }}</span>
                        <div class="flex items-center gap-4">
                            <img class="rounded-md w-14 h-14 object-cover" src="https://cdn.klikindomaret.com/image/idm4.webp" alt="Pickup Image">
                            <div>
                                <div class="text-sm font-bold">{{ $order['pickup_address']['place_name'] }}</div>
                                <address class="text-xs">{{ $order['pickup_address']['place_address'] }}</address>
                                <x-nav-link class="mt-2 text-xs text-secondary font-bold" href="#" value="Lihat lokasi"/>
                            </div>
                        </div>
                    </div>

                    @unless (is_null($order['pickup_code']))

                    {{-- Pickup Code --}}
                    <div>
                        <span class="text-xs font-light">Kode Pengambilan</span>
                        <div class="rounded-md border-8 border-primary-100 p-2 flex items-center">
                            <div class="w-56 text-2xl text-center font-bold tracking-widest">{{ $order['pickup_code'] }}</div>
                            <div>
                                <div class="text-xs">Tunjukkan barcode atau PIN ini ke kasir untuk mengambil pesanan di toko Indomaret</div>
                                <x-nav-link class="text-xs text-secondary font-bold" href="#" value="Lihat syarat dan ketentuan ambil di toko"/>
                            </div>
                        </div>
                    </div>
                    
                    @endunless

                    {{-- Product --}}
                    <div class="space-y-4">
                        <span class="!m-0 text-xs font-light">Pesanan</span>

                        @php $totalEachSupplier = 0 @endphp

                    @foreach ($groupedBySupplier as $product)
                        
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

                        @php $totalEachSupplier += $product['subtotal'] @endphp

                    @endforeach

                    </div>

                    <div class="border-b-2 border-dashed border-light-gray-400"></div>
    
                    {{-- Total --}}
                    <div class="ml-auto w-1/3 space-y-4">
                        <div class="flex items-center justify-between text-sm">
                            <span>Total Belanja</span>
                            <span class="font-bold">{{ formatCurrencyIDR($totalEachSupplier) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span>Ongkos Kirim</span>
                            <span class="font-bold">{{ $delivery['delivery_price'] ? formatCurrencyIDR($delivery['delivery_price']) : 'Gratis' }}</span>
                        </div>
                        <div class="my-2 border-b-2 border-dashed border-light-gray-400"></div>
                        <div class="flex items-center justify-between text-sm">
                            <span>Subtotal</span>
                            <span class="font-bold">{{ formatCurrencyIDR($totalEachSupplier + $delivery['delivery_price']) }}</span>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
        
        </div>
    </section>
        
    @php /*TODO: Design https://media.nngroup.com/media/editor/2019/01/25/fedex-tracker.jpg*/ @endphp
    <section class="h-[600px] overflow-auto hidden" data-section="order-status">
        
        @unless (is_null($order['payment_success']))

        <ul class="p-6 flex flex-col-reverse">
            <li class="flex">
                <div @class([
                    'status-tracker relative after:!hidden', 
                    'before:!bg-secondary' => empty($order['retailer_status']),
                    'tracker-pulse'        => empty($order['retailer_status']),
                ])></div>
                <div class="pb-4 px-4">
                    <div @class([
                        'text-sm font-light', 
                        'text-light-gray-400' => ! empty($order['retailer_status']),
                        'text-secondary'      => empty($order['retailer_status']),
                    ])>[ {{ $order['payment_success'] }} ]</div>
                    <div class="text-sm">Pembayaran Lunas</div>
                </div>
            </li>

        @foreach ($order['retailer_status'] as $status)
            <li class="flex">
                <div @class([
                    'status-tracker relative', 
                    'before:!bg-secondary' => $loop->last && is_null($order['order_completed']),
                    'tracker-pulse'        => $loop->last && is_null($order['order_completed']),
                ])></div>
                <div class="pb-4 px-4">
                    <div @class([
                        'text-sm font-light', 
                        'text-light-gray-400' => ! $loop->last && is_null($order['order_completed']),
                        'text-secondary'      => $loop->last && is_null($order['order_completed']),
                    ])>{{ $status['created_at'] }}</div>
                    <div class="text-sm">{{ $status['message'] }}</div>
                </div>
            </li>
        @endforeach

        </ul>
            
        @else
            
        <div class="p-6 flex">
            <div class="status-tracker relative tracker-pulse after:!hidden before:!bg-secondary"></div>
            <div class="pb-4 px-4">
                <div class="text-sm font-light text-secondary">[ {{ $order['created_at'] }} ]</div>
                <div class="text-sm">Menunggu Pembayaran</div>
            </div>
        </div>

        @endunless

    </section>

    @endunless

</div>