<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Stripe;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Profile as viewProfile;

use App\Models\Carddetails;
use App\Models\Employee;
use Dotenv\Validator as DotenvValidator;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\Console\Migrations\RollbackCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Token;

class ManageCarddetailsController extends Controller
{
    //
    public function carddetails(Request $request)
    {
        $users=auth::user();
        $id=$users->id;
        $email=$users->email;
        $employee=User::where('id',$id)->first();
        $name=$employee->name;
        $email=$employee->email;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = \Stripe\Customer::create
        ([
            "name"=>$name,
            "email"=>$email,

        ]);
        $customer_id=$customer->id;
        $user=User::where('id',$id)->first();
            if($user)
            {

                $user->customer_id=$customer_id;
                $user->save();
            }


            $card_number=$request->card_number;
            $month=$request->expire_month;
            $year=$request->expire_year;

        $token = Token::create([
            'card' => [
                'number' => $card_number,
                'exp_month' => $month,
                'exp_year' => $year,

            ],
        ]);
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripe=$stripe->customers->createSource(
        $customer=$customer->id,
         ['source' => $token->id
     ]);
     $demo=$stripe->id;
     $cardnum=$request->card_number;
     $card_number = substr($cardnum, -4);
     $expire_month=$request->expire_month;
     $expire_year=$request->expire_year;
     $card_name=$request->card_name;
     $id=$users->id;
    $input=[
        'card_name'=> $card_name,
        'card_number'=> $card_number,
        'expire_month'=>$expire_month,
        'expire_year'=>$expire_year,
        'card_token'=>$demo,
        'user_id'=>$id,
        'customer_id'=>$customer,
    ];

    $validator = Validator::make($input,[
        'card_name'=>'required',
        'card_number' => 'required',
        'expire_month' => 'required',
        'expire_year'=>'required',

    ]);
    $demo=Carddetails::create($input);
    if($demo)
    {
        return response()->json([
            "success" => true,
            "message" => "update successfully uploaded",
        ]);

    }
    if ($validator->fails())
    {
        return $this->sendError('Validation Error.', $validator->errors());
    }
}
public function UsersCards()
{

     $data=auth::user();
     $id=$data->id;
     $carduser=Carddetails::where('user_id',$id)->first();
     $cardcollection =Carddetails::where('user_id',$id)->select('card_name','card_number','id')->get();
     $success['name'] =  $carduser->card_name;
     $success['account_number']=$carduser->card_number;
     if($carduser)
    {
        return response()->json([$success,$cardcollection, 'User card details.']);
    }
    else
    {
        return response()->json([
            "success" => false,
            "message" => "Please Enter Card Details",
        ]);
    }
}
}
