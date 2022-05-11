<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodMenu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='food_menu';

    protected $fillable = [
        'restaurant_id',
        'food_menu_category_id',
        'name',
        'price',
        'discount',
        'discription',
        'offer_avilable_for',
        'reason',
    ];
    protected $dates = ['deleted_at'];
    public function restaurant()
    {
         return $this->belongsTo('App\Models\Restaurant','id');
    }
    public function food_category()
    {
        return $this->belongsTo('App\Models\FoodCategory','food_menu_category_id','id');
    }


}
