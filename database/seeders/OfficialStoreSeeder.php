<?php

namespace Database\Seeders;

use App\Models\OfficialStore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficialStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfficialStore::factory(46)->create();
    }
}
