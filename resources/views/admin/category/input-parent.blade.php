@extends('admin.index')

@section('title')
Tambah Kategori
@endsection

@section('content')
<div class="category-input">
    @php
        $dataHeader = [
            'pagename' => 'Tambah Kategori',
            'breadcrumb_pages' => [
                [
                    'info' => 'first',
                    'label' => 'Kategori', 
                    'link' => 'categories'
                ],
                [
                    'info' => 'next',
                    'label' => 'Kategori Induk', 
                    'link' => 'categories/create'
                ],
                [
                    'info' => 'last',
                    'label' => 'Tambah Kategori'
                ],
            ],
            'navigation' => [
                'info' => 'back',
                'url' => 'javascript:history.go(-1)',
                'icon' => 'ri-arrow-go-back-line',
                'label' => 'Kembali'
            ]
        ]
    @endphp
    <section class="progress-info-wrapper border border-[#eee] rounded-xl overflow-hidden mb-4">
        <div class="progress-bar-wrapper flex gap-0.5">
            <div class="h-2 -skew-x-[24deg] w-full bg-[#f9c828]"></div>
            <div class="h-2 -skew-x-[24deg] w-full bg-[#f9c828]"></div>
            <div class="h-2 -skew-x-[24deg] w-full bg-[#f9c828]"></div>
            <div class="h-2 -skew-x-[24deg] w-full bg-[#eee]"></div>
            <div class="h-2 -skew-x-[24deg] w-full bg-[#eee]"></div>
            <div class="h-2 -skew-x-[24deg] w-full bg-[#eee]"></div>
            <div class="h-2 -skew-x-[24deg] w-full bg-[#eee]"></div>
            <div class="h-2 -skew-x-[24deg] w-full bg-[#eee]"></div>
        </div>
        <div class="progress-info-content flex items-center justify-between p-4">
            <div class="flex items-center">
                <h1 class="font-bold">Tambah Kategori Induk Baru</h1>
                <div class="error-info-wrapper flex text-red-600 text-sm ms-3">
                    <div class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></div>
                    <div class="message">Form tidak valid!</div>
                </div>
            </div>
            <div class="text-sm form-info">5 Form belum terisi</div>
        </div>
    </section>
    <section class="form-input-wrapper">
        @php 
            $route = Route::current()->uri == 'categories/{category}/edit' ? route('categories.update', ['category' => $data['id']]) : route('categories.store');
            $error = session()->has('inputError') ? session()->get('inputError') : ['errors' => []];
            $options = [
                'error' => $error, 
                'old' => old(),
            ];

            if (isset($data)) {
                $options = array_merge($options, ['data' => $data]);
            }
        @endphp
        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (Route::current()->uri == 'categories/{category}/edit') @method('PUT') @endif
            
            <div class="category-input-wrapper flex gap-4 mb-5">
                <section class="left-side relative h-full w-2/5 border border-[#eee] rounded-xl overflow-auto p-4">
                    @include('admin.category.includes.input.image-input')
                </section>
                <section class="right-side relative w-3/5 border border-[#eee] rounded-xl overflow-auto p-4">
                    @livewire('admin.category.form-input', $options)
                </section>
            </div>
            <div class="form-button text-right">
                <button class="h-10 w-full max-w-[20%] bg-[#0079c2] text-white rounded py-2 px-4">Submit</button>
            </div>
        </form>
    </section>
</div>
@endsection

@section('scripts')
    @include('admin.category.js.admin-category-main-js')
@endsection