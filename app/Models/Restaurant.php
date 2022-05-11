<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $table='restaurant';
    protected $fillable = [
        'user_id',
        'name',
        'thumbnail_image',
        'token',

    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');

    }
    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }
    public function foodmenu()
    {
        return $this->hasMany('App\Models\FoodMenu','food_menu_category_id');
    }
    public function food_category()
    {
        return $this->belongsTo('App\Models\FoodCategory','id');
    }



}
