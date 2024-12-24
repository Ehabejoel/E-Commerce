<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    protected $fillable = [
        'quantity',
        'product_id'
    ];
}
