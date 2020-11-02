<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(3);

        return [
            'name' => $name,
            'slug' => Str::of($name)->slug('-'),
            'description' => $this->faker->text(150),
            'price' => $this->faker->randomFloat(2,5, 25),
        ];
    }
}
