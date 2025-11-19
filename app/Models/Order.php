<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {

    use SoftDeletes;

    protected $fillable = [
        'code',
        'number',

        'user_id',
        'phone',
        'email',
        'last_name',
        'first_name',

        'status',
        'payment_status',

        'sub_total',
        'discount',
        'credits',
        'delivery',
        'processing_fee',
        'total',
        'weight',

        'coupon_code',

        'wp_id',

        'stripe_session_id',
        'stripe_payment_intent_id'
    ];

    public function items(): HasMany {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

}
