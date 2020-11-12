<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Restaurant::factory()
                ->times(2)
                ->create();
        // $products = Restaurant::find(1)->products();
        // $categories = Restaurant::find(1)->categories();
    }
}
