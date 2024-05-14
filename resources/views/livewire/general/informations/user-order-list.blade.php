<div class="space-y-6" wire:init="loadContent">

@forelse ($orders as $order)

    <button class="group relative rounded-lg w-full overflow-hidden shadow-card" wire:click="openOrderModal('{{ $order['order_key'] }}')">
        <div class="flex items-center justify-between bg-light-gray-50">
            <div class="rounded-br-full py-2 px-4 flex items-center gap-3 w-72 {{ \App\Models\Order::getHeaderStyle($order['user_order_status']) }}">
                <x-icon class="h-6" src="{{ asset('img/icons/icon-transaction-' . $order['status_icon'] . '.webp') }}"/>
                <span class="text-sm font-bold">{{ $order['user_order_status'] }}</span>
            </div>
            <div class="text-sm font-bold">#{{ $order['order_key'] }}</div>
            <div class="w-72 pe-4 text-sm text-end">{{ $order['created_at'] }}</div>
        </div>
        <div class="flex gap-4 p-4">
            <ul class="w-4/5">

            @php $productLeft = $order['product_count'] @endphp
            @foreach ($order['products'] as $index => $product)

            @if ($index > 1) 
                <div class="py-1 text-left text-sm text-secondary">Lihat {{ $productLeft }} produk lainnya...</div>
                @break 
            @endif

                <li class="flex items-center gap-2">
                    <img class="rounded h-12 w-12 object-fill" src="{{ asset('img/uploads/products/promina-bayi-7-tahun/17057662930.jpg') }}" alt="Product Image">
                    {{-- <img class="rounded h-12 w-12 object-fill" src="{{ asset('img/uploads/products/' . $product['product_slug'] . '/' . $product['product_image']) }}" alt="Product Image"> --}}
                    <div class="text-start">
                        <div class="text-sm font-bold">{{ $product['product_name'] }}</div>
                        <div class="text-sm font-light">x{{ $product['quantity'] }} | {{ formatCurrencyIDR($product['subtotal']) }}</div>
                    </div>
                </li>
                <hr class="my-2">

            @php $productLeft-- @endphp

            @endforeach
            
            </ul>
            <div class="w-1/5 text-end">
                <div class="text-sm">Subtotal Pembayaran</div>
                <div class="text-lg text-primary-600 font-bold">{{ formatCurrencyIDR($order['grandtotal']) }}</div>
            </div>
        </div>
        <div class="absolute -bottom-full left-1/2 -translate-x-1/2 rounded-full py-2 px-4 flex items-center gap-2 bg-light-gray-50 transition-all group-hover:bottom-2">
            <div class="text-sm text-secondary">Lihat Pesanan</div>
            <x-icon class="w-4 -rotate-90" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
        </div>
    </button>

@if ($loop->last)
    <x-button class="mx-auto py-1.5 px-6" buttonStyle="secondary" value="Muat pesanan lagi"/>
@endif

@empty
    <div>Empty</div>
@endforelse
    
</div>