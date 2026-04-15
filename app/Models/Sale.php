<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'product_name',
        'quantity',
        'price',
        'total',
    ];
}
