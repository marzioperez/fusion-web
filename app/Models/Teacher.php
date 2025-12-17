<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model {

    protected $fillable = [
        'name',
        'grade_id'
    ];

}
