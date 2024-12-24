<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
        'product_name',
        'price',
        'description',
        'stock'
    ];
}
