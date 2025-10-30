<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class MenuItem extends Model implements Sortable {

    use SoftDeletes, SortableTrait;

    protected $fillable = [
        'menu_id',
        'type',
        'item_id',
        'parent_id',
        'name',
        'slug',
        'url',
        'open_in_new_window',
        'style_button',
        'anchor_button',
        'order_column',
        'show',
    ];

    protected $casts = [
        'open_in_new_window' => 'boolean',
        'style_button' => 'boolean',
        'anchor_button' => 'boolean',
        'show' => 'boolean',
    ];

    public $sortable = [
        'sort_when_creating' => true
    ];

    public function menu(): BelongsTo {
        return $this->belongsTo(Menu::class);
    }

    public function items(): HasMany {
        return $this->hasMany(MenuItem::class, 'parent_id', 'id');
    }

}
