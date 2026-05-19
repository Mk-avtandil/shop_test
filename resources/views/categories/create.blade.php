@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="container w-50 m-auto">
        <h1>Create New Category</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Save Category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
