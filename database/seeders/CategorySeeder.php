<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
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
        $categories = [
            [
                'name' => 'Asian',
            ],
            [
                'name' => 'Western',
            ],
            [
                'name' => 'Desserts',
            ],
        ];

        foreach ($categories as $key => $category) {
            Category::create($category);
        }
    }
}
