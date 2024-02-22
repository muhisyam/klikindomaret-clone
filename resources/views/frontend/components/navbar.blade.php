<section class="container mx-auto max-w-7xl h-full" data-section="navigation-header">
    <header class="top-section flex justify-between">
        <section class="flex items-center gap-6 text-xs" data-section="app-social">
            <x-dropdown section="app-download">
                <x-slot name="trigger" class="group gap-1.5 dont-active hover:text-secondary">
                    <x-icon class="w-3 brightness-50 grayscale group-hover:filter-none" src="{{ asset('img/icons/icon-header-app.webp') }}"/>
                    <span>Download App Klik Indomaret</span>
                    <x-icon class="w-2 duration-500 brightness-50 grayscale group-hover:filter-none" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-dropdown=""/>
                </x-slot>

                <x-slot name="content" class="left-0 w-60 p-3 bg-white before:!right-[78%]">
                    <img src="{{ asset('img/header/qr_download.png') }}" alt="QR Code">
                    <x-nav-link href="#" class="w-36 mx-auto my-2.5">
                        <img src="{{ asset('img/header/logo_googleplay.png') }}" alt="Google Play">
                    </x-nav-link>
                    <x-nav-link href="#" class="w-36 mx-auto my-2.5">
                        <img src="{{ asset('img/header/logo_appStore.png') }}" alt="App Store">
                    </x-nav-link>
                </x-slot>
            </x-dropdown>

            <div class="flex items-center gap-1.5">
                <span>Ikuti kami di</span>
                <x-nav-link href="https://www.facebook.com/klikindomaret" target="_blank">
                    <x-icon class="w-4 brightness-50 grayscale hover:filter-none" src="{{ asset('img/icons/icon-header-fb.webp') }}"/>
                </x-nav-link>
                <x-nav-link href="https://www.instagram.com/klikindomaret" target="_blank">
                    <x-icon class="w-4 brightness-50 grayscale hover:filter-none" src="{{ asset('img/icons/icon-header-ig.webp') }}"/>
                </x-nav-link>
            </div>

            <x-dropdown section="customer-service">
                <x-slot name="trigger" class="group gap-1.5 dont-active hover:text-secondary">
                    <x-icon class="w-3 brightness-50 grayscale group-hover:filter-none" src="{{ asset('img/icons/icon-header-cs.webp') }}"/>
                    <span>Layanan Pelanggan</span>
                    <x-icon class="w-2 duration-500 brightness-50 grayscale group-hover:filter-none" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-dropdown=""/>
                </x-slot>

                <x-slot name="content" class="left-0 w-72 p-3 bg-white before:!right-[78%]">
                    <div class="phone-block mb-1">
                        <h2 class="mb-1 text-xs">Call Center:</h2>
                        <div class="flex gap-1">
                            <x-icon class="h-5 w-5" src="{{ asset('img/icons/icon-header-call.webp') }}"/>
                            <div class="wrapper-desc">
                                <div class="text-sm"><a href="tel:+62211500280">(021) 1500280</a></div>
                                <div class="text-[10px] text-light-gray-300">Senin-Minggu, 08.00-17.00 WIB</div>
                            </div>
                        </div>
                    </div>

                    <div class="mail-block">
                        <h2 class="mb-1 text-xs">Email:</h2>
                        <div class="flex items-center gap-1">
                            <x-icon class="h-5 w-5" src="{{ asset('img/icons/icon-header-mail.webp') }}"/>
                            <div class="text-sm"><a href="mailto:customercare@klikindomaret.com">customercare@klikindomaret.com</a></div>
                        </div>
                    </div>
                </x-slot>
            </x-dropdown>
        </section>

        <div class="h-8 w-1/3 flex gap-2 rounded-b-xl drop-shadow-md px-3.5 pt-1 bg-white text-sm overflow-hidden cursor-pointer">
            <x-icon class="h-3 w-3 mt-1" src="{{ asset('img/icons/icon-header-map-marker.webp') }}"/>
            <span class="guest-info mt-[-3px] leading-7 text-xs">
                <span>Harga untuk wilayah JAKARTA PUSAT, Gunung Sahari Selatan</span>
                <span class="text-secondary">Masuk dulu yuk untuk ganti alamat & lokasimu</span>
            </span>
            <x-icon class="h-2 w-2 mt-1.5" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-location=""/>
        </div>
    </header>
    <footer class="flex items-center justify-between pt-3 pb-4">
        <x-nav-link>
            <img class="h-8" src="{{ asset('img/header/logo.png') }}" alt="Logo">
        </x-nav-link>

        <x-button class="flex items-center gap-1.5 h-5 mx-[42px]">
            <x-icon class="w-5" src="{{ asset('img/icons/icon-header-category.webp') }}"/>
            <span class="text-secondary">Kategori</span>
            <x-icon class="w-2" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-category=""/>
        </x-button>

        <div class="search-bar w-[39rem]">
            <div class="relative">
                <input type="search" id="default-search" class="block w-full px-3 py-1.5 text-sm text-[#555] border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 placeholder:text-slate-400" placeholder="Mau beli apa hari ini?" required>
                
                <a class="absolute right-4 bottom-[4.5px] rounded py-1 px-3 bg-tertiary" href="#">
                    <x-icon class="w-4" src="{{ asset('img/icons/icon-header-search.webp') }}" data-arrow-category=""/>
                </a>
            </div>
        </div>

        <div class="right-side relative flex items-center justify-end grow">
            @if(is_null(session('auth_token')))
                <x-modal section="guest-cart">
                    <x-slot name="trigger" class="me-4 p-1.5 hover:bg-dark-primary">
                        <x-icon class="w-5" src="{{ asset('img/icons/icon-header-cart.webp') }}"/>
                    </x-slot>

                    <x-slot name="content">
                        
                    </x-slot>
                </x-modal>

                <div class="guest-button text-sm">
                    <button type="button" id="btn-login" class="button-auth  | rounded-lg border border-[#0079c2] me-2 py-1.5 px-4 bg-white text-[#0079c2]" data-modal-open="login">Masuk</button>
                    <button type="button" id="btn-register" class="button-auth  | rounded-lg py-1.5 px-5 bg-[#0079c2] text-white" data-modal-open="register">Daftar</button>
                </div>
            @else
                @php
                    //TODO: add tooltips
                @endphp
                <x-nav-link href="#" class="relative me-4 p-1.5 hover:bg-dark-primary">
                    <x-icon class="w-5" src="{{ asset('img/icons/icon-header-bell.webp') }}"/>
                    <x-notification-count class="top-0 -right-1 rounded py-0.5 px-1" count="99+"/>
                </x-nav-link>
                
                <x-nav-link href="#" class="relative me-4 p-1.5 hover:bg-dark-primary">
                    <x-icon class="w-5" src="{{ asset('img/icons/icon-header-status-new.webp') }}"/>
                </x-nav-link>

                <x-nav-link href="#" class="relative me-4 p-1.5 hover:bg-dark-primary">
                    <x-icon class="w-5" src="{{ asset('img/icons/icon-header-cart.webp') }}"/>
                    <x-notification-count class="top-0 -right-1 rounded py-0.5 px-1" count="99+"/>
                </x-nav-link>

                <x-dropdown section="user-account-ewallet">
                    <x-slot name="trigger" class="gap-1.5 me-2 p-1.5 hover:bg-dark-primary">
                        <x-icon class="w-5" src="{{ asset('img/icons/icon-header-wallet.webp') }}"/>
                        <x-icon class="w-2 duration-500" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-dropdown=""/>
                    </x-slot>

                    <x-slot name="content" class="-right-[22px] w-64 p-3 bg-white before:right-1/5">
                        <x-button class="group w-full gap-3 mb-3">
                            <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon-isaku.webp') }}"/>
                            <div class="flex-grow font-bold text-left text-secondary text-sm">
                                <span class="font-normal text-xs text-light-gray-300">i.saku</span><br>
                                <span class="group-hover:underline group-hover:underline-offset-2">Hubungkan</span>
                            </div>
                            <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-button>

                        <x-button class="group w-full gap-3 mb-3">
                            <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon-poinku.webp') }}"/>
                            <div class="flex-grow font-bold text-left text-secondary text-sm">
                                <span class="font-normal text-xs text-light-gray-300">Poinku</span><br>
                                <span class="group-hover:underline group-hover:underline-offset-2">Hubungkan</span>
                            </div>
                            <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-button>

                        <x-button class="group w-full gap-3 mb-3">
                            <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon-wallet.webp') }}"/>
                            <div class="flex-grow font-bold text-left text-sm">
                                <span class="font-normal text-xs text-light-gray-300">Saldo Klik</span><br>
                                <span class="group-hover:underline group-hover:underline-offset-2">Aktivasi</span>
                            </div>
                            <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-button>

                        <x-button class="group w-full gap-3 mb-3">
                            <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon_shopeepay.webp') }}"/>
                            <div class="flex-grow font-bold text-left text-secondary text-sm">
                                <span class="font-normal text-xs text-light-gray-300">ShopeePay</span><br>
                                <span class="group-hover:underline group-hover:underline-offset-2">Hubungkan</span>
                            </div>
                            <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-button>

                        <x-button class="group w-full gap-3 mb-3">
                            <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon-ovo.webp') }}"/>
                            <div class="flex-grow font-bold text-left text-secondary text-sm">
                                <span class="font-normal text-xs text-light-gray-300">OVO</span><br>
                                <span class="group-hover:underline group-hover:underline-offset-2">Hubungkan</span>
                            </div>
                            <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-button>

                        <x-button class="group w-full gap-3 mb-3">
                            <x-icon class="w-8 p-1.5 rounded-full shadow-md" src="{{ asset('img/e-wallet/icon-gopay.webp') }}"/>
                            <div class="flex-grow font-bold text-left text-secondary text-sm">
                                <span class="font-normal text-xs text-light-gray-300">Gopay</span><br>
                                <span class="group-hover:underline group-hover:underline-offset-2">Hubungkan</span>
                            </div>
                            <x-icon class="w-5" src="{{ asset('img/icons/icon-header-chevron-right.webp') }}"/>
                        </x-button>
                    </x-slot>
                </x-dropdown>

                @php
                    $user = session('user');
                    $username = formatFullname($user['fullname']);
                @endphp
                
                <x-dropdown section="user-header">
                    <x-slot name="trigger" class="gap-1.5 p-1 hover:bg-dark-primary">
                        @if ($user['user_image_name'])
                            <x-avatar src="{{ asset() }}"/>
                        @else
                            <div class="w-6 h-6 border border-slate-200 rounded-full bg-blue-200 text-xs font-bold text-center pt-[3px]">{{ $user['fullname'][0] }}</div>
                        @endif
                        <span class="text-sm">{{ $username }}</span>
                        <x-icon class="w-2 duration-500 brightness-50 grayscale group-hover:filter-none" src="{{ asset('img/icons/icon-header-chevron-down.webp') }}" data-arrow-dropdown=""/>
                    </x-slot>

                    <x-slot name="content" class="right-0 w-52 bg-white before:right-1/5">
                        <x-nav-link href="#" class="justify-between p-3 text-xs hover:text-secondary">
                            <strong>Hi, {{ $username }}</strong>
                            <x-icon class="w-3" src="{{ asset('img/icons/icon-header-edit.webp') }}"  alt="Edit User Icon"/>
                        </x-nav-link>

                        <hr>

                        <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                            <x-icon class="w-3" src="{{ asset('img/icons/icon-header-fav.webp') }}" alt="Favorite Icon"/>
                            <span>Favorit</span>
                        </x-nav-link>

                        <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                            <x-icon class="w-3" src="{{ asset('img/icons/icon-header-bank.webp') }}" alt="Bank Account Icon"/>
                            <span>Rekening Bank</span>
                        </x-nav-link>

                        <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                            <x-icon class="w-3" src="{{ asset('img/icons/icon-header-complaint.webp') }}" alt="Complaint Icon"/>
                            <span>Resolusi Komplain</span>
                        </x-nav-link>

                        <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                            <x-icon class="w-3" src="{{ asset('img/icons/icon-header-notification.webp') }}" alt="Notification Icon"/>
                            <span>Notifikasi</span>
                        </x-nav-link>

                        <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                            <x-icon class="w-3" src="{{ asset('img/icons/icon-header-invite-friend.webp') }}" alt="Invite Friend Icon"/>
                            <span>Undang Teman</span>
                        </x-nav-link>

                        <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                            <x-icon class="w-3" src="{{ asset('img/icons/icon-header-coupon.webp') }}" alt="Coupon Icon"/>
                            <span>Koupon Saya</span>
                        </x-nav-link>

                        <x-nav-link href="#" class="gap-3 p-3 text-xs hover:bg-[#e1eeff]">
                            <x-icon class="w-3" src="{{ asset('img/icons/icon-header-help-center.webp') }}" alt="Helper Center Icon"/>
                            <span>Bantuan</span>
                        </x-nav-link>

                        <hr>

                        <x-nav-link href="#" class="gap-3 p-3 text-xs">
                            <x-icon class="w-4" src="{{ asset('img/icons/icon-header-logout.webp') }}" alt="Logout Icon"/>
                            <span class="text-[#ff3e3e]">Keluar</span>
                        </x-nav-link>
                    </x-slot>
                </x-dropdown>
            @endif
        </div>
    </footer>
</section>
