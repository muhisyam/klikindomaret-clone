@extends($pageParent)

@section('title')
Not Found
@endsection

@php $header = false @endphp

@section('content')
    @php
        $dataHeader = [
            'pagename' => 'Page Not Found',
            'breadcrumb_pages' => [
                [
                    'info' => 'first',
                    'label' => 'Page', 
                    'link' => '#'
                ],
                [
                    'info' => 'last',
                    'label' => 'Not Found'
                ],
            ],
            'navigation' => [
                'info' => 'back',
                'url' => $linkRedirect,
                'icon' => 'ri-arrow-go-back-line',
                'label' => 'Kembali'
            ]
        ]
    @endphp
    
    <div class="not-found | relative">
        <section class="wrapper-info |   flex flex-col items-center">
            <figure class="w-96 mb-4">
                <img src="{{ asset('img/pages/error_404.webp') }}" alt="">
            </figure>
            <h1 class="text-2xl font-bold mb-2">Sepertinya kamu tersesat</h1>
            <h2>{{ $dataErrors['message'][0] }}</h2>
            <a href={{ $linkRedirect }} class="mt-6">
                <button class="h-10 bg-secondary text-white rounded py-2 px-6">Kembali ke beranda</button>
            </a>
        </section>
    </div>
@endsection

