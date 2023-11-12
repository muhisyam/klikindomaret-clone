<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            /*#01*/['parent_id' => null, 'name' => 'Makanan', 'slug' => 'makanan', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#02*/['parent_id' => null, 'name' => 'Minuman', 'slug' => 'minuman', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#03*/['parent_id' => null, 'name' => 'Produk Segar', 'slug' => 'produk_segar', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#04*/['parent_id' => null, 'name' => 'Ibu & Anak', 'slug' => 'ibu-dan-anak', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#05*/['parent_id' => null, 'name' => 'Kesehatan & Kecantikan', 'slug' => 'kesehatan-dan-kecantikan', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#06*/['parent_id' => null, 'name' => 'Home & Living', 'slug' => 'home-and-living', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#07*/['parent_id' => null, 'name' => 'Produk Lainnya', 'slug' => 'produk-lainnya', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Makanan
            /*#08*/['parent_id' => 1, 'name' => 'Sarapan', 'slug' => 'sarapan', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#09*/['parent_id' => 1, 'name' => 'Makanan Kaleng', 'slug' => 'makanan-kaleng', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#10*/['parent_id' => 1, 'name' => 'Makanan Instan', 'slug' => 'makanan-instan', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#11*/['parent_id' => 1, 'name' => 'Cemilan & Biskuit', 'slug' => 'cemilan-biskuit', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Minuman
            /*#12*/['parent_id' => 2, 'name' => 'Susu', 'slug' => 'susu', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#13*/['parent_id' => 2, 'name' => 'Air Mineral', 'slug' => 'air-mineral', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Produk Segar
            /*#14*/['parent_id' => 3, 'name' => 'Buah & Dessert', 'slug' => 'buah-dessert', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Ibu & Anak
            /*#15*/['parent_id' => 4, 'name' => 'Mainan & Hobi', 'slug' => 'mainan-hobi', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#16*/['parent_id' => 4, 'name' => 'Makanan & Susu Bayi', 'slug' => 'makanan-susu-bayi', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#17*/['parent_id' => 4, 'name' => 'Perlengkapan Bayi', 'slug' => 'perlengkapan-bayi', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Sarapan
            /*#18*/['parent_id' => 8, 'name' => 'Sereal', 'slug' => 'sereal', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#19*/['parent_id' => 8, 'name' => 'Madu', 'slug' => 'madu', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#20*/['parent_id' => 8, 'name' => 'Selai & Olesan', 'slug' => 'selai-olesan', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#21*/['parent_id' => 8, 'name' => 'Roti', 'slug' => 'roti', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Makanan Kaleng
            /*#22*/['parent_id' => 9, 'name' => 'Buah & Sayuran Kalengan', 'slug' => 'buah-sayuran-kalengan', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Makanan Instan
            /*#23*/['parent_id' => 10, 'name' => 'Mie Instan', 'slug' => 'mie-instan', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#24*/['parent_id' => 10, 'name' => 'Pasta & Spaghetti', 'slug' => 'pasta-spaghetti', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Cemilan & Biskuit
            /*#25*/['parent_id' => 11, 'name' => 'Biskuit', 'slug' => 'biskuit', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#26*/['parent_id' => 11, 'name' => 'Kacang Kacangan', 'slug' => 'kacangan', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#27*/['parent_id' => 11, 'name' => 'Wafer', 'slug' => 'wafer', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Susu
            /*#28*/['parent_id' => 12, 'name' => 'Susu Cair', 'slug' => 'susu-cair', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#29*/['parent_id' => 12, 'name' => 'Susu Bubuk', 'slug' => 'susu-bubuk', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#30*/['parent_id' => 12, 'name' => 'Susu Evaporasi', 'slug' => 'susu-evaporasi', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Air Mineral
            /*#31*/['parent_id' => 13, 'name' => 'Mineral Water', 'slug' => 'mineral-water', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Buah & Dessert
            /*#32*/['parent_id' => 14, 'name' => 'Buah Segar', 'slug' => 'buah-segar', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#33*/['parent_id' => 14, 'name' => 'Dessert', 'slug' => 'dessert', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            //      Buah & Dessert
            /*#34*/['parent_id' => 15, 'name' => 'Baby Toys', 'slug' => 'baby-toys', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
            /*#35*/['parent_id' => 15, 'name' => 'Bricks & Block', 'slug' => 'bricks-block', 'image_name' => null, 'original_image_name' => null, 'created_at' => now()],
        ];

        Category::insert($data);
    }
}
