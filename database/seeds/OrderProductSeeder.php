<?php

use App\Order;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 1000;

        $products = Product::all();
        $orders = Order::all();

        for ($orderId = 1; $orderId <= $limit; $orderId++) {
            $pLimit = rand(1,4);
            $order = $orders->where('id', $orderId)->first();

            for ($productsOrderCnt = 1; $productsOrderCnt <= $pLimit; $productsOrderCnt++) {
                $product = $products->random();
                DB::table('order_products')->insert([
                    'order_id' => $orderId,
                    'product_id' => $product->id,
                    'quantity' => rand(1,3),
                    'price' => $product->price,
                    'created_at' => $order->created_at,
                    'updated_at' => $order->updated_at,
                ]);
            }
        }
    }
}
