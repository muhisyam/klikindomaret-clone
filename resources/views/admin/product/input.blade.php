@extends('admin.index')

@section('title')
Input Produk
@endsection

@section('content')
<div class="product-input">
    <div class="product-input-content">
        @php
            $data = [
                'pagename' => 'Tambah Produk',
                'breadcrumb_pages' => [
                    [
                        'info' => 'first',
                        'label' => 'Produk', 
                        'link' => 'product'
                    ],
                    [
                        'info' => 'last',
                        'label' => 'Tambah Produk'
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
                    <h1 class="font-bold">Tambah Produk Baru</h1>
                    <div class="error-info-wrapper flex text-red-600 text-sm ms-3">
                        <div class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></div>
                        <div class="message">Form tidak valid!</div>
                    </div>
                </div>
                <div class="text-sm form-info">5 Form belum terisi</div>
            </div>
        </section>
        <form class="form-input-wrapper" action="">
            <div class="product-input-wrapper flex gap-4 mb-5">
                <section class="left-side relative w-2/5 border border-[#eee] rounded-xl p-4">
                    @include('admin.product.includes.input.image-input')
                </section>
                <section class="right-side relative w-3/5 border border-[#eee] rounded-xl overflow-auto p-4">        
                    @include('admin.product.includes.input.form-input')
                </section>
            </div>
            <div class="form-button flex justify-end">
                <button type="button" class="h-10 flex items-center border border-[#0079c2] bg-white text-[#0079c2] rounded py-2 px-4 me-2">
                    <div class="icon h-6 me-1"><i class="ri-eye-fill"></i></div>
                    <div class="text">Preview</div>
                </button>
                <button class="h-10 w-full max-w-[20%] bg-[#0079c2] text-white rounded py-2 px-4 disabled">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@include('admin.product.js.admin-product-main-js')
@endsection