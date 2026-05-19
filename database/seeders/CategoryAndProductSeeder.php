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
                        'description' => 'iPhone 15 description',
                        'price' => 1200,
                        'stock' => 10,
                    ],
                    [
                        'name' => 'Sony TV',
                        'description' => 'Sony TV description',
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
                        'description' => 'Laravel doc description',
                        'price' => 30,
                        'stock' => 100,
                    ],
                    [
                        'name' => 'PHP Basics',
                        'description' => 'PHP Basics description',
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
                        'description' => 'BMW X5 description',
                        'price' => 50000,
                        'stock' => 2,
                    ],
                    [
                        'name' => 'Tesla Model 3',
                        'description' => 'Tesla Model 3 description',
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
