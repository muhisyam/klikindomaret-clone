<header class="logo flex ps-3 mb-4">
    <a href="https://www.klikindomaret.com/">
        <img class="h-8" src="{{ asset('img/header/logo.png') }}" alt="logo">
    </a>
</header>
<section class="accountS mb-4">
    <div class="w-full h-14 rounded bg-[#fbde7e]">

    </div>
</section>
<section class="menu">
    <div class="list-menu-section">
        <div class="item-menu-section mb-4">
            <div class="title uppercase text-xs ps-3 mb-1">Home</div>
            <ul class="list-menu flex flex-col gap-1">
                <li class="item-menu">
                    <div class="menu-wrapper" id="dashboard">
                        <a href="#" class="link flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                            <div class="icon h-6 me-3"><i class="ri-bar-chart-fill"></i></div>
                            <div class="title">Dashboard</div>
                        </a>
                    </div>
                </li>
                <li class="item-menu">
                    <div class="menu-wrapper" id="dashboard">
                        <a href="#" class="link flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                            <div class="icon h-6 me-3"><i class="ri-file-text-fill"></i></div>
                            <div class="title">Activity</div>
                        </a>
                    </div>
                </li>
                <li class="item-menu">
                    <div class="menu-wrapper" id="dashboard">
                        <a href="#" class="link flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                            <div class="icon h-6 me-3"><i class="ri-booklet-fill"></i></div>
                            <div class="title">Report</div>
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
                        <div class="accordion-menu-heading mb-2">
                            <button class="active w-full flex items-center rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                <div class="icon h-6 me-3"><i class="ri-dashboard-fill"></i></div>
                                <div class="title">Kategori</div>
                                <div class="icon h-6 ms-auto"><i class="ri-arrow-down-s-line"></i></div>
                            </button>
                        </div>
                        <div class="accordion-menu-content relative show">
                            <ul class="list-submenu flex flex-col gap-1 ps-3">
                                <li class="item-submenu relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="#">
                                            <div class="title">List Kategori</div>
                                        </a>
                                    </div>
                                </li>
                                <li class="item-submenu active relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="#">
                                            <div class="title">Tambah Kategori</div>
                                        </a>
                                    </div>
                                </li>
                                <li class="item-submenu relative flex items-center">
                                    <div class="icon text-[8px] px-1 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="link w-full rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                        <a href="#">
                                            <div class="title">Tambah Sub Kategori</div>
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
        {{-- <div class="title uppercase text-xs ps-3 mb-2">Main menu</div>
        <ul class="list-menu flex flex-col gap-1">
            <li class="item-menu">
                <div class="menu-wrapper" id="dashboard">
                    <a href="#" class="flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                        <div class="icon h-6 me-2"><i class="ri-home-3-fill"></i></div>
                        <div class="title">Dashboard</div>
                    </a>
                </div>
            </li>
            <li class="item-menu">
                <div class="menu-wrapper" id="category">
                    <div class="accordion-menu-heading mb-2">
                        <button class="active w-full flex items-center rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                            <div class="icon h-6 me-2"><i class="ri-dashboard-fill"></i></div>
                            <div class="title">Category</div>
                            <div class="icon h-6 ms-auto"><i class="ri-arrow-down-s-line"></i></div>
                        </button>
                    </div>
                    <div class="accordion-menu-content show">
                        <ul class="list-submenu flex flex-col gap-1 ps-3">
                            <li class="item-submenu relative">
                                <a href="#" class="flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                    <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="title">List Category</div>
                                </a>
                            </li>
                            <li class="item-submenu relative">
                                <a href="#" class="flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                    <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="title">Input Category</div>
                                </a>
                            </li>
                            <li class="item-submenu relative">
                                <a href="#" class="active flex rounded duration-300 py-2 px-3 hover:bg-[#0079c2] hover:text-white">
                                    <div class="icon scale-50 me-2"><i class="ri-checkbox-blank-circle-fill"></i></div>
                                    <div class="title">Update Category</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul> --}}
    {{-- </div> --}}
    {{-- <div class="setting-menu">
        <div class="title uppercase text-xs ps-3 mb-2">Settings</div>
        <ul>
            <li>
                <a href="#" class="flex rounded duration-300 py-2 ps-3 mb-1 hover:bg-[#0079c2] hover:text-white">
                    <div class="icon h-6 me-2"><i class="ri-settings-fill"></i></div>
                    <div class="title">Settings</div>
                </a>
            </li>
        </ul>
    </div> --}}
</section>