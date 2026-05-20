<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['user', 'products'])->paginate(5);

        return view('orders.index', ['orders' => $orders]);
    }

    public function create(): View
    {
        $users = User::all();
        $products = Product::all();

        return view('orders.create', ['users' => $users, 'products' => $products]);
    }

    public function store(StoreOrderRequest $request, OrderService $orderService)
    {
        try {
            $orderService->createOrder(
                $request->validated(),
                $request->input('products', [])
            );

            return redirect()->route('orders.index')
                ->with('success', 'Order created successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(Order $order): View
    {
        return view('orders.edit', ['order' => $order]);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }
}
