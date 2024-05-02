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
        $restaurants = [
            [
                'name' => 'Coffee Bean',
                'description' => 'coffee@bean.com',
                'category_id' => 3,
                'manager_id' => 2,
            ],
            [
                'name' => 'Chicken Rice Shop',
                'description' => 'chickenrice@shop.com',
                'category_id' => 1,
                'manager_id' => 3,
            ],
            [
                'name' => 'Lamb Grill House',
                'description' => 'lambgrill@house.com',
                'category_id' => 2,
                'manager_id' => 4,
            ],
        ];

        foreach ($restaurants as $key => $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}
