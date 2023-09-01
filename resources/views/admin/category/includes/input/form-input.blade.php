<div class="item-input-group mb-4">
    <label for="form-select-level" class="block text-sm mb-1">Level Kategori</label>
    <select id="form-select-level" name="">
        <option></option>
        <option value="2">Level 1</option>
        <option value="s">Level 2</option>
        <option value="c">Level 3</option>
    </select>
</div>
<div class="item-input-group mb-4">
    <label for="form-select-parent" class="block text-sm mb-1">Induk Kategori</label>
    <select id="form-select-parent" name="parent_id" class="{{ array_key_exists('parent_id', $error['errors']) ? 'is-invalid' : '' }}" value="{{ old('parent_id') }}">
        <option></option>
        <option value="13">Makanan</option>
        <option value="3">Minuman</option>
    </select>
    @if (array_key_exists('parent_id', $error['errors']))
    <div class="invalid-feedback flex text-red-600 text-sm mt-1">
        <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
        <p class="message">{{ $error['errors']['parent_id'][0] }}</p>
    </div> 
    @endif
</div>
<div class="item-input-group mb-4">
    <label for="form-input-first-name" class="block text-sm mb-1">Nama Kategori</label>
    <input id="form-input-first-name" type="text" name="name" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent {{ array_key_exists('name', $error['errors']) ? 'is-invalid' : '' }}" value="{{ old('name') }}">
    @if (array_key_exists('name', $error['errors']))
    <div class="invalid-feedback flex text-red-600 text-sm mt-1">
        <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
        <p class="message">{{ $error['errors']['name'][0] }}</p>
    </div> 
    @endif
</div>
<div class="item-input-group mb-4">
    <label for="form-input-slug" class="block text-sm mb-1">Slug</label>
    <input id="form-input-slug" type="text" name="slug" class="h-10 w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent {{ array_key_exists('slug', $error['errors']) ? 'is-invalid' : '' }}" value="{{ old('slug') }}">
    @if (array_key_exists('slug', $error['errors']))
    <div class="invalid-feedback flex text-red-600 text-sm mt-1">
        <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
        <p class="message">{{ $error['errors']['slug'][0] }}</p>
    </div> 
    @endif
</div>
<div class="item-input-group mb-4">
    <label for="form-select-status" class="block text-sm mb-1">Status</label>
    <select id="form-select-status" name="status" class="{{ array_key_exists('status', $error['errors']) ? 'is-invalid' : '' }}">
        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Tidak Aktif</option>
        <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Aktif</option>
    </select>
    @if (array_key_exists('status', $error['errors']))
    <div class="invalid-feedback flex text-red-600 text-sm mt-1">
        <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
        <p class="message">{{ $error['errors']['status'][0] }}</p>
    </div> 
    @endif
</div>