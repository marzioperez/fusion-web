<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model {

    use SoftDeletes;

    protected $fillable = [
        'name',
        'text_button',
        'thanks_message',
        'send_emails'
    ];

    protected $casts = [
        'thanks_message' => 'json',
        'send_emails' => 'json'
    ];

    public function fields() {
        return $this->hasMany(FormField::class);
    }

}
