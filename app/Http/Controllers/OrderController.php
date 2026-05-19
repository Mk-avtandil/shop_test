<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Product;
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

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($request, $data, &$order) {

            $order = Order::create([
                'user_id' => $data['user_id'],
                'total_price' => 0,
                'status' => $data['status'],
            ]);

            $syncData = [];
            $total = 0;

            foreach ($request->products as $productId => $qty) {

                if ($qty <= 0) continue;

                $product = Product::lockForUpdate()->find($productId);

                if ($product->stock < $qty) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                $product->stock -= $qty;
                $product->save();

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
        });

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully');
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
