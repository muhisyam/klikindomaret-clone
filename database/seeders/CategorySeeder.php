<?php

namespace Database\Seeders;

use App\Enums\DeployStatus;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createParentCategory();

        Category::factory(63)
            ->state(['parent_id' => Category::where('parent_id', null)->inRandomOrder()->first()->id])
            ->hasChildren(rand(3, 12))
            ->create();
    }

    private function createParentCategory()
    {
        $data = [
            ['parent_id' => null, 'category_name' => 'Makanan', 'category_slug' => 'makanan', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => '1708950007.webp', 'original_category_image_name' => '1708950007.webp', 'model_type' => 'category', 'created_at' => now()],
            ['parent_id' => null, 'category_name' => 'Minuman', 'category_slug' => 'minuman', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => '1708950406.webp', 'original_category_image_name' => '1708950406.webp', 'model_type' => 'category', 'created_at' => now()],
            ['parent_id' => null, 'category_name' => 'Produk Segar', 'category_slug' => 'produk-segar', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => '1708950472.webp', 'original_category_image_name' => '1708950472.webp', 'model_type' => 'category', 'created_at' => now()],
            ['parent_id' => null, 'category_name' => 'Ibu & Anak', 'category_slug' => 'ibu-dan-anak', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => '1708950492.webp', 'original_category_image_name' => '1708950492.webp', 'model_type' => 'category', 'created_at' => now()],
            ['parent_id' => null, 'category_name' => 'Kesehatan & Kecantikan', 'category_slug' => 'kesehatan-dan-kecantikan', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => '1708950550.webp', 'original_category_image_name' => '1708950550.webp', 'model_type' => 'category', 'created_at' => now()],
            ['parent_id' => null, 'category_name' => 'Home & Living', 'category_slug' => 'home-and-living', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => '1708950574.webp', 'original_category_image_name' => '1708950574.webp', 'model_type' => 'category', 'created_at' => now()],
            ['parent_id' => null, 'category_name' => 'Produk Lainnya', 'category_slug' => 'produk-lainnya', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => '1708950663.webp', 'original_category_image_name' => '1708950663.webp', 'model_type' => 'category', 'created_at' => now()],
        ];

        Category::insert($data);
    }

    private function template()
    {
        $data = [
            /*01*/['parent_id' => null, 'category_name' => 'Makanan', 'category_slug' => 'makanan', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*02*/['parent_id' => null, 'category_name' => 'Minuman', 'category_slug' => 'minuman', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*03*/['parent_id' => null, 'category_name' => 'Produk Segar', 'category_slug' => 'produk_segar', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*04*/['parent_id' => null, 'category_name' => 'Ibu & Anak', 'category_slug' => 'ibu-dan-anak', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*05*/['parent_id' => null, 'category_name' => 'Kesehatan & Kecantikan', 'category_slug' => 'kesehatan-dan-kecantikan', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*06*/['parent_id' => null, 'category_name' => 'Home & Living', 'category_slug' => 'home-and-living', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*07*/['parent_id' => null, 'category_name' => 'Produk Lainnya', 'category_slug' => 'produk-lainnya', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Makanan
            /*08*/['parent_id' => 1, 'category_name' => 'Sarapan', 'category_slug' => 'sarapan', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*09*/['parent_id' => 1, 'category_name' => 'Makanan Kaleng', 'category_slug' => 'makanan-kaleng', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*10*/['parent_id' => 1, 'category_name' => 'Makanan Instan', 'category_slug' => 'makanan-instan', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*11*/['parent_id' => 1, 'category_name' => 'Cemilan & Biskuit', 'category_slug' => 'cemilan-biskuit', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Minuman
            /*12*/['parent_id' => 2, 'category_name' => 'Susu', 'category_slug' => 'susu', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*13*/['parent_id' => 2, 'category_name' => 'Air Mineral', 'category_slug' => 'air-mineral', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Produk Segar
            /*14*/['parent_id' => 3, 'category_name' => 'Buah & Dessert', 'category_slug' => 'buah-dessert', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Ibu & Anak
            /*15*/['parent_id' => 4, 'category_name' => 'Mainan & Hobi', 'category_slug' => 'mainan-hobi', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*16*/['parent_id' => 4, 'category_name' => 'Makanan & Susu Bayi', 'category_slug' => 'makanan-susu-bayi', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*17*/['parent_id' => 4, 'category_name' => 'Perlengkapan Bayi', 'category_slug' => 'perlengkapan-bayi', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Sarapan
            /*18*/['parent_id' => 8, 'category_name' => 'Sereal', 'category_slug' => 'sereal', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*19*/['parent_id' => 8, 'category_name' => 'Madu', 'category_slug' => 'madu', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*20*/['parent_id' => 8, 'category_name' => 'Selai & Olesan', 'category_slug' => 'selai-olesan', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*21*/['parent_id' => 8, 'category_name' => 'Roti', 'category_slug' => 'roti', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Makanan Kaleng
            /*22*/['parent_id' => 9, 'category_name' => 'Buah & Sayuran Kalengan', 'category_slug' => 'buah-sayuran-kalengan', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Makanan Instan
            /*23*/['parent_id' => 10, 'category_name' => 'Mie Instan', 'category_slug' => 'mie-instan', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*24*/['parent_id' => 10, 'category_name' => 'Pasta & Spaghetti', 'category_slug' => 'pasta-spaghetti', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Cemilan & Biskuit
            /*25*/['parent_id' => 11, 'category_name' => 'Biskuit', 'category_slug' => 'biskuit', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*26*/['parent_id' => 11, 'category_name' => 'Kacang Kacangan', 'category_slug' => 'kacangan', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*27*/['parent_id' => 11, 'category_name' => 'Wafer', 'category_slug' => 'wafer', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Susu
            /*28*/['parent_id' => 12, 'category_name' => 'Susu Cair', 'category_slug' => 'susu-cair', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*29*/['parent_id' => 12, 'category_name' => 'Susu Bubuk', 'category_slug' => 'susu-bubuk', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*30*/['parent_id' => 12, 'category_name' => 'Susu Evaporasi', 'category_slug' => 'susu-evaporasi', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Air Mineral
            /*31*/['parent_id' => 13, 'category_name' => 'Mineral Water', 'category_slug' => 'mineral-water', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Buah & Dessert
            /*32*/['parent_id' => 14, 'category_name' => 'Buah Segar', 'category_slug' => 'buah-segar', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*33*/['parent_id' => 14, 'category_name' => 'Dessert', 'category_slug' => 'dessert', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            //      Buah & Dessert
            /*34*/['parent_id' => 15, 'category_name' => 'Baby Toys', 'category_slug' => 'baby-toys', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
            /*35*/['parent_id' => 15, 'category_name' => 'Bricks & Block', 'category_slug' => 'bricks-block', 'category_deploy_status' => DeployStatus::PUBLISHED->value, 'category_image_name' => null, 'original_category_image_name' => null, 'model_type' => 'category', 'created_at' => now()],
        ];

        Category::insert($data);
    }
}
