<section class="space-y-6 rounded-lg p-6 bg-white" wire:init="loadContent">

    @forelse ($carts as $retailerName => $productByGroup)

    @php
        $retailerSlug          = Str::slug($retailerName);
        $activeDeliveryOption  = $pickedDelivery[$retailerName]['option'];
        $activeDeliveryPrice   = $pickedDelivery[$retailerName]['price'];
        $activeDeliveryMessage = $pickedDelivery[$retailerName]['message'];
        $filterGroup           = Arr::except($productByGroup, ['retailer_icon', 'total_price_each_retailer', 'product_count', 'delivery_options']);
    @endphp

    <table class="w-full">
        <thead>
            <tr>
                <th colspan="5" class="border-b-2 border-light-gray-100 rounded-t-md bg-light-gray-50">
                    <div class="py-2 px-4 flex items-center gap-2 text-sm">
                        <x-icon class="w-[18px]" src="{{ asset('img/icons/icon-send-by-' . strtolower($productByGroup['retailer_icon']) . '.webp') }}"/>
                        <h2 @class([
                            'font-bold',
                            'text-secondary' => $retailerName === 'Toko Indomaret',
                            'text-[#00b110]' => $retailerName === 'Warehouse',
                        ])>{{ $retailerName }}</h2>
                        <span>({{ $productByGroup['product_count'] }} Item)</span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>

        @foreach ($filterGroup as $product)

        @if ($loop->first)

            <tr>
                <td colspan="5" class="p-0 border-b border-light-gray-100">
                    <x-dropdown section="user-account-ewallet-{{ $retailerSlug }}">
                        <x-slot:trigger class="!rounded-none p-4 flex-col gap-2 w-full bg-light-gray-50">
                            <div class="flex items-center gap-2 w-full" data-delivery-type="">
                                <x-icon class="mr-auto w-40" src="{{ asset('img/checkout/choose-'. $activeDeliveryOption .'.webp') }}"/>
                                <div class="text-sm">{{ $activeDeliveryPrice ? 'Rp ' . formatCurrencyIDR($activeDeliveryPrice) : 'GRATIS' }}</div>
                                <x-icon class="w-3 duration-500" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-dropdown=""/>
                            </div>
                            <div class="w-full text-left text-sm" data-delivery-info="{{ $retailerSlug }}">{{ $activeDeliveryMessage }}</div>
                        </x-slot>

                        <x-slot:content class="overflow-hidden w-full bg-white before:hidden">

                            @php $deliveryType = $productByGroup['delivery_options']['regular'] @endphp 

                            <x-button   class="border-b border-light-gray-100 !rounded-none p-4 flex-col !items-baseline gap-2 w-full hover:bg-secondary-50" 
                                        wire:click="setDeliveryOpt(
                                            '{{ $retailerName }}',
                                            'regular',
                                            '{{ $deliveryType['price'] }}',
                                            '{{ $deliveryType['message'] }}',
                                        )"
                            >
                                <x-icon class="w-40" src="{{ asset('img/checkout/choose-regular.webp') }}"/>
                                <div class="text-left text-sm">{{ $productByGroup['delivery_options']['regular']['message'] }}</div>
                            </x-button>

                            @php  $section = 'choose-time-' . $retailerSlug @endphp

                            <x-modal :section="$section" withOverlay="false">
                                <x-slot:trigger class="border-b border-light-gray-100 !rounded-none p-4 flex-col !items-baseline gap-2 w-full hover:bg-secondary-50">
                                    <x-icon class="w-40" src="{{ asset('img/checkout/choose-time.webp') }}"/>
                                    <div class="text-left text-sm"> {{ $productByGroup['delivery_options']['time']['message'] }}</div>
                                </x-slot>
            
                                <x-slot:content class="separated-modal">
                                @push('modal-date-delivery')
                                    @include('general.checkout.modal-date-delivery', [
                                        'section'       => $section,
                                        'retailerName'  => $retailerName,
                                        'retailerSlug'  => $retailerSlug,
                                        'deliveryPrice' => $productByGroup['delivery_options']['time']['price'],
                                    ])
                                @endpush
                                </x-slot>
                            </x-modal>

                            @php $deliveryType = $productByGroup['delivery_options']['sameday'] @endphp 

                            <x-button   class="border-b border-light-gray-100 !rounded-none p-4 flex-col !items-baseline gap-2 w-full hover:bg-secondary-50" 
                                        wire:click="setDeliveryOpt(
                                            '{{ $retailerName }}',
                                            'sameday',
                                            '{{ $deliveryType['price'] }}',
                                            '{{ $deliveryType['message'] }}',
                                        )"
                            >
                                <x-icon class="w-40" src="{{ asset('img/checkout/choose-sameday.webp') }}"/>
                                <div class="text-left text-sm">{{ $productByGroup['delivery_options']['sameday']['message'] }}</div>
                            </x-button>

                            @php
                                $wireClick       = '';
                                $deliveryMessage = 'Tidak tersedia untuk pesanan dari penjual ini';
                                $disabledClass    = ' bg-light-gray-50 opacity-50 hover:!opacity-50';

                                if (array_key_exists('express', $productByGroup['delivery_options'])) {
                                    $deliveryOpt     = $productByGroup['delivery_options']['express'];
                                    $deliveryMessage = $deliveryOpt['message'];
                                    $disabledClass   = ' hover:bg-secondary-50';
                                    $wireClick       = 'setDeliveryOpt(
                                                            "'.$retailerName.'", 
                                                            "express",
                                                            "'.$deliveryOpt['price'].'",
                                                            "'.$deliveryMessage.'",
                                                        )';
                                }
                            @endphp

                            <x-button class="!rounded-none p-4 flex-col !items-baseline gap-2 w-full{{ $disabledClass }}" wire:click="{{ $wireClick }}">
                                <x-icon class="w-40" src="{{ asset('img/checkout/choose-express.webp') }}"/>
                                <div class="text-left text-sm">{{ $deliveryMessage }}</div>
                            </x-button>
                        </x-slot>
                    </x-dropdown>
                </td>
            </tr>

        @endif

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
                        <div class="rounded p-1.5 bg-primary-100 text-primary-600 text-center font-bold leading-none">{{ $product['discount_percent'] }}%</div>
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
                    <div class="flex items-center justify-center">
                        <x-button class="shrink-0 h-8 w-8 group hover:bg-secondary" buttonStyle="outline-secondary" qty="sub">
                            <x-icon class="mx-auto w-2.5" src="{{ asset('img/icons/icon-minus.webp') }}" iconStyle="hover-white"/>
                        </x-button>
                        
                        <x-input-field class="mx-1 !h-8 text-center" name="quantity[]" wire:model="quantities.{{ $retailerName . '.' . $product['product_slug'] }}"/>
                        
                        <x-button class="shrink-0 h-8 w-8 group hover:bg-secondary" buttonStyle="outline-secondary" qty="add">
                            <x-icon class="mx-auto w-2.5 rotate-45" src="{{ asset('img/icons/icon-header-close.webp') }}" iconStyle="hover-white"/>
                        </x-button>
                    </div>
                    {{-- <div class="text-[#BF1F1F] text-[10px] text-center">Persediaan tidak mencukupi</div> --}}
                </td>
                
                <td class="py-4 pe-4 w-2/12 text-end text-sm">Rp {{ formatCurrencyIDR($product['total_price']) }}</td>
                
                <td class="absolute right-0 top-0 p-0">
                    <x-button class="rounded-bl-full ps-6 pe-4 h-7 bg-red-600 text-white">
                        <x-icon class="w-3" src="{{ asset('img/icons/icon-delete.webp') }}" iconStyle="white"/>
                    </x-button>
                </td>
            </tr>
        
        @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="border-t border-light-gray-100 rounded-b-md bg-light-gray-50 text-sm font-bold">
                    <div class="py-2 flex justify-end">
                        <div class="w-5/6 text-end">Subtotal:</div>
                        <div class="pe-4 w-1/6 text-end">Rp {{ formatCurrencyIDR($productByGroup['total_price_each_retailer']) }}</div>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>

    @empty

    <div>Belum ada product dikeranjang</div>

    @endforelse

    <div id="components-container-checkout" class="!m-0">
        @stack('modal-date-delivery')
        <div separate-modal-overlay=""></div>
    </div>

