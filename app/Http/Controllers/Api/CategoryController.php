<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController
{
    public function index(): LengthAwarePaginator
    {
        return Category::paginate(5);
    }

    public function store(StoreCategoryRequest $request): Category
    {
        return Category::create($request->validated());
    }

    public function show(Category $category): Category
    {
        return $category;
    }

    public function update(UpdateCategoryRequest $request, Category $category): Category
    {
        $category->update($request->validated());

        return $category;
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json([
            'message' => 'Deleted successfully',
        ]);
    }
}
