<?php

namespace App\Http\Controllers\Api;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Category;

class CategoryController
{
    // TODO: HTTP статус коды пока не добавлены, laravel возвращает их автоматически
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
