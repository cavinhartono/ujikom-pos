<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FebruaryOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::insert([
            'customer_id' => 4,
            'price' => 100000,
            'return' => 0,
            'accept' => 100000,
            'created_at' => "2023-02-25 05:01:38",
            'updated_at' => "2023-02-25 05:01:38",
        ]);

        OrderItem::insert([
            'order_id' => 4,
            'product_id' => 4,
            'qty' => 1,
            'price' => 100000,
            'created_at' => "2023-02-25 05:01:38",
            'updated_at' => "2023-02-25 05:01:38",
        ]);

        Order::insert([
            'customer_id' => 5,
            'price' => 5000,
            'return' => 0,
            'accept' => 5000,
            'created_at' => "2023-02-26 05:01:38",
            'updated_at' => "2023-02-26 05:01:38",
        ]);

        OrderItem::insert([
            'order_id' => 5,
            'product_id' => 3,
            'qty' => 1,
            'price' => 5000,
            'created_at' => "2023-02-26 05:01:38",
            'updated_at' => "2023-02-26 05:01:38",
        ]);

        Order::insert([
            'customer_id' => 6,
            'price' => 5000,
            'return' => 0,
            'accept' => 5000,
            'created_at' => "2023-02-27 05:01:38",
            'updated_at' => "2023-02-27 05:01:38",
        ]);

        OrderItem::insert([
            'order_id' => 6,
            'product_id' => 3,
            'qty' => 1,
            'price' => 5000,
            'created_at' => "2023-02-27 05:01:38",
            'updated_at' => "2023-02-27 05:01:38",
        ]);

        Order::insert([
            'customer_id' => 7,
            'price' => 5000,
            'return' => 0,
            'accept' => 5000,
            'created_at' => "2023-02-28 05:01:38",
            'updated_at' => "2023-02-28 05:01:38",
        ]);

        OrderItem::insert([
            'order_id' => 7,
            'product_id' => 3,
            'qty' => 1,
            'price' => 5000,
            'created_at' => "2023-02-28 05:01:38",
            'updated_at' => "2023-02-28 05:01:38",
        ]);
    }
}
