<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Monolog\Level;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Student extends Model implements HasMedia {

    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'first_name',
        'last_name',
        'school_id',
        'grade_id',
        'allergies',
        'birth_of_date',
        'avatar_media_id',
        'user_id'
    ];

    protected $casts = [
        'allergies' => 'json',
        'birth_of_date' => 'date'
    ];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('photo')->singleFile()->useDisk('students-photos');
    }

    public function registerMediaConversions(Media $media = null): void {
        // $this->addMediaConversion('thumb')->fit(\Spatie\Image\Enums\Fit::Crop, 400, 400)->nonQueued();
        $this->addMediaConversion('thumb')->fit(Fit::Crop, 400, 400)->format('webp')->quality(80)->queued();
        $this->addMediaConversion('webp')->format('webp')->quality(82)->queued();
    }

    protected function profileImageUrl(): Attribute {
        return Attribute::get(function () {
            $photoUrl = $this->getFirstMediaUrl('photo');
            if ($photoUrl) {
                return $photoUrl;
            }

            if ($this->avatar_media_id) {
                static $cache = [];
                if (! array_key_exists($this->avatar_media_id, $cache)) {
                    $media = Media::query()
                        ->select('id', 'disk', 'conversions_disk', 'file_name', 'uuid', 'collection_name')
                        ->find($this->avatar_media_id);

                    $cache[$this->avatar_media_id] = $media?->getFullUrl();
                }

                if (! empty($cache[$this->avatar_media_id])) {
                    return $cache[$this->avatar_media_id];
                }
            }
            $settings = new GeneralSettings();
            $avatar = $settings->avatars[0];
            $media = Media::find($avatar['avatar']);
            return ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
        });
    }

    public function school(): BelongsTo {
        return $this->belongsTo(School::class);
    }

    public function level(): BelongsTo {
        return $this->belongsTo(Level::class);
    }


}
