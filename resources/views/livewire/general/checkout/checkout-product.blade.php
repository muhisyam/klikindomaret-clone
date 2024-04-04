<section class="rounded-lg p-6 bg-white">
    <table class="w-full" wire:init="loadContent">
        <thead>
            <tr>
    
                @php
                    //TODO: fix this 
                    $retailerIcon = 'store';
                @endphp
            
                <th colspan="5" class="border-b border-light-gray-100 rounded-t-md bg-light-gray-50">
                    <div class="py-2 px-4 flex items-center gap-2 text-sm">
                        <x-icon class="w-[18px]" src="{{ asset('img/icons/icon-send-by-store.webp') }}"/>
                        <span @class([
                            'font-bold',
                            'text-secondary' => $retailerIcon !== 'warehouse',
                            'text-[#00b110]' => $retailerIcon === 'warehouse',
                        ])>Toko Indomaret</span>
                        <span>({{ count($products) }} Item)</span>
                        {{ session('coba2') }}
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="relative" wire:loading wire:loading.class="!table-row" wire:target="updateQuantity">
                <td colspan="5" class="absolute top-0 left-0 z-10 h-[{{ count($products) * 96 }}px] w-full grid place-items-center bg-light-gray-200/50">
                    <span class="inline-flex loader-spin"></span>
                </td>
            </tr>
        @forelse ($products as $index => $product)
            
        @php
            $discountPercent = round((($product['normal_price'] - $product['discount_price']) / $product['normal_price']) * 100);
        @endphp
    
            <tr class="relative border-b border-light-gray-100 last:border-b-0">
                <td class="py-4 ps-4 w-1/12">
                    <img class="rounded" src="{{ asset('img/uploads/products/product-default-image.jpg') }}" alt="Product Image">
                </td>
                
                <td class="py-4 px-4 w-5/12 align-baseline">
                    <a href="{{ route('home.detail-product', ['product' => $product['product_slug']]) }}" class="mb-2 h-10 line-clamp-2 text-sm font-bold hover:text-secondary">{{ $product['product_name'] }}</a>
                    <div class="flex items-center gap-1 text-xs">
                        <span>Kategori:</span>
                        <a href="{{ $product['slug_category_lvl_1'] }}" class="hover:text-secondary">{{ $product['category_lvl_1'] }} /</a>
                        <a href="{{ $product['slug_category_lvl_2'] }}" class="hover:text-secondary">{{ $product['category_lvl_2'] }} /</a>
                        <a href="{{ $product['slug_category_lvl_3'] }}" class="hover:text-secondary">{{ $product['category_lvl_3'] }}</a>
                    </div>
                </td>
                
                <td class="py-4 w-2/12">
                @if ($product['discount_price'])
                    <div class="mb-2 flex items-center gap-2 text-xs">
                        <div class="rounded p-1.5 bg-primary-100 text-primary-600 text-center font-bold leading-none">{{ $discountPercent }}%</div>
                        <div class="text-light-gray-300 leading-none line-through">Rp {{ formatCurrencyIDR($product['normal_price']) }}</div>
                    </div>
                @endif
                    <div @class([
                        'line-clamp-1 text-sm leading-none', 
                        'text-black'       => ! $product['discount_price'],
                        'text-primary-600' => $product['discount_price'],
                    ])>
                        <span>Rp {{ formatCurrencyIDR($product['discount_price'] ?? $product['normal_price']) }}</span>
                    </div>
                </td>
                
                <td class="py-4 w-2/16 space-y-2">
                    {{-- <div class="flex items-center justify-center">
                        <x-button class="shrink-0 h-8 w-8 group hover:bg-secondary" buttonStyle="outline-secondary" wire:click="updateQuantity('sub', '{{ $product['product_slug'] }}')">
                            <x-icon class="mx-auto w-2.5" src="{{ asset('img/icons/icon-minus.webp') }}" iconStyle="hover-white"/>
                        </x-button>
                        
                        <x-input-field class="mx-1 !h-8 text-center" name="quantity[]" wire:model="quantity.{{ $product['product_slug'] }}"/>
                        
                        <x-button class="shrink-0 h-8 w-8 group hover:bg-secondary" buttonStyle="outline-secondary" wire:click="updateQuantity('add', '{{ $product['product_slug'] }}')">
                            <x-icon class="mx-auto w-2.5 rotate-45" src="{{ asset('img/icons/icon-header-close.webp') }}" iconStyle="hover-white"/>
                        </x-button>
                    </div> --}}
                    <div class="flex items-center justify-center">
                        <x-button class="shrink-0 h-8 w-8 group hover:bg-secondary" buttonStyle="outline-secondary" qty="sub">
                            <x-icon class="mx-auto w-2.5" src="{{ asset('img/icons/icon-minus.webp') }}" iconStyle="hover-white"/>
                        </x-button>
                        
                        <x-input-field class="mx-1 !h-8 text-center" name="quantity[]" wire:model="quantity.{{ $product['product_slug'] }}"/>
                        
                        <x-button class="shrink-0 h-8 w-8 group hover:bg-secondary" buttonStyle="outline-secondary" qty="add">
                            <x-icon class="mx-auto w-2.5 rotate-45" src="{{ asset('img/icons/icon-header-close.webp') }}" iconStyle="hover-white"/>
                        </x-button>
                    </div>
                    {{-- <div class="text-[#BF1F1F] text-[10px] text-center">Persediaan tidak mencukupi</div> --}}
                </td>
                
                <td class="py-4 pe-4 w-2/12 text-end text-sm">Rp {{ formatCurrencyIDR($subTotal[$index]) }}</td>
                
                <td class="absolute right-0 top-0">
                    <x-button class="rounded-bl-full ps-6 pe-4 h-7 bg-red-600 text-white">
                        <x-icon class="w-3" src="{{ asset('img/icons/icon-delete.webp') }}" iconStyle="white"/>
                    </x-button>
                </td>
            </tr>
        
        @empty
            <tr>
                <td>Loading...</td>
            </tr>
        @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="border-t border-light-gray-100 rounded-b-md bg-light-gray-50 text-sm font-bold">
                    <div class="py-2 flex justify-end">
                        <div class="w-5/6 text-end">Subtotal:</div>
                        <div class="pe-4 w-1/6 text-end">Rp {{ formatCurrencyIDR($grandTotal) }}</div>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</section>
    
@push('scripts')
    <script>
        // import { handleInputProductQty } from "{{ asset('js/' . config('view.js_component')) }}";

        document.addEventListener('livewire:initialized', () => {
            @this.on('content-loaded', event => {
                setTimeout(() => {
                    handleInputProductQty();
                }, 1);
            });
        });

        function handleInputProductQty() { 
            const btnHandlerQty = document.querySelectorAll('button[qty]');

            btnHandlerQty.forEach(btn => {
                btn.addEventListener('click', el => {
                    let inputQty, qtyValue;
                    const btnQty        = el.target.closest('button') ?? event.target;
                    const btnAttrMethod = btnQty.getAttribute('qty');

                    switch (btnAttrMethod) {
                        case 'sub':
                            inputQty       = btnQty.nextElementSibling;
                            qtyValue       = parseInt(inputQty.value);
                            inputQty.value = qtyValue > 1 ? qtyValue - 1 : qtyValue;
                            break;
                    
                        default:
                            inputQty       = btnQty.previousElementSibling;
                            qtyValue       = parseInt(inputQty.value);
                            inputQty.value = qtyValue + 1;
                            break;
                    }
                })
            })
        }
    </script>
@endpush