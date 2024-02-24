<section class="min-h-auth-header">
    <x-button class="absolute top-3 left-3 h-9 w-9 pt-0.5 !rounded-full bg-white" data-target-modal="{{ $section }}">
        <x-icon class="w-3 m-auto" src="{{ asset('img/icons/icon-header-arrow-left.webp') }}"/>
    </x-button>
    <img class="w-full rounded-t-xl" src="{{ asset('img/auth/background-registration.jpg') }}" alt="Register Background">
</section>
<section class="relative z-10 -mt-8 min-h-auth rounded-t-xl p-4 bg-white">
    <h2 class="font-bold mb-4">Daftar</h2>
    <form class="mb-4" method="POST" action="{{ route('register.complete') }}">
        @csrf

        <div class="hidden">
            <x-input-field name="mobile_number" value="{{ session('mobile_number') }}"/>
        </div>
        <section data-section="register-complete-biodata">
            <div class="mb-4">
                <x-input-label for="form-input-birthdate" value="Tanggal Lahir"/>
                <x-input-field id="form-input-birthdate" type="date" name="birthdate" autofocus/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-input-fullname" value="Nama Lengkap"/>
                <x-input-field id="form-input-fullname" name="fullname"/>
            </div>
            <x-button class="justify-center h-10 w-full py-2 px-4" buttonStyle="secondary" data-switch-form="register-complete-auth" value="Lanjut"/>
        </section>
        <section class="hidden" data-section="register-complete-auth">
            <div class="mb-4">
                <x-input-label for="form-input-username-registration" value="Username"/>
                <x-input-field id="form-input-username-registration" name="username"/>
            </div>
            <div class="mb-4">
                <x-input-label for="form-input-password-registration" value="Password"/>
                <x-input-field id="form-input-password-registration" type="password" name="password"/>
            </div>
            <div class="flex gap-2">
                <x-button class="justify-center h-10 w-full py-2 px-4 text-secondary" data-switch-form="register-complete-biodata" value="Kembali"/>

                <x-button type="submit" class="justify-center h-10 w-full py-2 px-4" buttonStyle="secondary" data-submit-form="register-complete" value="Daftar"/>
            </div>
        </section>
    </form>
    <div class="flex flex-wrap gap-1 text-xs text-light-gray-300">
        <span class="shrink-0">Dengan mendaftar, kamu menyetujui</span> 
        <x-nav-link href="#" class="text-secondary shrink-0" value="Syarat & Ketentuan"/> 
        <span class="shrink-0">dari Klik Indomaret</span>
    </div>
</section>
<section class="rounded-b-xl py-6 px-4 text-sm">
    <x-nav-link href="#" class="text-secondary" value="Butuh Bantuan?"/>
</section>