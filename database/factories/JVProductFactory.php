<?php

namespace Josmarh\JVZooIPN\Database\Factories;

use Josmarh\JVZooIPN\Models\JVProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<JVProduct>
 */
class JVProductFactory extends Factory
{
    protected $model = JVProduct::class;

    public function definition()
    {
        return [
            'product_id' => Str::random(10),
            'product_name' => $this->faker->word(),
            'access_level' => $this->faker->numberBetween(1, 5),
        ];
    }
}