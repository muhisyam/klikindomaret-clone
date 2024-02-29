<header class="header mb-6">
    <section class="top-section flex items-center justify-between">
        <div class="left-side min-w-[180px]">
            <h1 class="title text-2xl font-bold">{{ $data['pagename'] }}</h1>
        </div>
        <div class="center-side relative text-[#0079c2]">
            <div class="greeting relative min-w-[135px] h-10 flex items-center bg-[#fbde7e] rounded-lg overflow-hidden py-1.5 px-6">
                <div class="body">
                    <p class="greet-text text-lg tracking-wide">Selamat <span class="time">Pagi</span>, <span class="name italic font-bold">Jordan!</span></p>
                    @if (session()->has('success'))
                    @php $message = session()->get('success') @endphp
                    <script>
                        const title = "<?php echo $message['title']; ?>"
                        const message = "<?php echo $message['message']; ?>"
                        
                        document.addEventListener('DOMContentLoaded', function() {
                            showNotification(title, message)
                        })
                    </script>
                    @endif
                </div>
            </div>
            <p class="datetime absolute left-6 -bottom-5 w-full flex justify-center text-xs font-bold pt-1 -ms-6">Jum'at, 12 Agustus 2023</p>
        </div>
        <div class="right-side min-w-[180px]">
            <div class="flex items-center float-right">
                <button class="icon text-lg me-4" aria-label="Notification info"><i class="ri-notification-3-line"></i></button>
                <button class="icon text-lg" aria-label="Help Center"><i class="ri-question-line"></i></button>
                <div class="separator h-7 w-[1px] bg-[#ccc] mx-3"></div>
                
                @isset($data['modal'])
                <x-modal section="{{ $data['modal']['section'] }}">
                    <x-slot:trigger class="py-1.5 px-4 text-sm" buttonStyle="secondary">
                        Tambah Konten
                    </x-slot>

                    <x-slot:content class="separated-modal">
                        @push('components')
                            @if ($data['modal']['is_livewire'])
                                @livewire($data['modal']['body_path'], ['section' => $data['modal']['section']])
                            @else
                                @include($data['modal']['body_path'], ['section' => $data['modal']['section']])
                            @endif
                        @endpush
                    </x-slot>
                </x-modal>
                @endisset
                
                {{-- <a href={{ $data['navigation']['url'] }} class="w-fit flex items-center {{ $data['navigation']['info'] != 'back' ? "bg-[#0079c2]" : "bg-[#c33]" }}  text-white rounded py-2 px-4">
                    <div class="icon h-6 me-2"><i class="{{ $data['navigation']['icon'] }}"></i></div>
                    <div class="text">{{ $data['navigation']['label'] }}</div>
                </a> --}}
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