<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Grade extends Model implements Sortable {

    use SoftDeletes, SortableTrait;

    protected $fillable = [
        'name',
        'order_column',
        'school_id'
    ];

    public function teachers(): HasMany {
        return $this->hasMany(Teacher::class, 'grade_id', 'id');
    }

}
