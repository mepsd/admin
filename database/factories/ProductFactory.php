<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = \App\Models\Product::class;
    public function definition()
    {
        return [
            'title' => $this->faker->text(30),
            'description' => $this->faker->text(100),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
