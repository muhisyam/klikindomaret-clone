<form action="{{ $formRoute }}" method="POST" enctype="multipart/form-data" wire:init="loadContent">
    @csrf

    <div wire:ignore>
        @if (isRouteContains('edit')) @method('PUT') @endif
    </div>

    <section class="flex gap-4 mb-5" data-section="product-input-wrapper">
        <div class="relative rounded-xl p-4 border border-light-gray-100 h-full w-2/5" data-element="input-image-wrapper">
            <div class="mb-4">
                <x-input-label for="form-input-image" class="required-label" value="Tambah Gambar"/>
                <x-input-field id="form-input-image" class="hidden" name="product_images[]" type="file" accept=".jpg, .jpeg, .png, .webp" multiple/>
                <x-input-image-fancy/>
            </div>
            <div class="overflow-auto flex flex-col gap-4" data-element="image-info-wrapper">
                <x-input-error field="product_images" :error="$error" validation="multiple-image"/>
                <x-input-error field="delete_product_images" :error="$error" validation="delete-image"/>
                
                <div class="space-y-4" data-element="image-uploaded-wrapper">

                @forelse ($product_images as $productImage)

                    <div class="rounded-md p-2 border border-light-gray-100 flex items-center justify-between">
                        <div class="w-11/12 flex items-center gap-2">
                            <img class="rounded-md h-12 shrink-0"  src="{{ asset('img/uploads/products/' . $productImage['product_image_path'] . $productImage['product_image_name']) }}" alt="Product Image">
                            <div>
                                <div class="font-bold line-clamp-1 text-ellipsis">{{ $productImage['original_product_image_name'] }}</div>
                                <div class="text-xs font-light">{{ $productImage['product_image_size'] }}</div>
                            </div>
                        </div>
                        <x-button class="px-1.5 h-8 hover:bg-tertiary hover:text-secondary" data-button-image="remove" data-image-name="{{ $productImage['product_image_name'] }}" data-original-image-name="{{ $productImage['original_product_image_name'] }}">
                            <x-icon class="h-4" src="{{ asset('img/icons/icon-delete.webp') }}"/>
                        </x-button>
                    </div>

                @empty
                    
                    <div class="rounded-md p-2 border border-light-gray-100 flex items-center justify-between">
                        <div class="w-11/12 flex items-center gap-2.5">
                            <div class="rounded h-12 w-12 grid place-content-center bg-tertiary ">
                                <x-icon class="h-[22px] jump" src="{{ asset('img/icons/icon-upload.webp') }}"/>
                            </div>
                            <div class="font-bold line-clamp-1 text-ellipsis">Tidak ada gambar.</div>
                        </div>
                    </div>

                @endforelse
                
                </div>
            </div>
        </div>

        <div class="p-4 rounded-xl border border-light-gray-100 w-3/5">
            <div class="h-full overflow-auto" data-element="input-info-wrapper">
                <x-loader wire:loading.class.remove="hidden" wire:target="loadContent"/>

                <section switch-form-trigger="product-informations"
                        @class([
                            'space-y-4', 
                            'hidden' => $activeSwitch != 'product-informations'
                        ])>
                    <div>
                        <x-input-label for="form-select-category" class="required-label" value="Kategori"/>
                        <x-input-select id="form-select-category" name="category_id" :error="$error" wire:model.change="category_id">

                        @unless (empty($form_select_category))
                            <option value="{{ $form_select_category['id'] }}">{{ $form_select_category['category_name'] }}</option>
                        @endunless

                        </x-input-select>
                        <x-input-error field="category_id" :error="$error"/>
                    </div>
                    <div>
                        <x-input-label for="form-select-brand" class="required-label" value="Brand"/>
                        <x-input-select id="form-select-brand" name="brand_id" :error="$error" wire:model.change="brand_id">

                        @unless (empty($form_select_brand))
                            <option value="{{ $form_select_brand['id'] }}">{{ $form_select_brand['brand_name'] }}</option>
                        @endunless

                        </x-input-select>
                        <x-input-error field="brand_id" :error="$error"/>
                    </div>
                    <div>
                        <x-input-label for="form-select-supplier" class="required-label" value="Supplier"/>
                        <x-input-select id="form-select-supplier" name="supplier_id" :error="$error" wire:model.change="supplier_id">

                        @unless (empty($form_select_supplier))
                            <option value="{{ $form_select_supplier['id'] }}">{{ $form_select_supplier['supplier_name'] }}</option>
                        @endunless

                        </x-input-select>
                        <x-input-error field="supplier_id" :error="$error"/>
                    </div>
                {{-- @if (isSuperRole())
                    <div>
                        <x-input-label for="form-select-retailer" class="required-label" value="Hapus Retailer"/>
                        <x-input-select id="form-select-retailer" name="delete_retailer[]" :error="$error" wire:model.change="delete_retailer" multiple>

                        @foreach ($form_select_retailers as $retailerOption)
                            <option value="{{ $retailerOption['id'] }}">{{ $retailerOption['retailer_name'] }}</option>
                        @endforeach

                        </x-input-select>
                        <x-input-error field="delete_retailer" :error="$error"/>
                    </div>
                    
                    <div>
                        <x-input-label for="form-select-retailer" class="required-label" value="Retailer"/>
                        <x-input-select id="form-select-retailer" name="retailers_id[]" :error="$error" wire:model.change="retailers_id" multiple>

                        @foreach ($form_select_retailers as $retailerOption)
                            <option value="{{ $retailerOption['id'] }}">{{ $retailerOption['retailer_name'] }}</option>
                        @endforeach

                        </x-input-select>
                        <x-input-error field="retailers_id" :error="$error"/>
                    </div>
                @else --}}
                    <div>
                        <x-input-label for="form-select-retailer" class="required-label" value="Retailer"/>
                        <x-input-select id="form-select-retailer" name="retailers_id[]" :error="$error" wire:model.change="retailers_id" multiple>

                        @foreach ($form_select_retailers as $retailerOption)
                            <option value="{{ $retailerOption['id'] }}">{{ $retailerOption['retailer_name'] }}</option>
                        @endforeach

                        </x-input-select>
                        <x-input-error field="retailers_id" :error="$error"/>
                    </div>
                {{-- @endif --}}
                    
                </section>

                <section switch-form-trigger="product-details"
                        @class([
                            'space-y-4', 
                            'hidden' => $activeSwitch != 'product-details'
                        ])>
                    <div>
                        <x-input-label for="form-input-plu" class="required-label" value="PLU"/>
                        <x-input-field id="form-input-plu" name="plu" :error="$error" wire:model.blur="plu"/>
                        <x-input-error field="plu" :error="$error"/>
                    </div>
                    <div>
                        <x-input-label for="form-input-product-name" class="required-label" value="Nama Produk"/>
                        <x-input-field id="form-input-product-name" name="product_name" :error="$error" wire:model.blur="product_name"/>
                        <x-input-error field="product_name" :error="$error"/>
                    </div>
                    <div>
                        <x-input-label for="form-input-product-slug" class="required-label" value="Slug Produk"/>
                        <x-input-field id="form-input-product-slug" name="product_slug" :error="$error" wire:model="product_slug"/>
                        <x-input-error field="product_slug" :error="$error"/>
                    </div>
                    <div>
                        <x-input-label for="form-input-normal-price" class="required-label" value="Harga Produk"/>
                        <x-input-field id="form-input-normal-price" type="number" name="normal_price" :error="$error" wire:model="normal_price"/>
                        <x-input-error field="normal_price" :error="$error"/>
                    </div>
                    <div>
                        <x-input-label for="form-input-discount-price" value="Harga Diskon"/>
                        <x-input-field id="form-input-discount-price" type="number" name="discount_price" :error="$error" wire:model="discount_price"/>
                        <x-input-error field="discount_price" :error="$error"/>
                    </div>
                    <div>
                        <x-input-label for="form-input-discount-start-date" value="Tanggal Mulai"/>
                        <x-input-field id="form-input-discount-start-date" type="date" name="discount_start_date" :error="$error" wire:model="discount_start_date"/>
                        <x-input-error field="discount_start_date" :error="$error"/>
                    </div>
                    <div>
                        <x-input-label for="form-input-discount-end-date" value="Tanggal Selesai"/>
                        <x-input-field id="form-input-discount-end-date" type="date" name="discount_end_date" :error="$error" wire:model="discount_end_date"/>
                        <x-input-error field="discount_end_date" :error="$error"/>
                    </div>
                    <div>
                        <x-input-label for="form-input-product-stock" class="required-label" value="Stok Produk"/>
                        <x-input-field id="form-input-product-stock" name="product_stock" :error="$error" wire:model="product_stock"/>
                        <x-input-error field="product_stock" :error="$error"/>
                    </div>
                    <div>
                        <x-input-label for="form-select-product-status" class="required-label" value="Status"/>
                        <x-input-select id="form-select-product-status" name="product_deploy_status" wire:model.change="product_deploy_status">
                        
                        @foreach (array_diff(\App\Enums\DeployStatus::values(), ['Expired']) as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                        
                        </x-input-select>
                    </div>
                    <div>
                        <x-input-label for="form-select-product-keyword" class="required-label" value="Keyword"/>
                        <x-input-select id="form-select-product-keyword" name="product_meta_keyword[]" :error="$error" wire:model.change="product_meta_keyword" multiple>
                        
                        @foreach ($form_select_meta_keyword as $keywordOption)
                            <option value="{{ $keywordOption['id'] }}">{{ $keywordOption['keyword'] }}</option>
                        @endforeach

                        </x-input-select>
                        <x-input-error field="product_meta_keyword" :error="$error"/>
                    </div>
                </section>

                <section switch-form-trigger="product-description"
                        @class([
                            'space-y-4', 
                            'hidden' => $activeSwitch != 'product-description'
                        ])>
                    <div wire:ignore>
                        <x-input-label for="form-input-product-description" class="required-label" value="Deskripsi Produk"/>
                        <x-input-textarea id="form-input-product-description" name="product_description" :error="$error" wire:model="product_description"></x-input-textarea>
                        <x-input-error field="product_description" :error="$error"/>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-3 flex items-center justify-center">
            <x-button class="px-12 gap-2 group" switch-form-target="product-informations">
                <div @class([
                    'rounded-full border border-light-gray-100 p-2.5 group-hover:bg-secondary', 
                    'border-secondary bg-secondary' => $activeSwitch == 'product-informations',
                    'bg-light-gray-100 '            => $activeSwitch != 'product-informations',
                ])>
                    <x-icon @class([
                        'h-4', 
                        'filter-white' => $activeSwitch == 'product-informations',
                        'grayscale'    => $activeSwitch != 'product-informations',
                    ]) src="{{ asset('img/icons/icon-info-fill.webp') }}" iconStyle="hover-white"/>
                </div>
                <div class="text-left">
                    <div class="text-sm">Step 1/3</div>
                    <strong>Informasi Produk</strong>
                </div>
            </x-button>
            <x-icon class="h-4 grayscale" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
            <x-button class="px-12 gap-2 group" switch-form-target="product-details">
                <div @class([
                    'rounded-full border border-light-gray-100 p-2.5 group-hover:bg-secondary', 
                    'border-secondary bg-secondary' => $activeSwitch == 'product-details',
                    'bg-light-gray-100 '            => $activeSwitch != 'product-details',
                ])>
                    <x-icon @class([
                        'h-4', 
                        'filter-white' => $activeSwitch == 'product-details',
                        'grayscale'    => $activeSwitch != 'product-details',
                    ]) src="{{ asset('img/icons/icon-header-search.webp') }}" iconStyle="hover-white"/>
                </div>
                <div class="text-left">
                    <div class="text-sm">Step 2/3</div>
                    <strong>Detail Produk</strong>
                </div>
            </x-button>
            <x-icon class="h-4 grayscale" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
            <x-button class="px-12 gap-2 group" switch-form-target="product-description">
                <div @class([
                    'rounded-full border border-light-gray-100 p-2.5 group-hover:bg-secondary', 
                    'border-secondary bg-secondary' => $activeSwitch == 'product-description',
                    'bg-light-gray-100 '            => $activeSwitch != 'product-description',
                ])>
                    <x-icon @class([
                        'h-4', 
                        'filter-white' => $activeSwitch == 'product-description',
                        'grayscale'    => $activeSwitch != 'product-description',
                    ]) src="{{ asset('img/icons/icon-header-status-new.webp') }}" iconStyle="hover-white"/>
                </div>
                <div class="text-left">
                    <div class="text-sm">Step 3/3</div>
                    <strong>Deskripsi Produk</strong>
                </div>
            </x-button>
        </div>
        <x-button type="submit" class="ms-auto py-2 px-4 w-full justify-center" buttonStyle="secondary" value="Submit"/>
    </div>
</form>