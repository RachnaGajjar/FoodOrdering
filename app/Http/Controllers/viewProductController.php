<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use Illuminate\Http\Request;

class viewProductController extends Controller
{
    //
    public function viewproduct()
    {

        $foodmenu = FoodMenu::latest()->paginate(5);
        return view('Restaurant.viewProduct',compact('foodmenu'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function Ajaxreason(Request $request)
    {


    }
}
