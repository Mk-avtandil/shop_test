@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<h1>Orders</h1>

<a class="btn btn-success" href="{{ route('orders.create') }}">Create new order</a>

<table class="table w-75">
    <thead class="thead-dark">
    <tr>
        <th scope="col">id</th>
        <th scope="col">user</th>
        <th scope="col">total price</th>
        <th scope="col">status</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->total_price }}</td>
            <td>{{ $order->status }}</td>
            <td><a href="{{ route('orders.edit', $order) }}" class="btn btn-info">Edit</a></td>
            <td>
                <form action="{{ route('orders.destroy', $order) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

{{ $orders->links() }}
@endsection
