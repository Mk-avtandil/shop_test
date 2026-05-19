<?php

namespace App\Http\Controllers\Api;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Order;

class OrderController
{
    public function index(): LengthAwarePaginator
    {
        return Order::paginate(5);
    }

    public function store(StoreOrderRequest $request): Order
    {
        return Order::create($request->validated());
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
