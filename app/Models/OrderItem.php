<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model {

    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'label',
        'student_id',
        'student_name',
        'image_url',
        'type',
        'menu_entry_id',
        'date',
        'price',
        'quantity',
        'total',
        'data',
        'status'
    ];

    protected $casts = [
        'data' => 'json',
        'date' => 'date'
    ];

    public function order(): HasOne {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

}
