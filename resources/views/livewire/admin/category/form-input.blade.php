<div>
    <div class="item-input-group mb-4" wire:ignore>
        <label for="form-select-level" class="block text-sm mb-1">Level Kategori</label>
        <select id="form-select-level" name="level" wire:model="selectedLevel">
            <option></option>
            <option value="1">Level 1</option>
            <option value="2">Level 2</option>
            <option value="3">Level 3</option>
        </select>
    </div>
    <div class="item-input-group relative mb-4" wire:ignore>
        <label for="form-select-parent" class="text-sm mb-1">Induk Kategori</label>
        <span class="!absolute -top-1 inline-flex loader-spin ms-1" wire:loading></span>
        <select id="form-select-parent" name="parent_id" class="{{ array_key_exists('parent_id', $error['errors']) ? 'is-invalid' : '' }}" wire:loading.attr="disabled">
            @isset ($data)
                @if (is_null($data['parent_id']))
                    <option value="0">Kategori Induk</option>
                @else
                    <option value="{{ $data['parent_id'] }}">{{ $data['parent']['category_name'] }}</option>
                @endif
            @endisset
            <option></option>
        </select>
        @include('admin.components.validation-message', ['field' => 'parent_id', 'validation' => 'form'])
    </div>
    <div class="item-input-group mb-4">
        <label for="form-input-first-name" class="block text-sm mb-1">Nama Kategori</label>
        <input id="form-input-first-name" type="text" name="category_name" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent {{ array_key_exists('category_name', $error['errors']) ? 'is-invalid' : '' }}" wire:model.blur="inputName">
        @include('admin.components.validation-message', ['field' => 'category_name', 'validation' => 'form'])
    </div>
    <div class="item-input-group mb-4">
        <label for="form-input-slug" class="block text-sm mb-1">Slug</label>
        <input id="form-input-slug" type="text" name="category_slug" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent {{ array_key_exists('category_slug', $error['errors']) ? 'is-invalid' : '' }}" wire:model="inputSlug">
        @include('admin.components.validation-message', ['field' => 'category_slug', 'validation' => 'form'])
    </div>
    <div class="item-input-group mb-4" wire:ignore>
        <label for="form-select-status" class="block text-sm mb-1">Status</label>
        <select id="form-select-status" name="category_status" class="{{ array_key_exists('category_status', $error['errors']) ? 'is-invalid' : '' }}">
            <option></option>
            @php $selectedStatus = isset($data) ? $data['category_status'] : old('category_status') @endphp
            <option value="Draft" @selected($selectedStatus === 'Draft')>Draft</option>
            <option value="Publish" @selected($selectedStatus === 'Publish')>Publish</option>
        </select>
        @include('admin.components.validation-message', ['field' => 'category_status', 'validation' => 'form'])
    </div>
</div>

@push('scripts')

    <script type="text/javascript">
        // Jquery just for livewire select2 purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-level').on('change', function () {
            @this.set('selectedLevel', $(this).val());
        });
        // ========>>>>>>> Thanks for the tolerance(👍 ͡• ₃ ͡•)👍
        
        document.addEventListener('livewire:initialized', () => {
            @this.on('select2', (event) => {
                let option = '';
                const selectParent = document.querySelector('#form-select-parent');
                const dataEvent = event.category !== null ? event.category.data : null ;
                
                option = `<option value="0">Kategori Induk</option>`

                if (dataEvent !== null) {
                    dataEvent.forEach((data, i) => {
                        if (i === 0) {
                            option = `<option></option>`
                        }

                        if (!data.hasOwnProperty('children')) {
                            return option += `<option value="${data.id}">${data.category_name}</option>`
                        }
                        
                        let childOption = '';
                        
                        data.children.forEach(dataChild => {
                            childOption += `<option value="${dataChild.id}">${dataChild.category_name}</option>`
                        })
                        
                        option += `<optgroup label="${data.category_name}">${childOption}</optgroup>`;
                    });
                }
                selectParent.innerHTML = option;
            });
        });

        const errorSelect = document.querySelectorAll('select[id^=form-select].is-invalid');

        errorSelect.forEach(el => {
            const s2Target = el.nextSibling;
            const s2wrapper = s2Target.querySelector('.select2-selection');

            s2wrapper.style.borderColor = '#dc2626';
        });
    </script>

@endpush