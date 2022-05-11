<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;
    protected $table='food_menu_category';
    protected $fillable = [
        'id',
        'title',
        'parent_id',
        'sort_order',
        'slug'
    ];
    public function parent()
{
    return $this->hasOne('App\Models\FoodCategory', 'id', 'parent_id')->orderBy('sort_order');
}

public function children()
{

    return $this->hasMany('App\Models\FoodCategory', 'parent_id', 'id')->orderBy('sort_order');
}

public static function tree()
{
    return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=', '0')->orderBy('sort_order')->get();
}
public function foodmenu()
{
    return $this->hasMany('App\Models\FoodMenu','id','food_menu_category_id');
}

}
