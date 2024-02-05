<div class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-[60]">
    <div class="max-w-sm bg-white rounded-xl">
        <section class="min-h-auth-header flex flex-col items-center">
            <button class="absolute top-3 left-3 h-9 w-9 bg-white rounded-full text-xl pt-0.5">
                <i class="ri-arrow-left-line"></i>
            </button>
            <h1 class="mt-4">Verifikasi Nomor HP</h1>
            <figure>
                <img class="w-40 rounded-t-xl" src="{{ asset('img/auth/verification-phone-number.png') }}" alt="">
            </figure>
        </section>
        <section class="relative z-10 min-h-auth bg-white rounded-t-xl p-4 -mt-8">
            <div class="flex items-center justify-between py-2 mb-4">
                <div class="title font-bold">Daftar</div>
                <button type="button" class="text-[#0079c2] text-sm">Masuk</button>
            </div>
            <div class="form mb-4">
                <form class="form-input-wrapper" action="">
                    <div class="item-input-group mb-4">
                        <label for="form-input-phone" class="block text-sm mb-1">Nomor HP</label>
                        <input id="form-input-phone" type="text" name="phone" class="h-10 w-full text-sm border border-[#ccc] rounded py-2 px-3 focus:ring-transparent" placeholder="Masukkan nomor HP/email">
                    </div>
                    <div class="form-button">
                        <button class="h-10 w-full bg-[#0079c2] text-white rounded py-2 px-4 disabled">Daftar</button>
                    </div>
                </form>
            </div>
            <div class="term-condition text-[#95989a] text-xs">
                <p>Coba lagi atau gunakan metode verifikasi lain</p>
                <p>Segera verifikasi 59 detik</p>
            </div>
        </section>
        <section class="footer-section bg-white rounded-b-xl py-6 px-4">
            <a href="" class="help text-[#0079c2]">Butuh Bantuan?</a>
        </section>
    </div>
</div>