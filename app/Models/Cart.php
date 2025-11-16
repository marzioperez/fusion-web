<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $fillable = [
        'user_id',
        'user_data',
        'token',
        'status',
        'items',
        'total_items',
        'coupon_code',
        'subtotal',
        'discount',
        'delivery',
        'total',
        'weight',
    ];

    protected $casts = [
        'user_data' => 'json',
        'items' => 'json',
        'total_items' => 'integer'
    ];

}
