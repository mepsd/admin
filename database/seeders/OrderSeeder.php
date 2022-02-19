<?php

namespace Database\Seeders;

use App\Models\Product;
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
        \App\Models\Order::factory()->count(30)->create()
            ->each(function ($order) {
                $product=Product::find(rand(1, 20));
                \App\Models\OrderItem::factory()->count(rand(1, 3))->create([
                    'price' => $product->price,
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                    'quatity' => rand(1, 10),
                ]);
            });

        //
    }
}
