<form class="user-form-info bg-white rounded-lg text-sm">
    <div class="item-input-group flex items-center gap-4 mb-4">
        <label for="form-input-first-name" class="w-1/6 text-[#959595]">Nama Depan</label>
        <input id="form-input-first-name" type="text" name="first-name" placeholder="Ron" class="min-w-[41.6%] border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
    </div>
    <div class="item-input-group flex items-center gap-4 mb-4">
        <label for="form-input-last-name" class="w-1/6 text-[#959595]">Nama Belakang</label>
        <input id="form-input-last-name" type="text" name="last-name" placeholder="Weasley" class="min-w-[41.6%] border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
    </div>
    <div class="item-input-group flex items-center gap-4 mb-4">
        <label for="form-input-birthday" class="w-1/6 text-[#959595]">Tanggal Lahir</label>
        <input id="form-input-birthday" type="date" name="birthday" class="min-w-[41.6%] border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
    </div>
    <div class="item-input-group flex items-center gap-4 py-2.5 mb-4">
        <label for="form-radio-gender" class="w-1/6 text-[#959595]">Jenis Kelamin</label>
        <ul id="form-radio-gender" class="min-w-[41.6%] flex gap-8">
            <li class="flex items-center">
                <input id="radio-gender-men" type="radio" name="gender" value="Laki-laki" class="w-4 h-4 bg-[#EEE] text-[#0079C2] me-2 focus:ring-transparent" checked>
                <label for="radio-gender-men">Laki-laki</label>
            </li>
            <li class="flex items-center">
                <input id="radio-gender-women" type="radio" name="gender" value="Perempuan" class="w-4 h-4 bg-[#EEE] text-[#0079C2] me-2 focus:ring-transparent">
                <label for="radio-gender-women">Perempuan</label>
            </li>
        </ul>
    </div>
    <div class="item-input-group flex items-center gap-4 mb-4">
        <label for="form-input-phone" class="w-1/6 text-[#959595]">Nomor Ponsel</label>
        <div id="form-input-phone" class="relative min-w-[41.6%]">
            <input type="number" name="phone-number" class="w-full border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
            <div class="verify absolute top-2 right-3 flex items-center text-[#129708]">
                <div class="icon w-5 h-5">
                    <img src="{{ asset('img/user-info/verify-image.png') }}" alt="Verify Image">
                </div>
                <span class="text-info">Terverifikasi</span>
            </div>
        </div>
        <a href="#" class="bg-slate-50 rounded -ms-1" data-tooltip-target="form-phone-tooltip" data-tooltip-placement="bottom">
            <div class="rounded py-2 px-3 hover:bg-slate-100 hover:text-[#0079C2]">
                <i class="ri-edit-line"></i>
            </div>
        </a>
        <div id="form-phone-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip">
            <div class="tooltip-text">Ubah</div>
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
    <div class="item-input-group flex items-center gap-4 mb-4">
        <label for="form-input-email" class="w-1/6 text-[#959595]">Email</label>
        <div id="form-input-email" class="relative min-w-[41.6%]">
            <input type="email" name="email" class="w-full border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
        </div>
        <a href="#" class="bg-slate-50 rounded -ms-1" data-tooltip-target="form-email-tooltip" data-tooltip-placement="bottom">
            <div class="rounded py-2 px-3 hover:bg-slate-100 hover:text-[#0079C2]">
                <i class="ri-edit-line"></i>
            </div>
        </a>
        <div id="form-email-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip">
            <div class="tooltip-text">Ubah</div>
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
    <div class="item-input-group flex items-center gap-4 mb-8">
        <label for="form-input-password" class="w-1/6 text-[#959595]">Kata Sandi</label>
        <input id="form-input-password" type="password" name="password" class="min-w-[41.6%] border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
        <a href="#" class="bg-slate-50 rounded -ms-1" data-tooltip-target="form-password-tooltip" data-tooltip-placement="bottom">
            <div class="rounded py-2 px-3 hover:bg-slate-100 hover:text-[#0079C2]">
                <i class="ri-edit-line"></i>
            </div>
        </a>
        <div id="form-password-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip">
            <div class="tooltip-text">Ubah</div>
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
    <div class="form-button flex gap-4">
        <div class="w-1/6"></div>
        <button class="w-full max-w-[25%] bg-[#0079C2] text-white font-bold rounded py-2 px-4 disabled">Simpan</button>
    </div>
</form>