<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

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
