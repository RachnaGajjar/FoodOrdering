<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Models\Menu as ModelsMenu;
use Illuminate\Http\Request;

class Menu extends Controller
{

    public function getMenu()
    {
        $menu = new \App\Models\Menu;
        $menulist = $menu->tree();
        return view('FoodMenu.data')->with('menulist',$menulist);

    }


}
