<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    protected $fillable = [
        'quantity',
        'products_id',
        'order_id'
    ];
}
