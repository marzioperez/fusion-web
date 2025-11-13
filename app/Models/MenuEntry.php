<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuEntry extends Model {

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_id',
        'grade_id',
        'date',
        'product_id',
        'stock',
        'price',
        'offer_price',
        'is_active'
    ];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean'
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');

    }
}
