<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {

    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'price',
        'offer_price',
        'stock',
        'type',
        'media_id'
    ];

    protected string $slugSource = 'name';
    protected string $slugColumn = 'slug';

    public function ingredients(): BelongsToMany {
        return $this->belongsToMany(Ingredient::class)->withPivot(['quantity', 'unit'])->withTimestamps();
    }


}
