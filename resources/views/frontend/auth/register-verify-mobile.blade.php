<div class="verify-wrapper | w-96 rounded-xl bg-white">
    <section class="header-section | flex flex-col items-center min-h-auth-header">
        <button type="button" class="nav-back | absolute top-3 left-3 h-9 w-9 pt-0.5 rounded-full bg-white text-xl">
            <i class="ri-arrow-left-line"></i>
        </button>
        <h1 class="header-title | font-bold mt-4">Verifikasi Nomor HP</h1>
        <img class="header-thumb | mt-2 mb-6 w-40 rounded-t-xl" src="{{ asset('img/auth/verification-phone-number.png') }}" alt="">
    </section>
    <section class="body-section | relative z-10 -mt-8 min-h-auth p-4 rounded-t-xl bg-white">
        <p class="body-message | mt-2 mb-4 text-center text-xs">Silahkan masukkan kode verifikasi <br> yang sudah dikirimkan ke Whatsapp dibawah</p>
        <p class="body-mobile-number | font-bold text-center text-secondary text-lg">{{ prettierMobileNumber(session('mobile_number')) }}</p>
        <form class="form-input-wrapper | mt-4 mb-2" method="POST" action="{{ route('verify.otp') }}">
            @csrf
            
            <div class="item-input-group | flex justify-center gap-2 mb-4">
                <input id="form-input-otp" type="text" name="otp[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1" autofocus>
                <input id="form-input-otp" type="text" name="otp[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1">
                <input id="form-input-otp" type="text" name="otp[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1">
                <input id="form-input-otp" type="text" name="otp[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1">
                <input id="form-input-otp" type="text" name="otp[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1">
                <input id="form-input-otp" type="text" name="otp[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1">
            </div>
            @if(! is_null(session('verify_wrong')))
                <div class="invalid-feedback | -mt-2 mb-2 text-red-700 text-center text-sm">
                    <p>{{ session('verify_wrong') }}</p>
                </div>
            @endif
            <div class="item-input-button">
                <button type="submit" class="h-10 w-full py-2 px-4 rounded bg-[#0079c2] text-white disabled">Verifikasi</button>
            </div>
        </form>
        <div class="term-condition | text-[#95989a] text-xs">
            <p>Coba lagi atau gunakan metode verifikasi lain</p>
            <p>Segera verifikasi 59 detik</p>
        </div>
    </section>
    <section class="footer-section | py-6 px-4 bg-white rounded-b-xl">
        <a href="#" class="help | text-[#0079c2] hover:underline-offset-2">Butuh Bantuan?</a>
    </section>
</div>