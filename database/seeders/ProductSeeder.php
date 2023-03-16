<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => 2,
            'name' => 'Le Minerale',
            'price' => 3000,
            'barcode' => "8996001600269",
            'qty' => 300
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Beng-Beng',
            'price' => 2500,
            'barcode' => "8996001354124",
            'qty' => 500
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Coca Cola',
            'price' => 5000,
            'barcode' => "8999979041942",
            'qty' => 100
        ]);

        Product::create([
            'category_id' => 4,
            'name' => 'Beras 10kg',
            'price' => 100000,
            'barcode' => "8996002255203",
            'qty' => 326
        ]);
    }
}
