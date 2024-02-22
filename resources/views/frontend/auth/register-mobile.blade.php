<div class="mobile-wrapper | max-w-sm rounded-xl bg-white">
    <section class="header-section | min-h-auth-header">
        <button type="button" class="button-auth | absolute top-3 left-3 h-9 w-9 pt-0.5 rounded-full bg-white text-xl" data-modal-close="register">
            <i class="ri-arrow-left-line"></i>
        </button>
        <img class="header-thumb | w-full rounded-t-xl" src="{{ asset('img/auth/background-registration.jpg') }}" alt="Register Background">
    </section>
    <section class="body-section | relative z-10 -mt-8 min-h-auth p-4 rounded-t-xl bg-white">
        <div class="nav-login | flex items-center justify-between mb-4 py-2">
            <h1 class="title | font-bold">Daftar</h1>
            <button type="button" class="button-switch-form | text-[#0079c2] text-sm" data-switch-form="login">Masuk</button>
        </div>
        <form class="form-input-wrapper" method="POST" action="{{ route('verify.mobile') }}">
            @csrf
            
            <div class="item-input-group | mb-4">
                <label for="form-input-mobile" class="block mb-1 text-sm">Nomor HP</label>
                <input id="form-input-mobile" type="text" name="mobile_number" class="h-10 w-full rounded py-2 px-3 border border-[#ccc] text-sm focus:ring-transparent" autofocus>
            </div>
            @isset (session('input_error')['register'])
                <div class="invalid-feedback | -mt-2 mb-2 text-red-700 text-sm">
                    <p>{{ session('input_error')['register']['errors']['mobile_number'][0] }}</p>
                </div>
            @endisset
            <div class="item-input-button | flex items-center justify-center gap-2 mb-4">
                <div class="line | h-[1px] flex-grow bg-[#ccc]"></div>
                <p class="text-xs">Verifikasi via</p>
                <div class="line | h-[1px] flex-grow bg-[#ccc]"></div>
            </div>
            <div class="item-input-button | flex gap-4 mb-4">
                <button type="submit" class="flex items-center justify-center gap-1 h-10 w-full py-2 px-4 rounded border border-[#25d366] text-sm text-[#25d366]">
                    <i class="ri-whatsapp-fill"></i>
                    <span>Whatsapp</span>
                </button>
                <button type="submit" class="flex items-center justify-center gap-1 h-10 w-full py-2 px-4 rounded bg-secondary text-sm text-white">
                    <i class="ri-message-fill"></i>
                    <span>SMS</span>
                </button>
            </div>
        </form>
        <div class="term-condition | text-xs text-[#95989a]">
            <p>Untuk via SMS, pastikan nomor yang dituju aktif dan memiliki pulsa.</p>
        </div>
    </section>
    <section class="footer-section | rounded-b-xl py-6 px-4 bg-white">
        <a href="" class="help | text-[#0079c2] hover:underline-offset-2">Butuh Bantuan?</a>
    </section>
</div>