<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        return Product::paginate(10);
    }

    public function store(StoreProductRequest $request): Product
    {
        return Product::create($request->validated());
    }

    public function show(Product $product): Product
    {
        return $product;
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(UpdateProductRequest $request, Product $product): Product
    {
        $product->update($request->validated());

        return $product;
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'message' => 'Deleted successfully',
        ]);
    }
}
