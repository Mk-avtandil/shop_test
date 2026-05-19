@extends('layouts.app')

@section('title', 'Create Order')

@section('content')
    <div class="container w-50 m-auto">
        <h1>Create New Order</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="user_id">Users</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select User</option>

                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="total_price">Total price</label>
                <input type="text" name="total_price" id="total_price" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <select name="status" id="status" class="form-control" required>
                    <option value="">Status</option>
                    <option value="ending">ending</option>
                    <option value="processing">processing</option>
                    <option value="shipped">shipped</option>
                    <option value="delivered">delivered</option>
                    <option value="cancelled">cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save Order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
