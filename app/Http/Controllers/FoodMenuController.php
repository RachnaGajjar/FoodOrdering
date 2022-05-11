<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Models\FoodMenu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class FoodMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $foodmenu = FoodMenu::latest()->paginate(5);
        return view('FoodMenu.index',compact('foodmenu'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = new \App\Models\Menu;
        $menulist = $menu->tree();
        return view('FoodMenu.create')->with('menulist', $menulist);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'date'=>'required',
            'description'=>'required',

        ]);
        dd($request->all());
        $name=$request->name;
        $price=$request->price;
        $discount=$request->discount;
        $description=$request->description;
        $offer=$request->date;
        $food_category=$request->food_category;
        $user = auth()->user();
        $id=$user->id;
        $data=Restaurant::where('user_id',$id)->first();
        $restaurant_id=$data->id;
        $foodmenu=FoodMenu::create(['restaurant_id'=>$restaurant_id,'food_menu_category_id'=>$food_category,'name'=>$name,'price'=>$price,'discount'=> $discount,'discription'=> $description,'offer_avilable_for'=>$offer]);
        return redirect()->route('foodmenu.index')
        ->with('success', 'Menu created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FoodMenu $foodmenu)
    {
        //
        return view('FoodMenu.show',compact('foodmenu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodMenu $foodmenu)
    {
        //
        $id=$foodmenu->id;
        $category_id=FoodMenu::where('id',$id)->select('food_menu_category_id')->first();
        $categoryid=$category_id->food_menu_category_id;
        $items=FoodCategory::pluck('id','title');
        return view('FoodMenu.edit',compact('foodmenu','items','categoryid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Restaurant $restaurants)
    {
           //validation

           $request->validate([
            'name' => 'required',
            'price' => 'required',
            'discount'=>'required',
            'discription'=>'required',
            'date'=>'required',
            'category_id'=>'required',

        ]);
        $menu= FoodMenu::where('id',$id)->first();
        $menu->update($request->all());
        return redirect()->route('foodmenu.index')
        ->with('success', 'Menu updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodMenu $foodmenu)
    {
        //
        $id=$foodmenu->id;
        $input=FoodMenu::find($id);
        if($input) {
            $input->reason = 'a';
            $input->save();
        }
        $foodmenu->delete();
        return redirect()->route('viewproduct')->with('success','FoodMenu deleted successfully');

    }
    public function restore($id)
    {
        FoodMenu::withTrashed()->find($id)->restore();

        return back();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function restoreAll()
    {
        FoodMenu::onlyTrashed()->restore();

        return back();
    }


}
