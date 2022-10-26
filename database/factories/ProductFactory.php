<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text(),
            'sector_id' => Sector::factory(),
            'price' => $this->faker->numberBetween(1, 25),
            'stock' => $this->faker->numberBetween(10, 100),
            'supplier' => $this->faker->word,
        ];
    }
}
