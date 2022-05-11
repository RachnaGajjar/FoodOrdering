<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\FoodMenu;
use Illuminate\Http\Request;
use LaravelJsonApi\Eloquent\Contracts\SortField;

class ProductListController extends BaseController
{
    //
    public function ProductList(Request $request)
    {
        $page=$request->pagenumber;
        $restaurants= FoodMenu::with(['restaurant','food_category']);
       // $restaurants= FoodMenu::with(['restaurant','food_category'])->paginate(5);
        if($request->keyword)
        {

            $restaurants->where('discription','Like','%'.$request->keyword.'%');


        }
        if($request->food_category)
        {
            $restaurants->whereHas('food_category',function($query) use ($request)
            {
                $query->where('title',$request->food_category);
            });
        }
         if($request->restaurant_id)
        {
            $restaurants->where('restaurant_id',$request->restaurant_id);
        }
        if($request->sortBy && in_array($request->sortBy,['id','created_at']))
        {
              $sortBy=$request->sortBy;
        }
        else
        {
            $sortBy='id';
        }

        if($request->sortOrder && in_array($request->sortOrder,['asc','desc']))
        {
              $sortOrder=$request->sortOrder;
        }
        else
        {
            $sortOrder='desc';
        }
        if($request->perPage)
        {
            $perPage=$request->perPage;
        }
        else
        {
            $perPage=5;
        }
        if($request->paginate)
        {
            $blog=$restaurants->orderBy($sortBy,$sortOrder)->paginate($perPage);
        }
        else
        {
            $blog=$restaurants->orderBy($sortBy,$sortOrder)->get();
        }

        return response()->json([
            'message'=>'data retrive successfully',
            'data'=>$blog

        ],200);


    }
}
