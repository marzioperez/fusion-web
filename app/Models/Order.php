<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Order extends Model implements HasMedia {

    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'cart_id',
        'code',
        'number',

        'user_id',
        'phone',
        'email',
        'first_name',
        'last_name',

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

        'stripe_session_id',
        'stripe_payment_intent_id'
    ];

    public function items(): HasMany {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function user(): HasOne {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('documents')->useDisk('orders');
    }

}
