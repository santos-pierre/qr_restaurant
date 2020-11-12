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
        for ($cpt=0; $cpt < 5; $cpt++) { 
            Category::factory()
                ->hasAttached(
                    Product::factory()
                        ->count(5)
                        ->state(function (array $attributes) {
                            return ['restaurant_id' => 1];
                        }),
                )
                ->create(['restaurant_id' => 1, 'order' => $cpt]);
        }

        for ($cpt=0; $cpt < 5; $cpt++) { 
            Category::factory()
                ->hasAttached(
                    Product::factory()
                        ->count(5)
                        ->state(function (array $attributes) {
                            return ['restaurant_id' => 2];
                        }),
                )
                ->create(['restaurant_id' => 2, 'order' => $cpt]);
        }
        
    }
}
