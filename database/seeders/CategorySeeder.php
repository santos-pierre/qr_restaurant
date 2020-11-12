<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()
            ->hasAttached(
                Product::factory()
                    ->count(5)
                    ->state(function (array $attributes) {
                        return ['restaurant_id' => 1];
                    }),
            )
            ->count(5)
            ->create(['restaurant_id' => 1]);

        Category::factory()
            ->hasAttached(
                Product::factory()
                    ->count(5)
                    ->state(function (array $attributes) {
                        return ['restaurant_id' => 2];
                    }),
            )
            ->count(5)
            ->create(['restaurant_id' => 2]);
    }
}
