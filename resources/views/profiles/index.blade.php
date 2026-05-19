@extends('layouts.app')

@section('title', 'Profiles')

@section('content')
<h1>Profiles</h1>

<a class="btn btn-success" href="{{ route('profiles.create') }}">Create new profile</a>

<table class="table w-75">
    <thead class="thead-dark">
    <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">phone_number</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    @foreach($profiles as $profile)
        <tr>
            <td>{{ $profile->id }}</td>
            <td>{{ $profile->user->name }}</td>
            <td>{{ $profile->user->email }}</td>
            <td>{{ $profile->phone_number }}</td>
            <td><a href="{{ route('profiles.edit', $profile) }}" class="btn btn-info">Edit</a></td>
            <td>
                <form action="{{ route('profiles.destroy', $profile) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

{{ $profiles->links() }}
@endsection
