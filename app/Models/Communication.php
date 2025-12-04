<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Communication extends Model implements HasMedia {

    use SoftDeletes, InteractsWithMedia;

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

    public function registerMediaCollections(): void {
        $this->addMediaCollection('attachments')->useDisk('communications');
    }

}
