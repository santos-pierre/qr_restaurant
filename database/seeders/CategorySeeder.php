<?php

namespace Database\Seeders;

use App\Models\Category;
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
                ->create([
                    'name' => 'starters',
                     'slug' => 'starters'
                ]);
        Category::factory()
                ->create([
                    'name' => 'trends',
                    'slug' => 'trends'
                ]);
        Category::factory()
                ->create([
                    'name' => 'mains',
                    'slug' => 'mains'
                ]);
        Category::factory()
                ->create([
                    'name' => 'desserts',
                    'slug' => 'desserts'
                ]);
    }
}
