<section class="min-h-auth-header">
    <x-button class="absolute top-3 left-3 h-9 w-9 pt-0.5 !rounded-full bg-white" data-target-modal="{{ $section }}">
        <x-icon class="w-3 m-auto" src="{{ asset('img/icons/icon-header-arrow-left.webp') }}"/>
    </x-button>
    <img class="w-full rounded-t-xl" src="{{ asset('img/auth/background-registration.jpg') }}" alt="Register Background">
</section>
<section class="relative z-10 -mt-8 min-h-auth rounded-t-xl p-4 bg-white">
    <nav class="flex items-center justify-between mb-4 py-2">
        <h2 class="font-bold">Daftar</h2>
        <x-button class="text-sm text-secondary font-bold" data-switch-form="login" value="Masuk"/>
    </nav>
    <form method="POST" action="{{ route('verify.mobile') }}">
        @csrf
        
        <div class="hidden">
            <input type="text" name="via">
        </div>
        <div class="mb-4">
            <x-input-label for="form-input-mobile" value="Nomor HP"/>
            <x-input-field id="form-input-mobile" name="mobile_number" :error="session('input_error')"/>
            <x-input-error field="mobile_number" :error="session('input_error')"/>
        </div>
        <div class="flex items-center justify-center gap-2 mb-4">
            <hr class="grow">
            <span class="text-xs text-light-gray-300">Verifikasi via</span>
            <hr class="grow">
        </div>
        <div class="flex gap-4 mb-4">
            <x-button type="submit" class="justify-center gap-1.5 h-10 w-full py-2 border border-[#25d366] text-sm text-[#25d366]" data-verify-via="whatsapp">
                <x-icon class="w-4" src="{{ asset('img/icons/icon-auth-whatsapp.webp') }}"/>
                <span class="leading-4">Whatsapp</span>
            </x-button>
            <x-button type="submit" class="justify-center gap-1.5 h-10 w-full py-2 text-sm" buttonStyle="secondary" data-verify-via="whatsapp">
                <x-icon class="w-4" src="{{ asset('img/icons/icon-auth-message.webp') }}"/>
                <span class="leading-4">SMS</span>
            </x-button>
        </div>
    </form>
    <div class="text-xs text-light-gray-300">
        <span>Untuk via SMS, pastikan nomor yang dituju aktif dan memiliki pulsa.</span> 
    </div>
</section>
<section class="rounded-b-xl py-6 px-4 text-sm">
    <x-nav-link href="#" class="text-secondary" value="Butuh Bantuan?"/>
</section>