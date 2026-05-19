<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{

    public function index(): View
    {
        $products = Product::with('category')->paginate(5);

        return view('products.index', ['products' => $products]);
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('products.create', ['categories' => $categories]);
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully');
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
