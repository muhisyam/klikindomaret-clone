@extends('admin.index')

@section('title')
Input Produk
@endsection

@section('content')
<div class="product-input">
        @php
            $dataHeader = [
                'pagename' => 'Tambah Produk',
                'breadcrumb_pages' => [
                    [
                        'info' => 'first',
                        'label' => 'Produk', 
                        'link' => 'products'
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
                    <h1 class="font-bold">Tambah Produk Baru</h1>
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
                $route = Route::current()->uri == 'products/{product}/edit' ? route('products.update', ['product' => $data['product_slug']]) : route('products.store');
                $error = session()->has('inputError') ? session()->get('inputError') : ['errors' => []];
                $options = [
                    'error' => $error, 
                    'old' => old(),
                ];

                if (isset($data)) {
                    $options = array_merge($options, ['data' => $data]);
                };

                // This will sending an array looks like -->   @livewire('...', ['error', 'old', 'data'])
                // And then will listen by mount fn in livewire controller
            @endphp

            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (Route::current()->uri == 'products/{product}/edit') @method('PUT') @endif

                <div class="product-input-wrapper flex gap-4 mb-5">
                    <section class="left-side relative w-2/5 border border-[#eee] rounded-xl p-4">
                        @php/*TODO: Fix update image not working with exist image*/@endphp
                        @include('admin.product.includes.input.image-input')
                    </section>
                    <section class="right-side relative w-3/5 border border-[#eee] rounded-xl overflow-auto p-4">
                        <div id="form-detail" class="block">
                            @livewire('admin.product.includes.input.form-input-detail', $options)
                        </div>
                        <div id="form-description" class="hidden"> 
                            @include('admin.product.includes.input.form-input-description')
                        </div>
                    </section>
                </div>
                <div class="form-button flex">
                    <button type="button" id="btn-form-detail" class="btn-form-switcher w-full h-10 items-center justify-center bg-tertiary text-secondary rounded py-2 hidden" data-target-form="form-detail">
                        <div class="icon h-6 me-1"><i class="ri-arrow-left-line"></i></div>
                        <div class="text">Product Details</div>
                    </button>
                    <button type="button" id="btn-form-description" class="btn-form-switcher relative w-full h-10 items-center justify-center blink-tertiary text-secondary rounded py-2 flex" data-target-form="form-description">
                        <div class="icon h-6 me-1"><i class="ri-arrow-right-line"></i></div>
                        <div class="text">Product Descriptions</div>
                        <div class="warning-field blink | absolute top-0 right-0 me-2 mt-1"><i class="ri-error-warning-fill text-danger"></i></div>
                    </button>
                    <div class="separator h-10 w-[1px] bg-[#ccc] mx-4"></div>
                    <button type="button" class="h-10 flex items-center border border-secondary bg-white text-secondary rounded py-2 px-4 me-2">
                        <div class="icon h-6 me-1"><i class="ri-eye-fill"></i></div>
                        <div class="text">Preview</div>
                    </button>
                    @php
                        //TODO: Dynamic disabled when has invalid form
                    @endphp
                    <button type="submit" id="btn-submit" class="h-10 w-full max-w-[33.7%] bg-secondary text-white rounded py-2 px-4 disabled">Submit</button>
                </div>
            </form>
        </section>
</div>
@endsection

@section('scripts')
@include('admin.product.js.admin-product-main-js')
@endsection