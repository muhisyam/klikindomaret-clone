<section class="mb-4 border border-light-gray-100 rounded-xl p-4 grid grid-cols-4 divide-x text-sm @if (is_null($order)) gap-6 @endif">

    @unless (is_null($order))

    <div class="flex gap-2 items-center pe-4">
        <span class="text-xs font-light">Kode Pesanan:</span>
        <span class="grow text-sm text-center font-bold">#{{ $order['order_key'] }}</span>
    </div>
    <div class="flex gap-2 items-center px-4">
        <span class="text-xs font-light">Kode Pengambilan:</span>
        <span class="grow text-sm text-center">{{ $order['pickup_code'] }}</span>
    </div>
    <div class="flex gap-2 items-center px-4">
        <span class="text-xs font-light">Expired:</span>
        <span class="grow text-sm text-center">{{ $order['pickup_expired'] }}</span>
    </div>
    <div class="flex gap-2 items-center px-4">
        <span class="text-xs font-light">Status:</span>
        <span class="rounded py-1 grow text-sm text-center font-bold {{ \App\Models\Order::getStyleRetailerStatus($order['retailer_order_status']) }}">
            {{ \App\Models\Order::$retailerStatusMessage[$order['retailer_order_status']] }}
        </span>
    </div>

    @else

    <div class="rounded-lg h-7 w-full bg-light-gray-100 animate-pulse"></div>
    <div class="rounded-lg h-7 w-full bg-light-gray-100 animate-pulse"></div>
    <div class="rounded-lg h-7 w-full bg-light-gray-100 animate-pulse"></div>
    <div class="rounded-lg h-7 w-full bg-light-gray-100 animate-pulse"></div>

    @endunless
    
</section>