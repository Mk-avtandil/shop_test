<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\StoreProfileRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(): View
    {
        $profiles = Profile::with('user')->paginate(5);

        return view('profiles.index', ['profiles' => $profiles]);
    }

    public function create(): View
    {
        $users = User::doesntHave('profile')->get();

        return view('profiles.create', ['users' => $users]);
    }

    public function store(StoreProfileRequest $request)
    {
        Profile::create($request->validated());

        return redirect()
            ->route('profiles.index')
            ->with('success', 'Profile created successfully');
    }

    public function edit(Profile $profile): View
    {
        $users = User::all();

        return view('profiles.edit', ['profile' => $profile, 'users' => $users]);
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $profile->update($request->validated());

        return redirect()
            ->route('profiles.index')
            ->with('success', 'Profile updated successfully');
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect()
            ->route('profiles.index')
            ->with('success', 'Profile deleted successfully');
    }
}
