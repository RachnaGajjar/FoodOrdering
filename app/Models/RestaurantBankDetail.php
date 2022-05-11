<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantBankDetail extends Model
{
    use HasFactory;
    protected $table='restaurants_bank_details';
    protected $fillable = [
        'user_id',
        'bankname',
        'accountnumber',
        'expire_year',

    ];
}
