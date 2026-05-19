@extends('layouts.app')

@section('title', 'Edit Order')

@section('content')
    <div class="container w-50 m-auto">
        <h1>Edit Order</h1>

        <form action="{{ route('orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select User</option>

                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{ $user->id == $order->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="total_price">Total price</label>
                <input type="text" name="total_price" id="total_price" value="{{ $order->total_price }}"
                       class="form-control" required>
            </div>

            @php
                $statuses = [
                    'pending',
                    'processing',
                    'shipped',
                    'delivered',
                    'cancelled'
                ];
            @endphp

            <div class="form-group mb-3">
                <select name="status" id="status" class="form-control" required>
                    <option value="">Status</option>

                    @foreach($statuses as $status)
                        <option value="{{ $status }}"
                            {{ $order->status == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
