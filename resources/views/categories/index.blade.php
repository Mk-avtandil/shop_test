@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<h1>Categories</h1>

<a class="btn btn-success" href="{{ route('categories.create') }}">Create new category</a>

<table class="table w-75">
    <thead class="thead-dark">
    <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">description</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td><a href="{{ route('categories.edit', $category) }}" class="btn btn-info">Edit</a></td>
            <td>
                <form action="{{ route('categories.destroy', $category) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

{{ $categories->links() }}
@endsection
