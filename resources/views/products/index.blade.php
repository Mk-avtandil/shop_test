@extends('layouts.app')

@section('title', 'Products')

@section('content')
<h1>Products</h1>

<a class="btn btn-success" href="{{ route('products.create') }}">Create new product</a>


<table class="table w-75">
    <thead class="thead-dark">
    <tr>
        <th scope="col">id</th>
        <th scope="col">category</th>
        <th scope="col">name</th>
        <th scope="col">description</th>
        <th scope="col">price</th>
        <th scope="col">stock</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td><a href="{{ route('products.edit', $product) }}" class="btn btn-info">Edit</a></td>
            <td>
                <form action="{{ route('products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

{{ $products->links() }}
@endsection
