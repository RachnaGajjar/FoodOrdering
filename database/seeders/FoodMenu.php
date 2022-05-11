<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FoodMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $menus = [
            ['title' => 'FoodMenu', 'parent_id' => 0, 'sort_order' => 0, 'slug' => '/'],
            ['title' => 'Panjabi', 'parent_id' => 1, 'sort_order' => 1, 'slug' => '/pages'],
            ['title' => 'Gujrati', 'parent_id' => 1, 'sort_order' => 2, 'slug' => '/our-services'],
            ['title' => 'South Indian', 'parent_id' => 1, 'sort_order' => 3, 'slug' => '/about'],
            ['title' => 'Dosa', 'parent_id' => 4, 'sort_order' => 3, 'slug' => '/about-team'],
            ['title' => 'Thali', 'parent_id' => 3, 'sort_order' => 3, 'slug' => '/about-clients'],
            ['title' => 'Palak Panner', 'parent_id' => 2, 'sort_order' => 3, 'slug' => '/contact-team'],

        ];
        foreach ($menus as $menu) {
            \App\Models\FoodCategory::Create($menu);
        }
    }
}
