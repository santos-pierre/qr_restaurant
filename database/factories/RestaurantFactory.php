<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

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
        ];
    }
}
