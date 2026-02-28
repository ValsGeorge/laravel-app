<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Devices, gadgets, and electronic accessories including phones, laptops, and audio equipment.'
            ],
            [
                'name' => 'Furniture',
                'description' => 'Home and office furniture such as desks, chairs, sofas, and storage units.'
            ],
            [
                'name' => 'Groceries',
                'description' => 'Everyday food items including fresh produce, dairy products, and packaged goods.'
            ],
            [
                'name' => 'Clothing',
                'description' => 'Men’s, women’s, and children’s apparel including casual and formal wear.'
            ],
            [
                'name' => 'Books',
                'description' => 'Fiction, non-fiction, educational materials, and reference books.'
            ],
            [
                'name' => 'Sports Equipment',
                'description' => 'Gear and accessories for indoor and outdoor sports activities.'
            ],
            [
                'name' => 'Beauty & Personal Care',
                'description' => 'Cosmetics, skincare products, and personal hygiene essentials.'
            ],
            [
                'name' => 'Automotive',
                'description' => 'Car accessories, maintenance tools, and vehicle-related products.'
            ],
        ];

        $category = fake()->randomElement($categories);

        return [
            'name' => $category['name'],
            'description' => $category['description'],
            'user_id' => 3,
            'is_active' => 1,
        ];
    }
}
