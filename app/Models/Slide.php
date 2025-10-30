<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Slide extends Model implements Sortable {

    use SoftDeletes, SortableTrait;

    protected $fillable = [
        'title',
        'content',
        'type',
        'url',
        'order_column',
        'show',
        'image_desktop_id',
        'image_mobile_id',
        'slider_id'
    ];

    protected $casts = [
        'content' => 'array',
        'show' => 'boolean'
    ];

}
