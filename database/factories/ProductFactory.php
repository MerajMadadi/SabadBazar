<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->numberBetween(5000, 50000),
            'stock' => $this->faker->numberBetween(10, 200),
            'unit' => $this->faker->numberBetween(100,2000).'گرم',
            'discount' => $this->faker->numberBetween(0,100),
            'category_id' => 1,
            'image_url' => null,
            'user_id' => 1,
            'created_at' => now(),
        ];
    }
}
