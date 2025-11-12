<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
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

    private function profileImageCacheKey(): string {
        return "student:{$this->id}:profile_image_url";
    }

    protected function profileImageUrl(): Attribute {
        return Attribute::get(function () {
            return Cache::remember($this->profileImageCacheKey(), now()->addMinutes(30), function () {
                // 1) Foto subida (usa relación precargada para evitar N+1)
                $mediaItem = $this->relationLoaded('media') ? $this->getMedia('photo')->first() : $this->getFirstMedia('photo');

                if ($mediaItem) {
                    return $mediaItem->hasGeneratedConversion('webp') ? $mediaItem->getFullUrl('webp') : $mediaItem->getFullUrl();
                }

                // 2) Avatar elegido por el usuario (relación precargada avatarMedia)
                if ($this->relationLoaded('avatarMedia') && $this->avatarMedia) {
                    $m = $this->avatarMedia;
                    return $m->hasGeneratedConversion('webp') ? $m->getFullUrl('webp') : $m->getFullUrl();
                }

                // 3) Avatar por defecto desde Settings (primer elemento). Evaluado una sola vez por request.
                return once(function () {
                    $settings = app(GeneralSettings::class);

                    $first = $settings->avatars[0] ?? null;
                    if (! $first || empty($first['avatar'])) {
                        return asset('images/default-avatar.png');
                    }

                    $m = Media::query()
                        ->select('id', 'uuid', 'file_name', 'disk', 'conversions_disk', 'collection_name')
                        ->find($first['avatar']);

                    if (! $m) {
                        return asset('images/default-avatar.png');
                    }

                    return $m->hasGeneratedConversion('webp') ? $m->getFullUrl('webp') : $m->getFullUrl();
                });
            });
        });
    }

    public function clearProfileImageCache(): void {
        Cache::forget($this->profileImageCacheKey());
    }

    protected static function booted(): void {
        static::updated(function (self $student) {
            if ($student->wasChanged('avatar_media_id')) {
                $student->clearProfileImageCache();
            }
        });
    }

    public function school(): BelongsTo {
        return $this->belongsTo(School::class);
    }

    public function grade(): BelongsTo {
        return $this->belongsTo(Grade::class);
    }

    public function avatarMedia() : BelongsTo {
        return $this->belongsTo(Media::class, 'avatar_media_id');
    }

}
