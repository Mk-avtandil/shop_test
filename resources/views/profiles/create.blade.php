@extends('layouts.app')

@section('title', 'Create Profile')

@section('content')
    <div class="container w-50 m-auto">
        <h1>Create New Profile</h1>

        <form action="{{ route('profiles.store') }}" method="POST">
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
                <label for="phone_number">Phone number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Save Profile</button>
            <a href="{{ route('profiles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
