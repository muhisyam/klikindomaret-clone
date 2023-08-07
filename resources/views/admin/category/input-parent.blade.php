@extends('admin.index')

@section('title')
Input Kategori
@endsection

@section('content')
<div class="category-input">
    <div class="category-input-content">
        @php
            $data = [
                'pagename' => 'Input Kategori',
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
                        'label' => 'Input Kategori'
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
        <section class="progress-info-wrapper">
            <div class="w-full bg-gray-200 rounded-full h-1 dark:bg-gray-700">
                <div class="bg-[#f9c828] h-1 rounded-full" style="width: 45%"></div>
            </div>
        </section>
        {{-- <form action="">
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
        </form> --}}
    </div>
</div>
@endsection

@section('scripts')
    @include('admin.category.js.admin-category-main-js')
@endsection