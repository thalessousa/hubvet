<?php

namespace Database\Factories;

use App\Models\Sector;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectorFactory extends Factory
{
    protected $model = Sector::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text(),
            'aisle' => $this->faker->randomDigitNotZero(),
            'store_id' => Store::factory(),
            'price' => $this->faker->numberBetween(1, 25),
            'stock' => $this->faker->numberBetween(10, 100),
        ];
    }
}
