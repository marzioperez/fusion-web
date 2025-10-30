<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Meta extends Model {

    protected $fillable = [
        'title',
        'description',
        'robots',
        'canonical_url',
        'media_id'
    ];

    public function metable(): MorphTo {
        return $this->morphTo();
    }

}
