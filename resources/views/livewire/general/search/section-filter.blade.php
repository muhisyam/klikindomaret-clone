<div class="space-y-4 rounded-lg py-5 px-6 w-1/5 bg-white">
    <section data-section="filter-category">
        <x-button class="w-full justify-between font-bold" data-accordion-target="filter-category">
            <h3>Kategori</h3>
            <x-icon class="w-4 duration-500" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}"/>
        </x-button>
        <div class="accordion duration-500 ease-out hide border-b border-light-gray-100 pb-2" data-accordion-trigger="filter-category">
            <ul class="mt-2 space-y-1 overflow-auto max-h-[300px]">

            @foreach ($listCategories as $category)

                <li class="flex items-baseline gap-1.5 text-sm">
                    <input type="checkbox" id="filter-category-{{ $category['category_slug'] }}" class="align-middle" value="{{ $category['category_slug'] }}" wire:model="filterCategories">
                    <label for="filter-category-{{ $category['category_slug'] }}" class="block">{{ $category['category_name'] }}</label>
                </li>

            @endforeach
            
            </ul>
        </div>
    </section>

    <section data-section="filter-brand">
        <x-button class="w-full justify-between font-bold" data-accordion-target="filter-brand">
            <h3>Brand</h3>
            <x-icon class="w-4 duration-500" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}"/>
        </x-button>
        <div class="accordion duration-500 ease-out hide border-b border-light-gray-100 pb-2" data-accordion-trigger="filter-brand">
            <ul class="mt-2 space-y-1 overflow-auto max-h-[300px]">

            @foreach ($listBrand as $brand)

                <li class="text-sm">
                    <input type="radio" id="filter-brand-{{ $brand['brand_slug'] }}" class="align-middle" value="{{ $brand['brand_slug'] }}" wire:model="filterBrand">
                    <label for="filter-brand-{{ $brand['brand_slug'] }}" class="ml-1.5">{{ $brand['brand_name'] }}</label>
                </li>

            @endforeach
            
            </ul>
        </div>
    </section>

    <section data-section="filter-supplier">
        <x-button class="w-full justify-between font-bold" data-accordion-target="filter-supplier">
            <h3>Penyedia</h3>
            <x-icon class="w-4 duration-500" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}"/>
        </x-button>
        <div class="accordion duration-500 ease-out hide border-b border-light-gray-100 pb-2" data-accordion-trigger="filter-supplier">
            <ul class="mt-2 space-y-1 overflow-auto max-h-[300px]">

            @foreach ($listSupplier as $supplier)
        
                <li class="text-sm">
                    <input type="checkbox" id="filter-supplier-{{ $supplier['flag_name'] }}" class="align-middle" value="{{ $supplier['flag_name'] }}" wire:model="filterSupplier">
                    <label for="filter-supplier-{{ $supplier['flag_name'] }}" class="ml-1.5">{{ $supplier['supplier_name'] }}</label>
                </li>

            @endforeach

            </ul>
        </div>
    </section>

    <section data-section="filter-price">
        <h3 class="mb-4 font-bold">Harga</h3>
        <div class="border-b border-light-gray-100 pb-4 flex flex-col gap-2">
            <div class="relative">
                <x-input-label for="filter-min-price" class="absolute top-1/2 -translate-y-1/2 px-3 font-bold" value="Rp"/>
                <x-input-field id="filter-min-price" class="pl-9" type="number" name="category_name" placeholder="min" wire:model="filterMinPrice"/>
            </div>
            <div class="relative">
                <x-input-label for="filter-max-price" class="absolute top-1/2 -translate-y-1/2 px-3 font-bold" value="Rp"/>
                <x-input-field id="filter-max-price" class="pl-9" type="number" name="category_name" placeholder="max" wire:model="filterMaxPrice"/>
            </div>
        </div>
    </section>

    <x-button class="py-2 px-4 w-full justify-center" buttonStyle="secondary" value="Terapkan" wire:click="applyFilter"/>
    <button class="mx-auto block text-secondary text-sm hover:underline" wire:click="resetFilter">Reset</button>
</div>
