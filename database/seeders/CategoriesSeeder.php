<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::create(['name' => 'Minuman']);
        Categories::create(['name' => 'Makanan']);
        Categories::create(['name' => 'Permen']);
        Categories::create(['name' => 'Pangan']);
        Categories::create(['name' => 'Sabun']);
    }
}
