<header class="header mb-6">
    <section class="top-section flex items-center justify-between">
        <div class="left-side min-w-[180px]">
            <h1 class="title text-2xl font-bold">{{ $data['pagename'] }}</h1>
        </div>
        <div class="center-side relative">
            <div class="greeting min-w-[135px] h-10 flex items-center bg-[#fbde7e] text-[#0079c2] rounded-lg overflow-hidden py-1.5 px-6">
                <div class="body">
                    {{-- <div class="action-notification flex items-center animate__animated animate__bounceInRight">
                        <div class="icon h-6 -ms-2 me-2"><i class="ri-delete-bin-6-fill"></i></div>
                        <div class="info flex items-center text-sm">
                            <h5 class="title me-1">Berhasil hapus gambar:</h5>
                            <div class="desc max-w-[175px] whitespace-nowrap overflow-hidden text-xs">
                                <p class="text relative animation-running">idyllic-shot-huge-mountain-covered-vegetation-with-body-water-its-base.jpg</p>
                            </div>
                        </div>
                        <button type="button" class="close h-6 rounded-md px-1 ms-2 -me-4 hover:bg-[#0079c2] hover:text-[#fbde7e]"><i class="ri-close-line"></i></button>
                    </div>
                    <div class="absolute left-0 bottom-0 timer-notification w-full h-1 bg-[#0079c2]"></div> --}}
                    <p class="greet-text text-lg tracking-wide">Selamat <span class="time">Pagi</span>, <span class="name italic font-bold">Jordan!</span></p>
                </div>
                <p class="datetime absolute -bottom-5 w-full flex justify-center text-xs font-bold pt-1 -ms-6">Jum'at, 12 Agustus 2023</p>
            </div>
        </div>
        <div class="right-side min-w-[180px]">
            <div class="flex items-center float-right">
                <button class="icon text-lg me-4" aria-label="Notification info"><i class="ri-notification-3-line"></i></button>
                <button class="icon text-lg" aria-label="Help Center"><i class="ri-question-line"></i></button>
                <div class="separator h-7 w-[1px] bg-[#ccc] mx-3"></div>
                <a href={{ $data['navigation']['url'] }} class="w-fit flex items-center {{ $data['navigation']['info'] != 'back' ? "bg-[#0079c2]" : "bg-[#c33]" }}  text-white rounded py-2 px-4">
                    <div class="icon h-6 me-2"><i class="{{ $data['navigation']['icon'] }}"></i></div>
                    <div class="text">{{ $data['navigation']['label'] }}</div>
                </a>
            </div>
        </div>
    </section>
    <section class="bottom-section">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center text-sm">
                @foreach ($data['breadcrumb_pages'] as $item)
                    <li class="flex items-center text-[#95989A]">
                        @if ($item['info'] == 'first') 
                            <a href={{ url($item['link']) }} class="hover:text-[#0079C2]">{{ $item['label'] }}</a>
                        @elseif ($item['info'] == 'last') 
                            <i class="ri-arrow-right-s-line mx-2"></i>
                            <span class="text-black">{{ $item['label'] }}</span>
                        @else
                            <i class="ri-arrow-right-s-line mx-2"></i>
                            <a href="{{ url($item['link']) }}" class="hover:text-[#0079C2]">{{ $item['label'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </section>
</header>