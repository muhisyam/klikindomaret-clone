@extends('admin.index')

@section('title')
Input Kategori
@endsection

@section('content')
<div class="category-input">
    <div class="category-input-content flex gap-4">
        <section class="left-side h-full w-2/5">
            <h1 class="title text-[#0079c2] text-xl font-bold mb-4">List Kategori</h1>
            <div class="list-category-wrapper border border-[#eee] rounded-xl overflow-auto p-4">
                @include('admin.category.includes.input.list-category')
            </div>
        </section>
        <section class="right-side w-3/5">
            <h1 class="title text-[#0079c2] text-xl font-bold mb-4">Input Kategori</h1>
            <form action="">
                <div class="category-input-wrapper relative border border-[#eee] rounded-xl p-4 mb-5">
                    @include('admin.category.includes.input.form-input')
                </div>
                <div class="form-button text-right">
                    <button class="h-10 w-full max-w-[20%] bg-[#0079c2] text-white rounded py-2 px-4 disabled">Submit</button>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection

@section('scripts')
    @include('admin.category.js.admin-category-main-js')
@endsection