@extends('admin.index')

@section('title')
Tambah Kategori
@endsection

@section('content')
<div class="category-input">
    <div class="category-input-content">
        @php
            $data = [
                'pagename' => 'Tambah Kategori',
                'breadcrumb_pages' => [
                    [
                        'info' => 'first',
                        'label' => 'Kategori', 
                        'link' => 'category'
                    ],
                    [
                        'info' => 'next',
                        'label' => 'Kategori Induk', 
                        'link' => 'category/input'
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
        @include('admin.components.header', ['data' => $data])
        <section class="progress-info-wrapper border border-[#eee] rounded-xl overflow-hidden mb-4">
            <div class="progress-bar-wrapper flex gap-[2px]">
                <div class="h-1.5 -skew-x-[24deg] w-full bg-[#f9c828]"></div>
                <div class="h-1.5 -skew-x-[24deg] w-full bg-[#f9c828]"></div>
                <div class="h-1.5 -skew-x-[24deg] w-full bg-[#f9c828]"></div>
                <div class="h-1.5 -skew-x-[24deg] w-full bg-[#eee]"></div>
                <div class="h-1.5 -skew-x-[24deg] w-full bg-[#eee]"></div>
                <div class="h-1.5 -skew-x-[24deg] w-full bg-[#eee]"></div>
                <div class="h-1.5 -skew-x-[24deg] w-full bg-[#eee]"></div>
                <div class="h-1.5 -skew-x-[24deg] w-full bg-[#eee]"></div>
            </div>
            <div class="progress-info-content flex items-center justify-between p-4">
                <h1 class="font-bold">Tambah Kategori Induk Baru</h1>
                <div class="text-sm form-info">5 Form belum terisi</div>
            </div>
            <div class="error-info bg-red-200 flex py-2 px-4">
                <div class="icon h-6 text-[#c33] text-xl me-3"><i class="ri-error-warning-fill"></i></div>
                <div class="info">
                    <div class="label font-bold pt-0.5">Error !</div>
                    {{-- <ul class="list-disc text-sm ms-5">
                        <li>Input masih kosong</li>
                        <li>Password tidak sama</li>
                    </ul> --}}
                </div>
                <button class="h-6 ms-auto">
                    <div class="icon text-xl"><i class="ri-arrow-up-s-line"></i></div>
                </button>
            </div>
        </section>
        <form action="">
            <div class="category-input-wrapper flex gap-4 mb-5">
                <section class="left-side relative h-full w-2/5 border border-[#eee] rounded-xl overflow-auto p-4">
                    @include('admin.category.includes.input.image-input')
                </section>
                <section class="right-side relative w-3/5 border border-[#eee] rounded-xl p-4">
                    @include('admin.category.includes.input.form-input')
                </section>
            </div>
            <div class="form-button text-right">
                <button class="h-10 w-full max-w-[20%] bg-[#0079c2] text-white rounded py-2 px-4 disabled">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    @include('admin.category.js.admin-category-main-js')
@endsection