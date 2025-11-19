<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model {

    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'name',
        'price',
        'quantity',
        'total',
        'data',
        'status'
    ];

    protected $casts = [
        'data' => 'json'
    ];

}
