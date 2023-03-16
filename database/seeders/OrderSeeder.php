<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::insert([
            'customer_id' => 1,
            'price' => 5000,
            'return' => 5000,
            'accept' => 10000,
            'created_at' => "2023-01-24 05:01:38",
            'updated_at' => "2023-01-24 05:01:38",
        ]);

        OrderItem::insert([
            'order_id' => 1,
            'product_id' => 3,
            'qty' => 1,
            'price' => 5000,
            'created_at' => "2023-01-24 05:01:38",
            'updated_at' => "2023-01-24 05:01:38",
        ]);

        Order::insert([
            'customer_id' => 2,
            'price' => 115000,
            'return' => 5000,
            'accept' => 120000,
            'created_at' => "2023-01-25 05:01:38",
            'updated_at' => "2023-01-25 05:01:38",
        ]);

        OrderItem::insert([
            'order_id' => 2,
            'product_id' => 3,
            'qty' => 3,
            'price' => 15000,
            'created_at' => "2023-01-25 05:01:38",
            'updated_at' => "2023-01-25 05:01:38",
        ]);
    }
}
