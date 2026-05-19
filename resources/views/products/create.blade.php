@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="container w-50 m-auto">
        <h1>Create New Product</h1>

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4" class="form-control"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="stock">Stock</label>
                <input type="text" name="stock" id="stock" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Save Category</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
