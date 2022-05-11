<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
    use HasFactory;
    protected $table='order_status';
    protected $fillable = [
        'order_status_id',
        'status',
    ];
}
