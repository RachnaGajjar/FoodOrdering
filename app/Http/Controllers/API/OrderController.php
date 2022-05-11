<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\addCart;
use App\Models\FoodCategory;
use App\Models\FoodMenu;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Orderitem as ModelsOrderitem;
use App\Models\Orderstatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class OrderController extends BaseController
{
    //
    public function orders(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'status' => 'required',
                'in_cart' => 'required',
            ]
        );
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $users = Auth::user();
        $users_id = $users->id;
        $cart = addCart::where('user_id', $users_id)->first();
        $food_name = $cart->name;
        $quantity = $cart->quantity;
        $cartcount = $cart->count();
        $price = $cart->price;
        $orders = [
            'id' => $request->id,
            'status' => $request->status,
            'user_id' => $users_id,
            'amount' => $price,
            'in_cart' => '1',
        ];
        try {
            if ($cartcount > 0) {

                $addCart = Order::create($orders);
                $data = FoodCategory::with('foodmenu')->where('title', $food_name)->first();
                //dd($data);
                $item_id = $data->id;

                /* $item_id= */
                $order_id = $addCart->id;
                $orders_items = [
                    'order_id' => $order_id,
                    'user_id' => $users_id,
                    'items_id' => $item_id,
                    'name' => $food_name,
                    'price' => $price,
                    'quantity' => $quantity,
                ];
                $order = Orderitem::create($orders_items);
                $orders_status = [
                    'order_status_id' => $request->id,
                    'status' => $request->status,
                ];

                $order = Orderstatus::create($orders_status);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($addCart->toArray(), 'Ordes add');
    }
    public function manageorders(Request $request)
    {

        $users = Auth::user();
        $users_id = $users->id;
        $orders=Order::where('user_id',$users_id)->where('status','pending')->get();
        $orderslist=Order::where('user_id',$users_id)->where('status','ongoing')->get();
        return $this->sendResponse($orders->toArray(),$orderslist->toArray(), 'Yours Orders');

    }
    public function orderdetails()
    {
        $user=Auth::user();
        $users_id=$user->id;
        $order_item=Order::with('orderitem')->where('user_id',$users_id)->where('status','pending')->get();
        return $this->sendResponse($order_item->toArray(), 'Yours Orders');

    }
}
