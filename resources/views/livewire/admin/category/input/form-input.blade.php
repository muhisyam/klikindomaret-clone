<form action="{{ $formRoute }}" method="POST" enctype="multipart/form-data" wire:init="loadContent">
    @csrf
    @if (str_contains(url()->current(), '/edit')) @method('PUT') @endif

    <section class="flex gap-4 mb-5" data-section="category-input-wrapper">
        <div class="relative overflow-auto rounded-xl p-4 border border-[#eee] h-full w-2/5">
            <div class="mb-4">
                <x-input-label for="form-input-image" value="Tambah Gambar(optional)"/>
                <x-input-field id="form-input-image" class="hidden" name="category_image_name" type="file" accept=".jpg, .jpeg, .png, .webp"/>
                <x-input-image-fancy/>
            </div>
            <div class="flex flex-col gap-2">
                <x-input-error field="category_image_name" :error="$error" validation="single-image"/>
                
                <div data-element="image-uploaded-wrapper">
                    
                @empty($category_image_name)
                
                    <div class="rounded-md p-2 border border-light-gray-100 flex items-center justify-between">
                        <div class="w-11/12 flex items-center gap-2.5">
                            <div class="rounded h-12 w-12 grid place-content-center bg-tertiary ">
                                <x-icon class="h-[22px] jump" src="{{ asset('img/icons/icon-upload.webp') }}"/>
                            </div>
                            <div class="font-bold line-clamp-1 text-ellipsis">Tidak ada gambar.</div>
                        </div>
                    </div>

                @else
                    
                    <div class="rounded-md p-2 border border-light-gray-100 flex items-center justify-between">
                        <div class="w-11/12 flex items-center gap-2">
                            <img class="rounded-md h-12 shrink-0" src="{{ asset('img/uploads/categories/' . $category_image_name) }}" alt="Category Image">
                            <div>
                                <div class="font-bold line-clamp-1 text-ellipsis">{{ $original_category_image_name }}</div>
                                <div class="text-xs font-light">{{ $category_image_size }}</div>
                            </div>
                        </div>
                        <x-button class="px-1.5 h-8 hover:bg-tertiary hover:text-secondary" data-button-image="remove" data-original-image-name="{{ $original_category_image_name }}">
                            <x-icon class="h-4" src="{{ asset('img/icons/icon-delete.webp') }}"/>
                        </x-button>
                    </div>

                @endempty
                
                </div>
            </div>
        </div>

        <div class="overflow-auto p-4 rounded-xl border border-light-gray-100 w-3/5">
            <x-loader wire:loading.class.remove="hidden" wire:target="loadContent"/>
            <div class="mb-4">
                <x-input-label for="form-select-parent" value="Kategori Induk"/>
                <x-input-select id="form-select-parent" name="parent_id" wire:model.change="parent_id">
                    <option value="0" @selected(0 == $parent_id)>Kategori Level 0|Induk Kategori</option>

                @foreach ($categoryOption as $option)
                    <option value="{{ $option['category_id'] }}" @selected($option['category_id'] == $parent_id)>{{ $option['category_level'] . '|' .  $option['category_name']}}</option>
                @endforeach

                </x-input-select>
                <x-input-error field="parent_id" :error="$error"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-input-category-name" value="Nama Kategori"/>
                <x-input-field id="form-input-category-name" name="category_name" :error="$error" wire:model.blur="category_name"/>
                <x-input-error field="category_name" :error="$error"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-input-category-slug" value="Slug Kategori"/>
                <x-input-field id="form-input-category-slug" name="category_slug" :error="$error" wire:model="category_slug"/>
                <x-input-error field="category_slug" :error="$error"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-select-category-status" value="Status"/>
                <x-input-select id="form-select-category-status" name="category_deploy_status" wire:model.change="category_deploy_status">
                
                @foreach (array_diff(\App\Enums\DeployStatus::values(), ['Expired']) as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
                
                </x-input-select>
            </div>
        </div>
    </section>

    <x-button type="submit" class="ms-auto py-2 px-4 max-w-[20%] w-full justify-center" buttonStyle="secondary" value="Submit"/>
</form>