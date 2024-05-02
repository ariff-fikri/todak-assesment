<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'Admin1234',
                'role' => 'admin',
            ],
            [
                'name' => 'Restaurant Manager 1',
                'email' => 'manager1@gmail.com',
                'password' => 'Manager1234',
                'role' => 'restaurant_manager',
            ],
            [
                'name' => 'Restaurant Manager 2',
                'email' => 'manager2@gmail.com',
                'password' => 'Manager1234',
                'role' => 'restaurant_manager',
            ],
            [
                'name' => 'Restaurant Manager 3',
                'email' => 'manager3@gmail.com',
                'password' => 'Manager1234',
                'role' => 'restaurant_manager',
            ],
            [
                'name' => 'Customer 1',
                'email' => 'customer1@gmail.com',
                'password' => 'Customer1234',
                'role' => 'customer',
            ],
        ];

        foreach ($admins as $key => $admin) {
            $user = User::create($admin);
        }
    }
}
