<section class="space-y-6 rounded-lg p-6 bg-white" wire:init="loadContent">

    @forelse ($products as $retailerName => $productByGroup)

    @php
        $retailerIcon      = $retailerName !== 'Toko Indomaret' ? $retailerName : 'Store';
        $totalEachRetailer = 0;
    @endphp

    <table class="w-full">
        <thead>
            <tr>
                <th colspan="5" class="border-b border-light-gray-100 rounded-t-md bg-light-gray-50">
                    <div class="py-2 px-4 flex items-center gap-2 text-sm">
                        <x-icon class="w-[18px]" src="{{ asset('img/icons/icon-send-by-' . strtolower($retailerIcon) . '.webp') }}"/>
                        <h2 @class([
                            'font-bold',
                            'text-secondary' => $retailerName === 'Toko Indomaret',
                            'text-[#00b110]' => $retailerName === 'Warehouse',
                        ])>{{ $retailerName }}</h2>
                        <span>({{ count($productByGroup) }} Item)</span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>

        @foreach ($productByGroup as $product)

        @php $retailerSlug = Str::slug($retailerName) @endphp
        
        @if ($loop->first)
            <tr>
                <td colspan="5" class="py-4 border-b border-light-gray-100">
                    <x-dropdown section="user-account-ewallet-{{ $retailerSlug }}">
                        <x-slot:trigger class="p-4 flex-col gap-2 w-full bg-light-gray-50">
                            <div class="flex items-center gap-2 w-full" data-delivery-type="">
                                <x-icon class="mr-auto w-40" src="{{ asset('img/checkout/choose-time.webp') }}"/>
                                <div>Rp {{ formatCurrencyIDR(5000) }}</div>
                                <x-icon class="w-4 duration-500" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-dropdown=""/>
                            </div>
                            <div class="w-full text-left text-sm" data-delivery-info="{{ $retailerSlug }}">Hari ini, 07 April 2024, 16:00-16:59</div>
                        </x-slot>
    
                        <x-slot:content class="overflow-hidden drop-shadow-md w-full bg-white before:hidden">
                            <x-button class="border-b border-light-gray-100 !rounded-none p-4 flex-col !items-baseline gap-2 w-full hover:bg-secondary-50">
                                <x-icon class="w-40" src="{{ asset('img/checkout/choose-reguler.webp') }}"/>
                                <div class="text-left text-sm">Tidak tersedia untuk pesanan dari penjual ini</div>
                            </x-button>

                            @php  $section = 'choose-time-' . $retailerSlug @endphp

                            <x-modal :section="$section" withOverlay="false">
                                <x-slot:trigger class="border-b border-light-gray-100 !rounded-none p-4 flex-col !items-baseline gap-2 w-full hover:bg-secondary-50">
                                    <x-icon class="w-40" src="{{ asset('img/checkout/choose-time.webp') }}"/>
                                    <div class="text-left text-sm">Pilih sendiri waktu yang kamu mau</div>
                                </x-slot>
            
                                <x-slot:content class="separated-modal">
                                @push('modal-date-delivery')
                                    @include('general.checkout.modal-date-delivery', [
                                        'section'      => $section,
                                        'retailerName' => $retailerName,
                                        'retailerSlug' => $retailerSlug,
                                    ])
                                @endpush
                                </x-slot>
                            </x-modal>

                            <x-button class="border-b border-light-gray-100 !rounded-none p-4 flex-col !items-baseline gap-2 w-full hover:bg-secondary-50">
                                <x-icon class="w-40" src="{{ asset('img/checkout/choose-sameday.webp') }}"/>
                                <div class="text-left text-sm">Tidak tersedia untuk pesanan dari penjual ini</div>
                            </x-button>

                            <x-button class="!rounded-none p-4 flex-col !items-baseline gap-2 w-full hover:bg-secondary-50">
                                <x-icon class="w-40" src="{{ asset('img/checkout/choose-express.webp') }}"/>
                                <div class="text-left text-sm">Pesanan dikirim maksimal 1 jam setelah pembayaran lunas</div>
                            </x-button>
                        </x-slot>
                    </x-dropdown>   
                </td>
            </tr>
        @endif

        @php
            $discountPercent    = round((($product['normal_price'] - $product['discount_price']) / $product['normal_price']) * 100);
            $totalEachProduct   = $product['quantity'] * ($product['discount_price'] ?? $product['normal_price']);
            $totalEachRetailer += $totalEachProduct;
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
                    <div class="flex items-center justify-center">
                        <x-button class="shrink-0 h-8 w-8 group hover:bg-secondary" buttonStyle="outline-secondary" qty="sub">
                            <x-icon class="mx-auto w-2.5" src="{{ asset('img/icons/icon-minus.webp') }}" iconStyle="hover-white"/>
                        </x-button>
                        
                        <x-input-field class="mx-1 !h-8 text-center" name="quantity[]" wire:model="quantity.{{ $retailerName . '.' . $product['product_slug'] }}"/>
                        
                        <x-button class="shrink-0 h-8 w-8 group hover:bg-secondary" buttonStyle="outline-secondary" qty="add">
                            <x-icon class="mx-auto w-2.5 rotate-45" src="{{ asset('img/icons/icon-header-close.webp') }}" iconStyle="hover-white"/>
                        </x-button>
                    </div>
                    {{-- <div class="text-[#BF1F1F] text-[10px] text-center">Persediaan tidak mencukupi</div> --}}
                </td>
                
                <td class="py-4 pe-4 w-2/12 text-end text-sm">Rp {{ formatCurrencyIDR($totalEachProduct) }}</td>
                
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
                        <div class="pe-4 w-1/6 text-end">Rp {{ formatCurrencyIDR($totalEachRetailer) }}</div>
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
            @this.on('content-loaded', event => {
                setTimeout(() => {
                    handleInputProductQty();
                    toggleDropdown();
                    toggleModal();
                    switchDateDelivery();
                    updateDateDeliveryInfo();
                    pickDateDelivery();
                }, 1);
            });
        });

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
                    const dataDate     = btnDate.getAttribute('data-delivery-date');
                    const dataTime     = btnDate.getAttribute('data-delivery-time');
                    const dataRetailer = btnDate.closest('[data-retailer]').getAttribute('data-retailer');
                    const dateDelivery = document.querySelector(`input[name*="date-delivery-picker"][data-retailer="${dataRetailer}"]`);
                    const timeDelivery = document.querySelector(`input[name*="time-delivery-picker"][data-retailer="${dataRetailer}"]`);

                    // Reset button style TODO: fix this
                    listBtnDatePicker.forEach(btnDate => {
                        const isBtnHasRightRetailer = btnDate.closest('[data-retailer]').matches(`[data-retailer="${dataRetailer}"]`);

                        if (isBtnHasRightRetailer) {
                            btnDate.classList.add('bg-white', 'text-secondary');
                            btnDate.classList.remove('bg-secondary', 'text-white');
                            btnDate.innerHTML  = 'Pilih jam ini';
                        }
                    })

                    dateDelivery.value = dataDate;
                    timeDelivery.value = dataTime;
                    btnDate.innerHTML  = 'Terpilih';

                    btnDate.classList.add('bg-secondary', 'text-white');
                    btnDate.classList.remove('bg-white', 'text-secondary');

                    updateDateDeliveryInfo();
                })
            })
        }

        function updateDateDeliveryInfo() {
            const dateDeliveryList = document.querySelectorAll('input[name*="date-delivery-picker"]');
            const timeDeliveryList = document.querySelectorAll('input[name*="time-delivery-picker"]');

            dateDeliveryList.forEach((dateDelivery, index) => {
                const dateValue     = dateDelivery.value;
                const timeValue     = timeDeliveryList[index].value;
                const dateJS        = new Date();
                const currentDay    = dateJS.getDate();
                const deliveryDay   = dateValue.split(" ")[0];
                const dayDifference = deliveryDay - currentDay;
                const dataRetailer  = dateDelivery.getAttribute('data-retailer');
                const deliveryInfo  = document.querySelector(`[data-delivery-info="${dataRetailer}"]`);
                let willBeDelivered = '';
                
                if (dayDifference >= '2') {
                    const weekday = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at",'Sabtu'];
                    
                    willBeDelivered = weekday[dateJS.getDay() + dayDifference];
                
                } else if (dayDifference == '1') {
                    willBeDelivered = 'Besok';
                
                } else {
                    willBeDelivered = 'Hari ini';

                }

                deliveryInfo.innerHTML = `${willBeDelivered}, ${dateValue}, ${timeValue}`;
            })
        }
    </script>
@endpush