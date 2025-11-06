<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model {

    use SoftDeletes;

    protected $fillable = [
        'form_id',
        'data'
    ];

    protected $casts = [
        'data' => 'json'
    ];

    public function form() {
        return $this->belongsTo(Form::class, 'form_id');
    }

}
