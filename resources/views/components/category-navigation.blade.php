<section data-section="category-navigation">
    <ul class="text-sm shadow">
        <li class="inline-block w-36 py-3 active" data-target-category-content="retail">
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
        <div class="relative" data-category-content="retail">
            <ul class="left-side w-[17.2%] inline-block shadow-left text-black text-sm">
                @foreach ($categoryParent as $data)
                    <li class="item-sub-level-1 group p-3 active hover:bg-[#E1EEFF] hover:text-secondary" data-category-name="{{ $data['category_name'] }}" data-category-image="{{ asset('img/uploads/categories/' . $data['category_image_name']) }}" data-original-category-image="{{ $data['original_category_image_name'] }}">
                        <x-nav-link class="gap-2" href="{{ url('/category/' . $data['category_slug']) }}" data-category-name="{{ $data['category_name'] }}">
                            <x-icon class="w-5" src="{{ asset('img/uploads/categories/' . $data['category_image_name']) }}"/>
                            <span class="grow">{{ $data['category_name'] }}</span>
                            <x-icon class="w-3 brightness-50 grayscale group-hover:filter-none" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-nav-link>
                    </li>
                @endforeach
            </ul>
            {{-- <div class="right-side w-[82.5%] h-[425px] overflow-auto inline-block text-xs text-[#414141] px-8 pt-5">
                <div class="subcategory-header mb-5">
                    <div class="header-wrapper flex items-center">
                        <img class="max-h-[18px] max-w-[18px] me-2" src="https://assets.klikindomaret.com///products/banner/15-Icon-Makanan-R1.png" alt="Category Icon">
                        <span class="font-bold">Makanan</span>
                    </div>
                </div>
                <ul class="subcategory-level-2 subcategory-[idlevel1] grid grid-cols-6 gap-4 leading-5 hidden">
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Sarapan">Sarapan</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Sereal">Sereal</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Madu">Madu</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Selai & Olesan">Selai & Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Makanan Diet">Makanan Diet</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Roti">Roti</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Sarapan">Sarapan</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Sereal">Sereal</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Madu">Madu</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Selai & Olesan">Selai & Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Makanan Diet">Makanan Diet</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Roti">Roti</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Sarapan">Sarapan</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Sereal">Sereal</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Madu">Madu</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Selai & Olesan">Selai & Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Makanan Diet">Makanan Diet</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Roti">Roti</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Cemilan & Biskuit">Cemilan & Biskuit</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Biskuit">Biskuit</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Kacang Kacangan">Kacang Kacangan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Kue Kering">Kue Kering</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Cemilan Lokal">Cemilan Lokal</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Wafer">Wafer</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Keripik">Keripik</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Sarapan">Sarapan</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Sereal">Sereal</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Madu">Madu</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Selai & Olesan">Selai & Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Makanan Diet">Makanan Diet</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Roti">Roti</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Sarapan">Sarapan</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Sereal">Sereal</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Madu">Madu</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Selai & Olesan">Selai & Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Makanan Diet">Makanan Diet</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Roti">Roti</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Bahan Kue">Bahan Kue</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Gula & Tepung">Gula & Tepung</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Mentega & Margarin">Mentega & Margarin</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Tepung Instan">Tepung Instan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Bahan Puding & Agar Agar">Bahan Puding & Agar Agar</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Cokelat Masak & Cokelat Bubuk">Cokelat Masak & Cokelat Bubuk</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Susu Cair & Kental Manis">Susu Cair & Kental Manis</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Keju">Keju</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Olesan">Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Pengemulsi">Pengemulsi</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Perisa">Perisa</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Topping & Hiasan Kue">Topping & Hiasan Kue</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Lainnya">Lainnya</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Sarapan">Sarapan</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Sereal">Sereal</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Madu">Madu</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Selai & Olesan">Selai & Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Makanan Diet">Makanan Diet</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Roti">Roti</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Sarapan">Sarapan</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Sereal">Sereal</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Madu">Madu</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Selai & Olesan">Selai & Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Makanan Diet">Makanan Diet</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Roti">Roti</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="subcategory-level-2 subcategory-[idlevel2] grid grid-cols-6 gap-4 leading-5 hidden">
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Sarapan">Sarapan</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Sereal">Sereal</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Madu">Madu</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Selai & Olesan">Selai & Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Makanan Diet">Makanan Diet</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Roti">Roti</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Sarapan">Sarapan</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Sereal">Sereal</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Madu">Madu</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Selai & Olesan">Selai & Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Makanan Diet">Makanan Diet</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Roti">Roti</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="subcategory-level-2 subcategory-[idlevel3] grid grid-cols-6 gap-4 leading-5 hidden">
                    <li class="item-sub-level-2">
                        <a class="font-bold" href="https://www.klikindomaret.com/category/sarapan" data-sub-name="Bahan Kue">Bahan Kue</a>
                        <ul class="subcategory-level-3">
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Gula & Tepung">Gula & Tepung</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Mentega & Margarin">Mentega & Margarin</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Tepung Instan">Tepung Instan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Bahan Puding & Agar Agar">Bahan Puding & Agar Agar</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Cokelat Masak & Cokelat Bubuk">Cokelat Masak & Cokelat Bubuk</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Susu Cair & Kental Manis">Susu Cair & Kental Manis</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Keju">Keju</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Olesan">Olesan</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Pengemulsi">Pengemulsi</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Perisa">Perisa</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Topping & Hiasan Kue">Topping & Hiasan Kue</a>
                            </li>
                            <li class="item-sub-level-3">
                                <a href="#" data-sub-name="Lainnya">Lainnya</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div> --}}
        </div>
    </div>
</section>