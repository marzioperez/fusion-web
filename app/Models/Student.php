<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Monolog\Level;

class Student extends Model {

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'school_id',
        'grade_id',
        'allergies',
        'birth_of_date',
        'user_id'
    ];

    protected $casts = [
        'allergies' => 'json',
        'birth_of_date' => 'date'
    ];

    public function school(): BelongsTo {
        return $this->belongsTo(School::class);

    }

    public function level(): BelongsTo {
        return $this->belongsTo(Level::class);
    }


}
