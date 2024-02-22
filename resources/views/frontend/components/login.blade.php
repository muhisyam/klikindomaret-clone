<div @class([
        'login modal | fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-[60]', 
        'show' => in_array('login', session('input_error') ?? []),
    ])>
    <div class="login-wrapper | max-w-sm bg-white rounded-xl">
        <section class="header-section | min-h-[160px]">
            <button type="button" class="button-auth | absolute top-3 left-3 h-9 w-9 pt-0.5 rounded-full bg-white text-xl" data-modal-close="login">
                <i class="ri-arrow-left-line"></i>
            </button>
            <img class="header-thumb | w-full rounded-t-xl" src="{{ asset('img/auth/background-login.jpg') }}" alt="Login Background">
        </section>
        <section class="body-section | relative z-10 bg-white rounded-t-xl p-4 -mt-8">
            <div class="nav | flex items-center justify-between py-2 mb-4">
                <div class="title | font-bold">Masuk</div>
                <button type="button" class="button-switch-form | text-[#0079c2] text-sm" data-switch-form="register">Daftar</button>
            </div>
            <div class="form">
                <form class="form-input-wrapper" method="POST" action="{{ route('login.attempt') }}">
                    @csrf

                    <div class="item-input-group mb-4">
                        <label for="form-input-phone-email-login" class="block text-sm mb-1">Nomor HP/Email</label>
                        <input id="form-input-phone-email-login" type="text" name="mobile_email" class="h-10 w-full text-sm border border-[#ccc] rounded py-2 px-3 focus:ring-transparent" placeholder="Masukkan nomor HP/email">
                    </div>
                    <div class="item-input-group mb-4">
                        <label for="form-input-password-login" class="block text-sm mb-1">Kata Sandi</label>
                        <input id="form-input-password-login" type="password" name="password" class="h-10 w-full text-sm border border-[#ccc] rounded py-2 px-3 focus:ring-transparent" placeholder="Masukkan password">
                    </div>
                    <div class="item-input-group flex justify-between mb-4">
                        <div class="remember-me-wrapper flex items-center">
                            <input id="form-input-rememberme" type="checkbox" name="remember_me" class="border border-[#ccc] rounded me-2 focus:ring-transparent" placeholder="Masukkan rememberme">
                            <label for="form-input-remember-me" class="block text-sm">Ingat Saya</label>
                        </div>
                        <div class="forgot-password-wrapper">
                            <a href="" class="forgot-password | text-[#0079c2] text-sm">Lupa Kata Sandi?</a>
                        </div>
                    </div>
                    <div class="form-button">
                        <button class="h-10 w-full bg-[#0079c2] text-white rounded py-2 px-4 disabled">Masuk</button>
                    </div>
                </form>
            </div>
        </section>
        <section class="footer-section | bg-white text-sm  rounded-b-xl py-6 px-4">
            <a href="" class="help text-[#0079c2]">Butuh Bantuan?</a>
        </section>
    </div>
</div>