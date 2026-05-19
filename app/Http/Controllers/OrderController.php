<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('user')->paginate(5);

        return view('orders.index', ['orders' => $orders]);
    }

    public function create(): View
    {
        $users = User::all();

        return view('orders.create', ['users' => $users]);
    }

    public function store(StoreOrderRequest $request)
    {
        Order::create($request->validated());

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order created successfully');
    }

    public function edit(Order $order): View
    {
        $users = User::all();

        return view('orders.edit', ['order' => $order, 'users' => $users]);
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
