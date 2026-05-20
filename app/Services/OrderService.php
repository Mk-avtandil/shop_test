<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder(array $data, array $products): Order
    {
        return DB::transaction(function () use ($data, $products) {
            $order = Order::create([
                'user_id'     => $data['user_id'],
                'total_price' => 0,
                'status'      => $data['status'],
            ]);

            $syncData = [];
            $total = 0;

            foreach ($products as $productId => $qty) {
                if ($qty <= 0) {
                    continue;
                }

                $product = Product::lockForUpdate()->find($productId);

                if (!$product) {
                    throw new \Exception("Product with ID {$productId} not found.");
                }

                if ($product->stock < $qty) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                $product->stock -= $qty;
                $product->save();

                $syncData[$productId] = [
                    'quantity' => $qty,
                    'price'    => $product->price,
                ];

                $total += $product->price * $qty;
            }

            $order->products()->sync($syncData);

            $order->update([
                'total_price' => $total
            ]);

            return $order;
        });
    }
}
