@extends('admin.index')

@section('title')
Input Kategori
@endsection

@section('content')
<div class="category-input">
    <div class="category-input-content flex gap-8">
        <section class="category-input-wrapper w-4/6 border border-[#eee] rounded-xl p-4">
            @include('admin.category.includes.input.input-category')
        </section>
        <section class="list-category-wrapper w-2/6 border border-[#eee] rounded-xl p-4">
            @include('admin.category.includes.input.list-category')
        </section>
    </div>
</div>
@endsection

@section('scripts')
    @include('admin.category.js.admin-category-main-js')
@endsection