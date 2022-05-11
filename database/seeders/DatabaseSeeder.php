<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      /*   User::create([
            'name' => 'Troortech Admin',
            'first_name' => 'Trootech',
            'last_name'=>'Admin',
            'email'=>'trootech@yopmail.com',
            'password'=>Hash::make('Admin@123'),
            'role'=>'Admin',
            'city_id'=>'1',
        ]);

        User::create([
            'name' => 'Troortech Admin 1',
            'first_name' => 'Trootech',
            'last_name'=>'Admin 1',
            'email'=>'trootech1@yopmail.com',
            'password'=>Hash::make('Admin@123123'),
            'role'=>'Admin',
            'city_id'=>'1',
        ]); */
        $this->call([FoodMenu::class]);
    }
}
