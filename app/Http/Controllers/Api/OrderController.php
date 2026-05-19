<?php

namespace App\Http\Controllers\Api;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Product;
use App\Models\Order;

class OrderController
{
    public function index(): LengthAwarePaginator
    {
        return Order::with(['user', 'products'])->paginate(5);
    }

    public function store(StoreOrderRequest $request): Order
    {
        $data = $request->validated();

        $order = Order::create([
            'user_id' => $data['user_id'],
            'status' => $data['status'],
            'total_price' => 0,
        ]);

        $syncData = [];
        $total = 0;

        foreach ($request->products as $productId => $qty) {

            $product = Product::find($productId);

            $syncData[$productId] = [
                'quantity' => $qty,
                'price' => $product->price,
            ];

            $total += $product->price * $qty;
        }

        $order->products()->sync($syncData);

        $order->update([
            'total_price' => $total
        ]);

        return $order->load('products');
    }

    public function show(Order $order): Order
    {
        return $order;
    }

    public function update(UpdateOrderRequest $request, Order $order): Order
    {
        $order->update($request->validated());

        return $order;
    }

    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json([
            'message' => 'Deleted successfully',
        ]);
    }
}
