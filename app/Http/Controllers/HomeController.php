<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Restaurant=Restaurant::all()->count();
        $fooditems=FoodMenu::all()->count();
        $customer=User::all()->where('role','user')->count();
        $user=auth()->user();
        if($user->role == 'Owner')
        {
            $id=$user->id;
            $Restaurantid=Restaurant::where('user_id',$id)->select('id')->first();
            $Restaurant_id=$Restaurantid->id;
            $product=FoodMenu::where('restaurant_id',$Restaurant_id)->count();
            return view('home',compact('product'));
        }

        return view('home',compact('Restaurant','fooditems','customer'));
    }
}
