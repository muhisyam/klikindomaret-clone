<header class="logo flex ps-3 mb-4">
    <a href="https://www.klikindomaret.com/">
        <img class="h-8" src="{{ asset('img/header/logo.png') }}" alt="logo">
    </a>
</header>
<section class="account relative mb-4">
    <div class="account-wrapper flex items-center w-full rounded bg-[#fbde7e] p-2">
        <figure class="media me-2">
            <img class="h-10 w-10 border-2 border-[#0079c2] rounded-full p-1" src="https://www.shutterstock.com/image-vector/young-man-beard-character-260nw-1374216479.jpg" alt="">
        </figure>
        <div class="info me-2">
            <p class="name font-bold">Michael Jordan</p>
            <p class="role text-xs line-clamp-1 text-ellipsis">Admin Frontend Javascript</p>
        </div>
        <button class="account-dropdown bg-[#0079c2] text-white rounded py-1 px-0.5" aria-label="User action">
            <div class="icon h-6">
                <i class="ri-arrow-right-s-line"></i>
            </div>
        </button>
    </div>
    {{-- <div class="account-dropdown-wrapper absolute top-0 left-[103%]">
        <div class="h-48 w-32 bg-red-600 rounded"></div>
    </div> --}}
</section>
<section class="menu">
    <div class="list-menu-section">
        <div class="item-menu-section mb-4">
            <div class="title uppercase text-xs ps-3 mb-1">Home</div>
            <ul class="list-menu flex flex-col gap-1">
                <li class="item-menu">
                    <div class="menu-wrapper" id="dashboard">
                        <a href="#" class="link group flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                            <div class="icon h-6 text-[#0079c2] me-3 group-hover:text-white"><i class="ri-home-3-fill"></i></div>
                            <div class="title">Beranda</div>
                        </a>
                    </div>
                </li>
                <li class="item-menu">
                    <div class="menu-wrapper" id="dashboard">
                        <a href="#" class="link group flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                            <div class="icon h-6 text-[#0079c2] me-3 group-hover:text-white"><i class="ri-numbers-fill"></i></div>
                            <div class="title">Analisis</div>
                        </a>
                    </div>
                </li>
                <li class="item-menu">
                    <div class="menu-wrapper" id="activity">
                        <a href="#" class="link group flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                            <div class="icon h-6 text-[#0079c2] me-3 group-hover:text-white"><i class="ri-file-text-fill"></i></div>
                            <div class="title">Aktifitas</div>
                        </a>
                    </div>
                </li>
                <li class="item-menu">
                    <div class="menu-wrapper" id="report">
                        <a href="#" class="link group flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                            <div class="icon h-6 text-[#0079c2] me-3 group-hover:text-white"><i class="ri-booklet-fill"></i></div>
                            <div class="title">Laporan</div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="item-menu-section mb-4">
            <div class="title uppercase text-xs ps-3 mb-1">Main Menu</div>
            <ul class="list-menu flex flex-col gap-1">
                <li class="item-menu">
                    <div class="menu-wrapper" id="category">
                        <div class="accordion-menu-heading mb-1">
                            <button class="group w-full flex items-center rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white" data-menu-target="category-menu" aria-expanded="false">
                                <div class="icon h-6 text-[#0079c2] me-3 group-hover:text-white"><i class="ri-dashboard-fill"></i></div>
                                <div class="title">Kategori</div>
                                <div class="icon h-6 duration-500 ms-auto"><i class="ri-arrow-down-s-line"></i></div>
                            </button>
                        </div>
                        <div id="category-menu" class="accordion-menu-content accordion relative overflow-hidden duration-500 hide" aria-hidden="true">
                            <ul class="list-submenu min-h-0 flex flex-col gap-1 ps-3">
                                <li class="item-submenu relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="{{ url('categories') }}">
                                            <div class="title">Data Kategori</div>
                                        </a>
                                    </div>
                                </li>
                                <li class="item-submenu active relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="{{ url('categories/create') }}">
                                            <div class="title">Tambah Kategori</div>
                                        </a>
                                    </div>
                                </li>
                                <li class="item-submenu relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="{{ url('categories/create/sub') }}">
                                            <div class="title">Tambah Sub Kategori</div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="list-menu flex flex-col gap-1">
                <li class="item-menu">
                    <div class="menu-wrapper" id="product">
                        <div class="accordion-menu-heading mb-1">
                            <button class="group w-full flex items-center rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white" data-menu-target="product-menu" aria-expanded="false">
                                <div class="icon h-6 text-[#0079c2] me-3 group-hover:text-white"><i class="ri-stack-fill"></i></div>
                                <div class="title">Produk</div>
                                <div class="icon h-6 duration-500 ms-auto"><i class="ri-arrow-down-s-line"></i></div>
                            </button>
                        </div>
                        <div id="product-menu" class="accordion-menu-content accordion relative overflow-hidden duration-500 hide" aria-hidden="false">
                            <ul class="list-submenu min-h-0 flex flex-col gap-1 ps-3">
                                <li class="item-submenu relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="{{ url('products') }}">
                                            <div class="title">Data Produk</div>
                                        </a>
                                    </div>
                                </li>
                                <li class="item-submenu active relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="{{ url('products/create') }}">
                                            <div class="title">Tambah Produk</div>
                                        </a>
                                    </div>
                                </li>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="list-menu flex flex-col gap-1">
                <li class="item-menu">
                    <div class="menu-wrapper" id="product">
                        <div class="accordion-menu-heading mb-1">
                            <button class="group w-full flex items-center rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white" data-menu-target="order-menu" aria-expanded="false">
                                <div class="icon h-6 text-[#0079c2] me-3 group-hover:text-white"><i class="ri-shopping-basket-fill"></i></div>
                                <div class="title">Pemesanan</div>
                                <div class="icon h-6 duration-500 ms-auto"><i class="ri-arrow-down-s-line"></i></div>
                            </button>
                        </div>
                        <div id="order-menu" class="accordion-menu-content accordion relative overflow-hidden duration-500 hide" aria-hidden="false">
                            <ul class="list-submenu min-h-0 flex flex-col gap-1 ps-3">
                                <li class="item-submenu relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="{{ url('orders') }}">
                                            <div class="title">Data Pemesanan</div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="list-menu flex flex-col gap-1">
                <li class="item-menu">
                    <div class="menu-wrapper" id="product">
                        <div class="accordion-menu-heading mb-1">
                            <button class="group w-full flex items-center rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white" data-menu-target="content-manegement" aria-expanded="false">
                                <div class="icon h-6 text-[#0079c2] me-3 group-hover:text-white"><i class="ri-shopping-basket-fill"></i></div>
                                <div class="title">Manajemen Konten</div>
                                <div class="icon h-6 duration-500 ms-auto"><i class="ri-arrow-down-s-line"></i></div>
                            </button>
                        </div>
                        <div id="content-manegement" class="accordion-menu-content accordion relative overflow-hidden duration-500 hide" aria-hidden="false">
                            <ul class="list-submenu min-h-0 flex flex-col gap-1 ps-3">
                                <li class="item-submenu relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="{{ route('featured-content.index') }}">
                                            <div class="title">Konten Unggulan</div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="list-menu flex flex-col gap-1">
                <li class="item-menu">
                    <div class="menu-wrapper" id="product">
                        <div class="accordion-menu-heading mb-1">
                            <button class="group w-full flex items-center rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white" data-menu-target="user-menu" aria-expanded="false">
                                <div class="icon h-6 text-[#0079c2] me-3 group-hover:text-white"><i class="ri-user-3-fill"></i></div>
                                <div class="title">Pengguna</div>
                                <div class="icon h-6 duration-500 ms-auto"><i class="ri-arrow-down-s-line"></i></div>
                            </button>
                        </div>
                        <div id="user-menu" class="accordion-menu-content accordion relative overflow-hidden duration-500 hide" aria-hidden="false">
                            <ul class="list-submenu min-h-0 flex flex-col gap-1 ps-3">
                                <li class="item-submenu relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="{{ url('users') }}">
                                            <div class="title">Data Pengguna</div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="setting-menu">
        <div class="title uppercase text-xs ps-3 mb-2">Settings</div>
        <ul>
            <li>
                <a href="#" class="link group flex rounded duration-300 py-2 ps-3 mb-1 hover:bg-[#0079c2] hover:text-white">
                    <div class="icon h-6 text-[#0079c2] me-3 group-hover:text-white"><i class="ri-settings-fill"></i></div>
                    <div class="title">Pengaturan</div>
                </a>
            </li>
        </ul>
    </div>
</section>