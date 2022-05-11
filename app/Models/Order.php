<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='_orders_';
    protected $fillable = [
        'status',
        'user_id',
        'amount',
        'in_cart',
    ];
    public function orderitem()
    {
        return $this->belongsTo('App\Models\Orderitem','id','order_id');
    }

}
