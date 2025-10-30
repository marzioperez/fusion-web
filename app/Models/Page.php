<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model {

    use SoftDeletes, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_home',
        'layout',
        'header_position',
        'status'
    ];

    protected string $slugSource = 'title';
    protected string $slugColumn = 'slug';

    protected $casts = [
        'content' => 'json',
        'is_home' => 'boolean',
    ];

    public function meta(): MorphOne {
        return $this->morphOne(Meta::class, 'metable');
    }

}
