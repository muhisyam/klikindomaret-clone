<div class="verify-wrapper | w-96 rounded-xl bg-white">
    <section class="header-section | flex flex-col items-center min-h-auth-header">
        <button type="button" class="button-auth | absolute top-3 left-3 h-9 w-9 rounded-full pt-0.5 bg-white text-xl" data-modal-close="login">
            <i class="ri-arrow-left-line"></i>
        </button>
        <h1 class="header-title | font-bold mt-4">Verifikasi Nomor HP</h1>
        <img class="header-thumb | w-40 rounded-t-xl" src="{{ asset('img/auth/verification-phone-number.png') }}" alt="">
    </section>
    <section class="body-section | relative z-10 min-h-auth rounded-t-xl p-4 bg-white">
        <p class="body-message | mb-4 text-center text-xs">Silahkan masukkan kode verifikasi <br> yang sudah dikirimkan ke Whatsapp dibawah</p>
        <p class="body-mobile-number | font-bold text-center text-lg text-secondary">{{ prettierMobileNumber(session('mobile_number')) }}</p>
        <form class="form-input-wrapper | mt-4 mb-2" method="POST" action="{{ route('verify.otp') }}">
            @csrf
            
            <div class="item-input-group | hidden">
                <input type="text" name="mobile_number" class="hidden" value="{{ session('mobile_number') }}">
            </div>
            <div class="item-input-group | hidden">
                <input type="text" name="otp" class="hidden" value="{{ session('otp') }}">
            </div>
            <div class="item-input-group | flex justify-center gap-2 mb-4">
                <input type="text" name="otp_confirmation[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1" autofocus>
                <input type="text" name="otp_confirmation[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1">
                <input type="text" name="otp_confirmation[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1">
                <input type="text" name="otp_confirmation[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1">
                <input type="text" name="otp_confirmation[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1">
                <input type="text" name="otp_confirmation[]" class="h-10 w-10 rounded border border-[#ccc] text-center text-sm focus:ring-transparent" maxlength="1">
            </div>
            @unless (is_null(session('input_error')))
                <div class="invalid-feedback | -mt-2 mb-2 text-center text-sm text-red-700">
                    <p>{{ session('input_error')['errors']['incorrect_otp'][0] }}</p>
                </div>
            @endunless
            <div class="item-input-button">
                <button type="submit" class="button-submit-otp | h-10 w-full rounded py-2 px-4 bg-[#0079c2] text-white disabled">Verifikasi</button>
            </div>
        </form>
        <div class="resend-otp | flex justify-center text-xs text-[#95989a]">
            <p class="message"></p>
            <form class="form-input-wrapper hidden" method="POST" action="{{ route('verify.mobile') }}">
                @csrf
                
                <input type="text" name="mobile_number" class="hidden" value="{{ session('mobile_number') }}">
                <button type="submit" class="text-secondary underline">Kirim OTP kembali.</button>                
            </form>
        </div>
    </section>
    <section class="footer-section | rounded-b-xl py-6 px-4 bg-white">
        <a href="#" class="help | text-[#0079c2] hover:underline-offset-2">Butuh Bantuan?</a>
    </section>
</div>