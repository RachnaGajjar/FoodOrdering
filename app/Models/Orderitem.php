<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    use HasFactory;
    protected $table='_orders_items';
    protected $fillable = [
        'order_id',
        'user_id',
        'items_id',
        'name',
        'price',
        'quantity',
    ];
    public function orders()
    {

        return $this->hasMany('App\Models\Orderitem','order_id','id');
    }
}
