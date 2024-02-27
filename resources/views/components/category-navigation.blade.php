<section data-section="category-navigation">
    <ul class="text-sm shadow">
        <li class="inline-block w-36 py-3" data-target-category-content="retail">
            <x-nav-link href="/" class="justify-center gap-2">
                <x-icon class="w-5 brightness-95 grayscale-[90%]" src="{{ asset('img/icons/ic_retail.webp') }}"/>
                <span>Retail</span>
            </x-nav-link>
        </li>
        <li class="inline-block w-36 py-3" data-target-category-content="food">
            <x-nav-link href="https://food.klikindomaret.com/" class="justify-center gap-2">
                <x-icon class="w-5 brightness-95 grayscale-[90%]" src="{{ asset('img/icons/ic_food.webp') }}"/>
                <span>Food</span>
            </x-nav-link>
        </li>
        <li class="inline-block w-36 py-3" data-target-category-content="virtual">
            <x-nav-link href="https://virtual.klikindomaret.com/" class="justify-center gap-2">
                <x-icon class="w-5 brightness-95 grayscale-[90%]" src="{{ asset('img/icons/ic_virtual.webp') }}"/>
                <span>Virtual</span>
            </x-nav-link>
        </li>
        <li class="inline-block w-36 py-3" data-target-category-content="travel">
            <x-nav-link href="https://travel.klikindomaret.com/" class="justify-center gap-2">
                <x-icon class="w-5 brightness-95 grayscale-[90%]" src="{{ asset('img/icons/ic_travel.webp') }}"/>
                <span>Travel</span>
            </x-nav-link>
        </li>
        <li class="inline-block w-36 py-3" data-target-category-content="ticket">
            <x-nav-link href="https://tiket.klikindomaret.com/category/ticket" class="justify-center gap-2">
                <x-icon class="w-5 brightness-95 grayscale-[90%]" src="{{ asset('img/icons/ic_ticket_second.webp') }}"/>
                <span>Ticket</span>
            </x-nav-link>
        </li>
    </ul>
    <div class="min-h-[440px]">
        <div class="flex" data-category-content="retail">
            <ul class="w-[17.2%] shadow-left text-black text-sm">
                @foreach ($categories as $data)
                <li class="group p-3 active hover:bg-[#E1EEFF] hover:text-secondary" data-target-retail="{{ $data['category_slug'] }}" data-category-image="{{ asset('img/uploads/categories/' . $data['category_image_name']) }}" data-original-category-image="{{ $data['original_category_image_name'] }}">
                    <x-nav-link class="gap-2" href="{{ url('/category/' . $data['category_slug']) }}" data-category-name="{{ $data['category_name'] }}">
                        <x-icon class="w-5" src="{{ asset('img/uploads/categories/' . $data['category_image_name']) }}"/>
                        <span class="grow">{{ $data['category_name'] }}</span>
                        <x-icon class="w-3 brightness-50 grayscale group-hover:filter-none" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                    </x-nav-link>
                </li>
                @endforeach
            </ul>
            <div class="h-[440px] w-[82.8%] overflow-auto text-xs text-black">
                @foreach ($categories as $dataLevel1)
                <div class="relative pt-5 px-8{{ ! $loop->first ? ' hidden' : '' }}" data-trigger-retail="{{ $dataLevel1['category_slug'] }}">
                    <div class="flex items-center gap-2 mb-5">
                        <x-icon class="w-5" src="{{ asset('img/uploads/categories/' . $dataLevel1['category_image_name']) }}"/>
                        <span class="font-bold">{{ $dataLevel1['category_name'] }}</span>
                    </div>
                    <ul class="grid grid-cols-6 gap-4 leading-5">
                        @foreach ($dataLevel1['children'] as $dataLevel2)
                        <li>
                            <x-nav-link href="{{ url('/category/' . $dataLevel2['category_slug']) }}" class="font-bold" :value="$dataLevel2['category_name']"/>
                            <ul>
                                @foreach ($dataLevel2['children'] as $dataLevel3)
                                <li>
                                    <x-nav-link href="{{ url('/category/' . $dataLevel3['category_slug']) }}" :value="$dataLevel3['category_name']"/>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
        <div class="hidden" data-category-content="food">
            <h1>food</h1>
        </div>
        <div class="hidden" data-category-content="virtual">
            <h1>virtual</h1>
        </div>
        <div class="hidden" data-category-content="travel">
            <h1>travel</h1>
        </div>
        <div class="hidden" data-category-content="ticket">
            <h1>ticket</h1>
        </div>
    </div>
</section>