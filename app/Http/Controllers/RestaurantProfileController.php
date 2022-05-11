<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantBankDetail;
use Illuminate\Http\Request;

class RestaurantProfileController extends Controller
{
    //
    public function Profile()
    {
        $user = auth()->user();
        $id=$user->id;
        $profile= Restaurant::with(['user','city'])->where('user_id',$id)->first();
        $bankdetails=RestaurantBankDetail::where('user_id',$id)->first();

        return view('Restaurant.profile',compact('profile','bankdetails'));
    }
    public function updateprofileAjax(Request $request)
    {
        $bankname=$request->bankname;
        $accountnumber=$request->accountnumber;
        $date=$request->date;
        $user = auth()->user();
        $userid=$user->id;
        RestaurantBankDetail::create(['user_id'=>$userid,'bankname'=>$bankname,'accountnumber'=> $accountnumber,'expire_year'=> $date,]);
        return response()->json(['success'=>'Ajax request submitted successfully']);

    }
}
