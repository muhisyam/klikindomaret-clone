<div class="modal w-96 bg-white rounded-xl" data-trigger-modal="{{ $section }}">
    <section class="min-h-auth-header">
        <x-button class="absolute top-3 left-3 h-9 w-9 pt-0.5 !rounded-full bg-white" data-target-modal="{{ $section }}">
            <x-icon class="w-3 m-auto" src="{{ asset('img/icons/icon-header-arrow-left.webp') }}"/>
        </x-button>
        <img class="w-full rounded-t-xl" src="{{ asset('img/auth/background-login.jpg') }}" alt="Login Background">
    </section>
    <section class="relative z-10 min-h-auth bg-white rounded-t-xl p-4 -mt-8">
        <nav class="flex items-center justify-between mb-4 py-2">
            <h2 class="font-bold">Masuk</h2>
            <x-button class="text-sm text-secondary font-bold" data-switch-form="register" value="Daftar"/>
        </nav>
        <div class="form">
            <form class="form-input-wrapper" method="POST" action="{{ route('login.attempt') }}">
                @csrf

                <div class="item-input-group mb-4">
                    <x-input-label for="form-input-mobile-email-login" value="Nomor HP/Email"/>
                    <x-input-field id="form-input-mobile-email-login" name="mobile_email"/>
                </div>
                <div class="item-input-group mb-4">
                    <x-input-label for="form-input-password-login" value="Kata Sandi"/>
                    <x-input-field id="form-input-password-login" type="password" name="password"/>
                </div>
                <div class="item-input-group flex justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <x-input-field id="form-input-remember-me" class="!h-4 !w-4" type="checkbox" name="remember_me"/>
                        <x-input-label for="form-input-remember-me" class="!mb-0" value="Ingat Saya"/>
                    </div>
                    <x-nav-link href="#" class="text-secondary text-sm" value="Lupa Kata Sandi?"/>
                </div>
                <x-button type="submit" class="h-10 w-full justify-center bg-secondary text-white p-2" value="Masuk"/>
            </form>
        </div>
    </section>
    <section class="rounded-b-xl py-6 px-4 text-sm">
        <x-nav-link href="#" class="text-secondary" value="Butuh Bantuan?"/>
    </section>
</div>
