<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class FormField extends Model implements Sortable {

    use SoftDeletes, SortableTrait, HasSlug;

    protected $fillable = [
        'form_id',
        'name',
        'slug',
        'type',
        'size',
        'link',
        'options',
        'content',
        'order_column',
        'show',
        'required'
    ];

    protected string $slugSource = 'name';
    protected string $slugColumn = 'slug';

    protected $casts = [
        'link' => 'json',
        'options' => 'json',
        'show' => 'boolean',
        'required' => 'boolean'
    ];

}
