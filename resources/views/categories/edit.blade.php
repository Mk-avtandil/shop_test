@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="container w-50 m-auto">
        <h1>Edit Category</h1>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
            </div>


            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="form-control">{{ $category->description }}
                </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
