<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use Illuminate\Http\Request;

class Category extends Controller
{
    //
    public function index(){

        $menus = FoodCategory::where('parent_id', '=', 0)->get();
        $allMenus = FoodCategory::pluck('title','id')->all();
        return view('Restaurant.category',compact('menus','allmenus'));

    }
    public function create()
    {
        $menus = FoodCategory::where('parent_id', '=', 0)->get();
        $allMenus = FoodCategory::pluck('title','id')->all();
        return view('Restaurant.category',compact('menus','allMenus'));
    }
    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
        ]);

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        FoodCategory::create($input);
        return back()->with('success', 'Menu added successfully.');
    }

}
