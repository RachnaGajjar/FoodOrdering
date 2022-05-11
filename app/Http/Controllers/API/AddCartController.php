<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use App\Models\addCart;


class AddCartController extends BaseController
{
    //
    public function addToCart(Request $request)
    {
        //Add to cartapi
        $validator = Validator::make(
            $request->all(),
            [
                'id'=>'required',
                'product_name'=>'required',
                'price' => 'required',
                'quantity' => 'required',
            ]);
            if($validator->fails())
            {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $users=Auth::user();
            $users_id=$users->id;
            $cart =([
            'id' => $request->id,
            'user_id'=>$users_id,
            'name' => $request->product_name,
            'price' => $request->price,
            'quantity'=>$request->quantity
            ]);
            try
            {
                $addCart =  addCart::create($cart);
            }
            catch(\Exception $e)
            {
                return $this->sendError('cart is already exists .');
            }
            return $this->sendResponse($addCart->toArray(), 'cart items add successfully');
    }
    public function editToCart(Request $request,addCart $addCart)
    {
        //Edit Cart API
        $input=$request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'quantity' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $users=Auth::user();
            $users_id=$users->id;
            $addCart =addCart::where('user_id',$users_id)->first();
            if ($addCart) {
                $addCart->quantity = $input['quantity'];
                $addCart->save();
            }
            return response()->json([
                "success" => true,
                "message" => "Quantity successfully uploaded",
            ]);

    }
    public function deleteToCart(addCart $addCart)
    {
        $users=Auth::user();
        $users_id=$users->id;
        $addCart=addCart::where('user_id',$users_id)->first();
        $addCart->delete();
        return $this->sendResponse($addCart->toArray(),'Cart Delete ');

    }
}
