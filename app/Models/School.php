<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model {

    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'phone',
        'emails',
        'color',
        'logo_media_id'
    ];

    protected string $slugSource = 'name';
    protected string $slugColumn = 'slug';

    protected $casts = [
        'emails' => 'json'
    ];

    public function grades(): HasMany {
        return $this->hasMany(Grade::class, 'school_id', 'id');
    }

    public function locked_dates(): HasMany {
        return $this->hasMany(LockedDate::class, 'school_id', 'id');
    }

}
