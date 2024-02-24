<section class="flex flex-col items-center min-h-auth-header">
    <x-button class="absolute top-3 left-3 h-9 w-9 pt-0.5 !rounded-full bg-white" data-target-modal="{{ $section }}">
        <x-icon class="w-3 m-auto" src="{{ asset('img/icons/icon-header-arrow-left.webp') }}"/>
    </x-button>
    <h1 class="font-bold mt-4">Verifikasi Nomor HP</h1>

    @php $via = session('via') ?? 'sms' @endphp

    <img class="w-40 rounded-t-xl" src="{{ asset('img/auth/verification-phone-'. $via .'.webp') }}" alt="Verify OTP">
</section>
<section class="relative z-10 min-h-auth rounded-t-xl p-4 bg-white">
    <p class="mb-4 text-center text-xs">Silahkan masukkan kode verifikasi <br> {{ session('via') === 'sms' ? 'dari pesan' : '' }} yang sudah dikirimkan ke {{ session('via') === 'sms' ? 'nomor' : 'Whatsapp' }} dibawah</p>
    <p class="font-bold text-center text-lg text-secondary">{{ prettierMobileNumber(session('mobile_number')) }}</p>
    <form class="mt-4 mb-2" method="POST" action="{{ route('verify.otp') }}">
        @csrf
        
        <div class="hidden">
            <input type="text" name="mobile_number" value="{{ session('mobile_number') }}">
        </div>
        <div class="hidden">
            <input type="text" name="otp" value="{{ session('otp') }}">
        </div>
        <div class="flex justify-center gap-2 mb-4">
            <x-input-field name="otp_confirmation[]" class="!w-10 text-center focus:ring-transparent" maxlength="1"/>
            <x-input-field name="otp_confirmation[]" class="!w-10 text-center focus:ring-transparent" maxlength="1"/>
            <x-input-field name="otp_confirmation[]" class="!w-10 text-center focus:ring-transparent" maxlength="1"/>
            <x-input-field name="otp_confirmation[]" class="!w-10 text-center focus:ring-transparent" maxlength="1"/>
            <x-input-field name="otp_confirmation[]" class="!w-10 text-center focus:ring-transparent" maxlength="1"/>
            <x-input-field name="otp_confirmation[]" class="!w-10 text-center focus:ring-transparent" maxlength="1"/>
        </div>
        <x-input-error field="incorrect_otp" class="!-mt-2 mb-2 text-center" :error="session('input_error')"/>
        <x-button type="submit" class="hidden" data-submit-form="verify-otp"/>
    </form>
    <section class="flex justify-center text-xs text-[#95989a]" data-section="resend-otp">
        <p class="message"></p>
        <form class="hidden" method="POST" action="{{ route('verify.mobile') }}">
            @csrf
            
            <input type="text" name="mobile_number" class="hidden" value="{{ session('mobile_number') }}">
            <button type="submit" class="text-secondary underline">Kirim OTP kembali.</button>                
        </form>
    </section>
</section>
<section class="rounded-b-xl py-6 px-4 text-sm">
    <x-nav-link href="#" class="text-secondary" value="Butuh Bantuan?"/>
</section>