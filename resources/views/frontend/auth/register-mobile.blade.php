<div class="mobile-wrapper | max-w-sm rounded-xl bg-white">
    <section class="header-section | min-h-auth-header">
        <button type="button" class="nav-back | absolute top-3 left-3 h-9 w-9 pt-0.5 rounded-full bg-white text-xl">
            <i class="ri-arrow-left-line"></i>
        </button>
        <img class="header-thumb | w-full rounded-t-xl" src="{{ asset('img/auth/background-registration.jpg') }}" alt="">
    </section>
    <section class="body-section | relative z-10 -mt-8 min-h-auth p-4 rounded-t-xl bg-white">
        <div class="nav-login | flex items-center justify-between mb-4 py-2">
            <span class="title | font-bold">Daftar</span>
            <button type="button" class="btn-login | text-[#0079c2] text-sm">Masuk</button>
        </div>
        <form class="form-input-wrapper" method="POST" action="{{ route('verify.mobile') }}">
            @csrf
            
            <div class="item-input-group | mb-4">
                <label for="form-input-mobile" class="block mb-1 text-sm">Nomor HP</label>
                <input id="form-input-mobile" type="text" name="mobile_number" class="h-10 w-full py-2 px-3 rounded border border-[#ccc] text-sm focus:ring-transparent" placeholder="Masukkan nomor HP/email" autofocus>
            </div>
            <div class="item-input-button | mb-4">
                <button type="submit" class="h-10 w-full py-2 px-4 rounded bg-[#0079c2] text-white disabled">Daftar</button>
            </div>
        </form>
        <div class="term-condition | text-[#95989a] text-xs">
            <p>Dengan mendaftar, kamu menyetujui <a href="#" class="text-[#0079c2]">Syarat & Ketentuan</a> dari Klik Indomaret</p>
        </div>
    </section>
    <section class="footer-section | py-6 px-4 bg-white rounded-b-xl">
        <a href="#" class="help | text-[#0079c2]">Butuh Bantuan?</a>
    </section>
</div>