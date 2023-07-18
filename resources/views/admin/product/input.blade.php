@extends('admin.index')

@section('title')
Input Produk
@endsection

@section('content')
<div class="product-input">
    <div class="product-input-content">
        <h1 class="title text-[#0079c2] text-xl font-bold mb-4">Tambah Produk</h1>
        <form action="">
            <div class="product-input-wrapper flex gap-4 mb-5">
                <section class="left-side relative w-2/5 border border-[#eee] rounded-xl p-4">
                    @include('admin.product.includes.input.image-input')
                </section>
                <section class="right-side relative w-3/5 border border-[#eee] rounded-xl overflow-auto p-4">        
                    @include('admin.product.includes.input.form-input')
                </section>
            </div>
            <div class="form-button text-right">
                <button class="h-10 w-full max-w-[20%] bg-[#0079c2] text-white rounded py-2 px-4 disabled">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection