<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestRegister extends Model {

    protected $fillable = [
        'token',
        'step',
        'data',
        'students',
        'status'
    ];

    protected $casts = [
        'data' => 'json',
        'students' => 'json'
    ];

}
