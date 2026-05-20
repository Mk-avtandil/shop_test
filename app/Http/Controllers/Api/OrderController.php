<?php

namespace App\Http\Controllers\Api;

use App\Services\OrderService;
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

    public function store(StoreOrderRequest $request, OrderService $orderService): JsonResponse
    {
        try {
            $order = $orderService->createOrder(
                $request->validated(),
                $request->input('products', [])
            );

            return response()->json([
                'success' => true,
                'data' => $order->load('products')
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
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
