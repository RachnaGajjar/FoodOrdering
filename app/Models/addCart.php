<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addCart extends Model
{
    use HasFactory;
    protected $table='_addto_cart';
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'quantity',
    ];
}
