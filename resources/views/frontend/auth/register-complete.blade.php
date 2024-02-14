<div class="complete-wrapper | max-w-sm rounded-xl bg-white">
    <section class="min-h-auth-header">
        <button type="button" class="button-auth | absolute top-3 left-3 h-9 w-9 rounded-full pt-0.5 bg-white text-xl" data-modal-close="register">
            <i class="ri-arrow-left-line"></i>
        </button>
        <img class="header-thumb | w-full rounded-t-xl" src="{{ asset('img/auth/background-registration.jpg') }}" alt="Register Background">
    </section>
    <section class="body-section | relative z-10 -mt-8 min-h-auth rounded-t-xl p-4 bg-white">
        <h1 class="title | mb-4 py-2 font-bold">Daftar</h1>
        <form class="form-input-wrapper | mb-4" method="POST" action="{{ route('register.complete') }}">
            @csrf

            <input type="text" name="mobile_number" class="hidden" value="{{ session('mobile_number') }}">
            <section class="first-form">
                <div class="item-input-group mb-4">
                    <label for="form-input-birthdate" class="block text-sm mb-1">Tanggal Lahir</label>
                    <input id="form-input-birthdate" type="date" name="birthdate" class="h-10 w-full rounded py-2 px-3 border border-[#ccc] text-sm focus:ring-transparent">
                </div>
                <div class="item-input-group mb-4">
                    <label for="form-input-fullname" class="block text-sm mb-1">Nama Lengkap</label>
                    <input id="form-input-fullname" type="text" name="fullname" class="h-10 w-full rounded py-2 px-3 border border-[#ccc] text-sm focus:ring-transparent">
                </div>
                <div class="form-button">
                    <button type="button" class="button-switch-form | h-10 w-full py-2 px-4 rounded bg-[#0079c2] text-white" data-switch-form="section-second" disabled>Lanjut</button>
                </div>
            </section>
            <section class="second-form hidden">
                <div class="item-input-group mb-4">
                    <label for="form-input-username-registration" class="block text-sm mb-1">Username</label>
                    <input id="form-input-username-registration" type="text" name="username" class="h-10 w-full rounded py-2 px-3 border border-[#ccc] text-sm focus:ring-transparent">
                </div>
                <div class="item-input-group mb-4">
                    <label for="form-input-password-registration" class="block text-sm mb-1">Password</label>
                    <input id="form-input-password-registration" type="password" name="password" class="h-10 w-full rounded py-2 px-3 border border-[#ccc] text-sm focus:ring-transparent">
                </div>
                <div class="form-button | flex gap-2">
                    <button type="button" class="button-switch-form | h-10 w-full py-2 px-4 rounded text-secondary" data-switch-form="section-first">Kembali</button>
                    <button type="submit" class="button-submit-form | h-10 w-full py-2 px-4 rounded bg-[#0079c2] text-white" disabled>Daftar</button>
                </div>
            </section>
        </form>
        <div class="term-condition | text-xs text-[#95989a]">
            <p>Dengan mendaftar, kamu menyetujui <a href="" class="text-[#0079c2]">Syarat & Ketentuan</a> dari Klik Indomaret</p>
        </div>
    </section>
    <section class="footer-section | rounded-b-xl py-6 px-4 bg-white">
        <a href="" class="help | text-[#0079c2] hover:underline-offset-2">Butuh Bantuan?</a>
    </section>
</div>