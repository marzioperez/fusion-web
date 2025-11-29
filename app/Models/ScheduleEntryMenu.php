<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ScheduleEntryMenu extends Model {

    protected $fillable = [
        'order_item_id',
        'product_id',
        'school_id',
        'grade_id',
        'student_id',
        'date',
        'first_name',
        'last_name',
        'product',
        'school',
        'grade',
        'color',
        'allergies'
    ];

    protected $casts = [
        'date' => 'date',
        'allergies' => 'json'
    ];

    public function school(): HasOne {
        return $this->hasOne(School::class, 'id', 'school_id');
    }

    public function student(): HasOne {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

//    public function product(): BelongsTo {
//        return $this->belongsTo(Product::class);
//    }

}
