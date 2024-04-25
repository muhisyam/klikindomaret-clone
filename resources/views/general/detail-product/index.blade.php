<x-general-layout class="space-y-6">    
    <ol class="inline-flex items-center text-sm">
        <li class="inline-flex items-center text-light-gray-300">
            <a href="#" class="inline-flex items-center hover:text-secondary">
            Beranda
            </a>
        </li>
        <li>
            <div class="flex items-center text-light-gray-300">
                <i class="ri-arrow-right-s-line mx-2"></i>
                <a href="#" class="hover:text-secondary">Makanan</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i class="ri-arrow-right-s-line text-light-gray-300 mx-2"></i>
                <span class="text-black">Sarapan</span>
            </div>
        </li>
    </ol>

    <livewire:general.detail-product.product-info :section="$section"/>

</x-general-layout>