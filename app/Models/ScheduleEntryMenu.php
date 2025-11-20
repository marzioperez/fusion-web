<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleEntryMenu extends Model {

    protected $fillable = [
        'order_item_id',
        'school_id',
        'grade_id',
        'date',
        'first_name',
        'last_name',
        'product',
        'school',
        'grade',
        'color'
    ];

    protected $casts = [
        'date' => 'date'
    ];

}
