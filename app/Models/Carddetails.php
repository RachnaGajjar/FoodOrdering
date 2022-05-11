<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carddetails extends Model
{
    use HasFactory;
    protected $table = 'card__details';
    protected $fillable = [
        'id','card_name','card_number','expire_month','expire_year','card_token','user_id','customer_id'
    ];
}