</section>
    
@push('scripts')
    <script type="module">
        import { handleInputProductQty, toggleDropdown, toggleModal } from "{{ asset('js/' . config('view.js_component')) }}";

        document.addEventListener('livewire:initialized', () => {
            @this.on('run-js-content-loaded', event => {
                setTimeout(() => {
                    handleInputProductQty();
                    toggleDropdown();
                    toggleModal();
                    switchDateDelivery();
                    pickDateDelivery();
                    detectChangesInProductQty();
                }, 1)
            })
        })

        function switchDateDelivery() { 
            const btnSwitchDateList = document.querySelectorAll('button[data-section-target]');
            
            btnSwitchDateList.forEach(btnSwitch => {
                btnSwitch.addEventListener('click', () => {
                    const targetIndetity = btnSwitch.getAttribute('data-section-target');
                    const targetRetailer = btnSwitch.getAttribute('data-retailer');
                    const targetEl       = document.querySelector(`section[data-retailer="${targetRetailer}"][data-section="${targetIndetity}"]`);
                    const isTargetHidden = targetEl.classList.contains('hidden');

                    hideOpenedDateSection(targetRetailer);

                    if (isTargetHidden) {
                        btnSwitch.classList.add('bg-secondary', 'text-white');
                        btnSwitch.classList.remove('bg-white', 'text-secondary');

                        targetEl.classList.add('grid');
                        targetEl.classList.remove('hidden');
                    }
                })
            })
        }

        function hideOpenedDateSection(retailerName) {
            const btnSwitchDateList    = document.querySelectorAll(`button[data-retailer="${retailerName}"]`);
            const sectionModalDateList = document.querySelectorAll(`section[data-retailer="${retailerName}"]`);

            btnSwitchDateList.forEach(btnSwitch => {
                btnSwitch.classList.add('border', 'border-secondary', 'bg-white', 'text-secondary');
                btnSwitch.classList.remove('bg-secondary', 'text-white');
            })

            sectionModalDateList.forEach(sectionSwitch => {
                sectionSwitch.classList.add('hidden');
                sectionSwitch.classList.remove('grid');
            })
        }

        function pickDateDelivery() {
            const listBtnDatePicker = document.querySelectorAll('button[data-delivery-date]');

            listBtnDatePicker.forEach(btnDate => {
                btnDate.addEventListener('click', () => {
                    const dataDate          = btnDate.getAttribute('data-delivery-date');
                    const dataTime          = btnDate.getAttribute('data-delivery-time');
                    const dataRetailer      = btnDate.closest('[data-retailer]').getAttribute('data-retailer');
                    const dataDeliveryPrice = btnDate.closest('[data-delivery-price]').getAttribute('data-delivery-price');

                    /**
                     * Reset the buttons style
                    */
                    listBtnDatePicker.forEach(btnDate => {
                        const isBtnHasRightRetailer = btnDate.closest('[data-retailer]').matches(`[data-retailer="${dataRetailer}"]`);

                        if (isBtnHasRightRetailer) {
                            btnDate.classList.add('bg-white', 'text-secondary');
                            btnDate.classList.remove('bg-secondary', 'text-white');
                            btnDate.innerHTML  = 'Pilih jam ini';
                        }
                    })

                    btnDate.classList.add('bg-secondary', 'text-white');
                    btnDate.classList.remove('bg-white', 'text-secondary');
                    btnDate.innerHTML = 'Terpilih';

                    Livewire.dispatch('set-picked-delivery-opt', { 
                        retailerName:    makeTitle(dataRetailer),
                        deliveryOption: 'time',
                        shippingCost:   dataDeliveryPrice,
                        message:        `${dataDate}|${dataTime}`,
                    })
                })
            })
        }

        function makeTitle(slug) {
            const words = slug.split('-');

            for (let i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
            }

            return words.join(' ');
        }

        function detectChangesInProductQty() {
            const qtyInputList      = document.querySelectorAll('input[name*="quantity"]');
            const btnCheckoutList   = document.querySelectorAll('button[btn-checkout]');
            const btnCheckoutPay    = btnCheckoutList[0];
            const btnCheckoutUpdate = btnCheckoutList[1];
            
            qtyInputList.forEach((qtyInput, index) => {
                // Save original value
                qtyInput.dataset.originalValue = qtyInput.value;

                qtyInput.addEventListener('change', function() {
                    const isHasQtyChanges = [...qtyInputList].some(e => e.value !== e.dataset.originalValue);

                    if (isHasQtyChanges) {
                        const dataValue = [...qtyInputList].map(e => e.value);
                        
                        btnCheckoutPay.classList.add('hidden');
                        btnCheckoutUpdate.classList.remove('hidden');

                        return btnCheckoutUpdate.setAttribute('wire:click', `updateCart(${JSON.stringify(dataValue)})`);
                    }

                    btnCheckoutPay.classList.remove('hidden');
                    btnCheckoutUpdate.classList.add('hidden');

                    btnCheckoutUpdate.removeAttribute('wire:click');
                })
            })
        }
    </script>

    <script type="text/javascript" src="{{ config('midtrans.url') . 'snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script type="text/javascript">
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('success-get-token', event => {
                window.snap.pay(event.token.snap_token, {
                    onSuccess: function(result) {
                        /**
                         * Call event when user successfully finish the payment.
                         * Call in Checkout Product Class
                        */
                        Livewire.dispatch('payment-success', {
                            resultCallback: {
                                orderId:     result.order_id,
                                paymentType: result.payment_type,
                            },
                        })
                    },
                    onPending: function(result) {
                        /**
                         * If user close the payment modal without completing the payment,
                         * the order in midtrans dashboard will be automaticly cancelled.
                         * Call in Checkout Summary Class
                        */
                        Livewire.dispatch('payment-pending', {
                            orderId: result.order_id,
                        })
                    },
                })
            })
        })
    </script>
@endpush