<table class="min-w-full w-max" wire:init="loadContent">
    <thead class="bg-[#f5f5f5] text-[#999] text-sm text-left uppercase rounded-t">
        <tr>
            <th class="p-3 rounded-tl-md w-12"><input type="checkbox" class="block m-auto" aria-label="Checkbox select all data"></th>
            <th class="py-3 px-4">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc'  => $sortBy === "order_key" && $orderBy === "asc",
                    'active-desc' => $sortBy === "order_key" && $orderBy === "desc",
                ]) wire:click="sortBy('order_key')">
                    <div class="me-1">Kode</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc'  => $sortBy === "created_date" && $orderBy === "asc",
                    'active-desc' => $sortBy === "created_date" && $orderBy === "desc",
                ]) wire:click="sortBy('created_date')">
                    <div class="me-1">Tanggal Masuk</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">Kostumer</th>
            <th class="py-3 px-4">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc'  => $sortBy === "picked_info" && $orderBy === "asc",
                    'active-desc' => $sortBy === "picked_info" && $orderBy === "desc",
                ]) wire:click="sortBy('picked_info')">
                    <div class="me-1">Pengambilan</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc'  => $sortBy === "picked_date" && $orderBy === "asc",
                    'active-desc' => $sortBy === "picked_date" && $orderBy === "desc",
                ]) wire:click="sortBy('picked_date')">
                    <div class="me-1">Tanggal Ambil</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">Kode Ambil</th>
            <th class="py-3 px-4">List Produk</th>
            <th class="py-3 px-4 w-36">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc'  => $sortBy === "retailer_order_status" && $orderBy === "asc",
                    'active-desc' => $sortBy === "retailer_order_status" && $orderBy === "desc",
                ]) wire:click="sortBy('retailer_order_status')">
                    <div class="me-1">Status</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4">
                <div @class([
                    'relative flex cursor-pointer', 
                    'active-asc'  => $sortBy === "grandtotal" && $orderBy === "asc",
                    'active-desc' => $sortBy === "grandtotal" && $orderBy === "desc",
                ]) wire:click="sortBy('grandtotal')">
                    <div class="me-1">Harga</div>
                    <div class="sortable" data-sort></div>
                </div>
            </th>
            <th class="py-3 px-4 rounded-tr-md w-9"></th>
        </tr>
    </thead>

    <tbody class="text-sm">

    @unless (is_null($orders))

    @forelse ($orders as $index => $order)
        
        <tr class="border-b">
            <td class="py-2 px-3"><input type="checkbox" aria-label="Checkbox select data"></td>
            <td class="py-2 px-4 font-bold">#{{ $order['order_key'] }}</td>
            <td class="py-2 px-4">
                <div>{{ $order['created_date'] }}</div>
                <div class="text-xs font-light">{{ $order['created_time'] }}</div>
            </td>
            <td class="py-2 px-4">{{ $order['username'] }}</td>
            <td class="py-2 px-4">
                <div class="order-take-place">
                    <div class="info">{{ $order['pickup_info'] }}</div>
                    <div class="address flex text-xs font-light">
                        <div class="address-info me-1">Lokasi</div>
                        <button class="icon h-4 hover:text-[#0079c2]" aria-label="See address data"><i class="ri-eye-fill"></i></button>
                    </div>
                </div>
            </td>

            @php $delivery = $order['deliveries'] @endphp

            <td class="py-2 px-4">
                <div>{{ $delivery['expected_pickup_date'] }}</div>
                <div class="text-xs font-light">{{ $delivery['expected_time_between'] }}</div>
            </td>
            <td class="py-2 px-4">{{ $order['pickup_code'] }}</td>
            <td class="py-2 px-4">
                <div class="flex items-center gap-2">
                    <div><span>{{ $order['products_count'] }}</span> Produk</div>
                    <button class="h-5 hover:text-[#0079c2]" aria-label="List product data"><i class="ri-eye-fill"></i></button>
                </div>
            </td>
            <td class="py-2 px-4">
                <div class="rounded-lg py-1 min-w-[112px] font-bold text-center {{ \App\Models\Order::getStyleRetailerStatus($order['retailer_order_status']) }}">
                    {{ $order['retailer_order_status'] }}
                </div>
            </td>
            <td class="py-2 px-4">{{ formatCurrencyIDR($order['grandtotal']) }}</td>
            <td class="py-2 px-2 flex justify-end">
                <x-nav-link href="{{ route('orders.show', ['user' => session('user')['username'] ,'order' => $order['order_key']]) }}" 
                            class="rounded-md h-9 w-9 cursor-pointer group hover:bg-tertiary" 
                            data-tooltip-target="action-edit-{{ $index }}">
                    <x-icon class="mx-auto w-3 grayscale group-hover:grayscale-0" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                </x-nav-link>
                <x-tooltip data-tooltip-trigger="action-edit-{{ $index }}" value="Edit" />
            </td>
        </tr>

    @empty

        <tr>
            <td class="rounded-b-md py-2 px-3 bg-light-gray-50" colspan="11">
                <x-button class="mx-auto text-secondary hover:underline" value="Tambah Toko Sendiri" data-no-content=""/>
            </td>
        </tr>
    
    @endforelse
        
    @else
    
    <x-skeletons.table-body rows="10" cols="11"/>

    @endunless

    </tbody>
</table>