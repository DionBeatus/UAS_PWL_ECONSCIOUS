<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'buyer_name',
        'product_name',
        'quantity',
        'price',
        'total',
    ];
}
