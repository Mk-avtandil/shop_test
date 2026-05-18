<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        return Order::paginate(10);
    }

    public function store(StoreOrderRequest $request): Order
    {
        return Order::create($request->validated());
    }

    public function show(Order $order): Order
    {
        return $order;
    }

    public function edit(Order $order)
    {

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
