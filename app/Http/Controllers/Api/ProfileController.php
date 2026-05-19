<?php

namespace App\Http\Controllers\Api;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\StoreProfileRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Profile;

class ProfileController
{
    public function index(): LengthAwarePaginator
    {
        return Profile::paginate(5);
    }

    public function store(StoreProfileRequest $request): Profile
    {
        return Profile::create($request->validated());
    }

    public function show(Profile $profile): Profile
    {
        return $profile;
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
