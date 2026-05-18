<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfileController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        return Profile::paginate(10);
    }

    public function store(StoreProfileRequest $request): Profile
    {
        return Profile::create($request->validated());
    }

    public function show(Profile $profile): Profile
    {
        return $profile;
    }

    public function edit(Profile $profile)
    {
        //
    }

    public function update(UpdateProfileRequest $request, Profile $profile): Profile
    {
        $profile->update($request->validated());

        return $profile;
    }

    public function destroy(Profile $profile): JsonResponse
    {
        $profile->delete();

        return response()->json([
            'message' => 'Deleted successfully',
        ]);
    }
}
