<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class UserController extends Controller
{
    /*
    This function use for
    show user's current location
    */
    public function UserCurrentLocation()
    {
         /* $ip = $request->ip(); Dynamic IP address */
         $ip = '162.159.24.227'; /* Static IP address */
         $currentUserInfo = Location::get($ip);
         return view('layout.index', compact('currentUserInfo'));
    }

}
