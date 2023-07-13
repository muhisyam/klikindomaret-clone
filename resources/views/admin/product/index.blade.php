@extends('admin.index')

@section('title')
List Produk
@endsection

@section('content')
<div class="product-list">
    <div class="product-list-content">
        <h1 class="title text-[#0079c2] text-xl font-bold mb-4">List Produk</h1>
        <div class="product-list-header flex">
            <div class="product-filter-wrapper">
                <input type="text">
            </div>
            <div class="product-input-wrapper"></div>
        </div>
    </div>
</div>
@endsection