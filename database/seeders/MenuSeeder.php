<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'name' => 'Chicken Rice',
                'restaurant_id' => 1,
                'description' => 'Deliciously cooked',
                'price' => 10,
            ],
            [
                'name' => 'Nasi Goreng',
                'restaurant_id' => 1,
                'description' => 'Deliciously cooked Lorem',
                'price' => 13,
            ],
            [
                'name' => 'Nasi Lemak',
                'restaurant_id' => 2,
                'description' => 'Deliciously cooked Ipsum',
                'price' => 7,
            ],
            [
                'name' => 'Roti Canai',
                'restaurant_id' => 3,
                'description' => 'Deliciously cooked Ipsum',
                'price' => 7,
            ],
        ];

        foreach ($menus as $key => $menu) {
            Menu::create($menu);
        }
    }
}
