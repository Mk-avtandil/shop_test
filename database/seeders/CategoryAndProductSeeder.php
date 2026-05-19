<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryAndProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronics description',
                'products' => [
                    [
                        'name' => 'iPhone 15',
                        'price' => 1200,
                        'stock' => 10,
                    ],
                    [
                        'name' => 'Sony TV',
                        'price' => 900,
                        'stock' => 5,
                    ],
                ],
            ],
            [
                'name' => 'Books',
                'description' => 'Books description',
                'products' => [
                    [
                        'name' => 'Laravel doc',
                        'price' => 30,
                        'stock' => 100,
                    ],
                    [
                        'name' => 'PHP Basics',
                        'price' => 25,
                        'stock' => 80,
                    ],
                ],
            ],
            [
                'name' => 'Cars',
                'description' => 'Cars description',
                'products' => [
                    [
                        'name' => 'BMW X5',
                        'price' => 50000,
                        'stock' => 2,
                    ],
                    [
                        'name' => 'Tesla Model 3',
                        'price' => 45000,
                        'stock' => 3,
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $products = $categoryData['products'];
            unset($categoryData['products']);

            $category = Category::create($categoryData);

            foreach ($products as $product) {
                $category->products()->create($product);
            }
        }
    }
}
