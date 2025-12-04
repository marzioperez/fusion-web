<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Communication extends Model {

    use SoftDeletes;

    protected $fillable = [
        'subject',
        'message',
        'attach_files',
        'send_all',
        'school_ids',
        'status',
        'total_recipients',
        'sent_at',
    ];

    protected $casts = [
        'attach_files' => 'json',
        'send_all' => 'boolean',
        'school_ids' => 'json',
        'sent_at' => 'datetime'
    ];

}
