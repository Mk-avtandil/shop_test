@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="container w-50 m-auto">
        <h1>Edit Profile</h1>

        <form action="{{ route('profiles.update', $profile) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select User</option>

                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{ $user->id == $profile->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="phone_number">Phone number</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ $profile->phone_number }}"  class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ route('profiles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
