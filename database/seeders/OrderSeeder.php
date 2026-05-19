<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => 0,
                'status' => 'pending',
            ]);

            $total = 0;

            $randomProducts = $products->random(2);

            foreach ($randomProducts as $product) {

                if ($product->stock <= 0) {
                    continue;
                }

                $quantity = rand(1, min(3, $product->stock));

                $product->decrement('stock', $quantity);

                $order->products()->attach($product->id, [
                    'quantity' => $quantity,
                ]);

                $total += $product->price * $quantity;
            }

            $order->update([
                'total_price' => $total,
            ]);
        }
    }
}
