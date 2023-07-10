@extends('admin.index')

@section('title')
Input Kategori
@endsection

@section('content')
<div class="category-input">
    <div class="category-input-content flex gap-8">
        <section class="category-input-wrapper w-4/6 border border-[#eee] rounded-xl p-4">
            <h1 class="title text-[#0079c2] text-xl font-bold mb-4">Input Kategori</h1>
            <form action="">
                <div class="item-input-group flex items-center gap-4 mb-4">
                    <label for="form-select-level" class="w-1/4 text-[#959595]">Level Kategori</label>
                    <select id="form-select-level" name="" class="w-3/4 border !border-[#CCC] rounded py-2 px-3 focus:ring-transparent">
                        <option value="" selected>Pilih level...</option>
                        <option value="">Level 1</option>
                        <option value="">Level 2</option>
                        <option value="">Level 3</option>
                    </select>
                </div>
                <div class="item-input-group flex items-center gap-4 mb-4">
                    <label for="form-select-level" class="w-1/4 text-[#959595]">Induk Kategori</label>
                    <select id="form-select-level" name="" class="w-3/4 border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
                        <option value="" selected>Pilih induk...</option>
                        <option value="">Makanan</option>
                        <option value="">Minuman</option>
                    </select>
                </div>
                <div class="item-input-group flex items-center gap-4 mb-4">
                    <label for="form-input-first-name" class="w-1/4 text-[#959595]">Nama Kategori</label>
                    <input id="form-input-first-name" type="text" name="first-name"" class="w-3/4 border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
                </div>
                <div class="item-input-group flex items-center gap-4 mb-4">
                    <label for="form-input-first-name" class="w-1/4 text-[#959595]">Slug</label>
                    <input id="form-input-first-name" type="text" name="first-name"" class="w-3/4 border !border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
                </div>
                <div class="item-input-group flex items-center gap-4 mb-4">
                    <label for="form-input-first-name" class="w-1/4 text-[#959595]">Gambar Icon Kategori</label>
                    <input type="file" name="" id="" class="py-2">
                </div>
                <div class="form-button flex gap-4">
                    <div class="w-1/4"></div>
                    <button class="w-full max-w-[35%] bg-[#0079C2] text-white rounded py-2 px-4 disabled">Submit</button>
                </div>
            </form>
        </section>
        <section class="list-category-wrapper w-2/6 border border-[#eee] rounded-xl p-4">
            <h1 class="title text-[#0079c2] text-xl font-bold mb-4">List Kategori</h1>
            <div class="item-category">
                <div class="accordion-category-heading">
                    <button class="w-full flex items-center justify-between text-[#313131] border-b border-[#ccc] pb-2" type="button" data-accordion-target="makanan" aria-expanded="true" aria-controls="accordion-body">
                        <span>Makanan</span>
                        <i class="ri-arrow-down-s-line text-[#0079C2] duration-300"></i>
                    </button>
                </div>
                <div id="makanan" class="accordion-category-content overflow-hidden border-b border-[#ccc] py-2 mb-5" aria-labelledby="accordion-category-heading">
                    <ul class="list-subcategory text-sm">
                        <li class="item-subcategory py-1.5">
                            <div class="ms-4 text-sm">Sarapan</div>
                            <ul class="list-subcategory text-sm">
                                <li class="item-subcategory py-1.5">
                                    <div class="ms-4 text-sm">Sereal</div>
                                </li>
                                <li class="item-subcategory py-1.5">
                                    <div class="ms-4 text-sm">Madu</div>
                                </li>
                                <li class="item-subcategory py-1.5">
                                    <div class="ms-4 text-sm">Olesan</div>
                                </li>
                            </ul>
                        </li>
                        <li class="item-subcategory py-1.5">
                            <div class="ms-4 text-sm">Sarapan</div>
                        </li>
                        <li class="item-subcategory py-1.5">
                            <div class="ms-4 text-sm">Sarapan</div>
                        </li>
                        <li class="item-subcategory py-1.5">
                            <div class="ms-4 text-sm">Sarapan</div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection