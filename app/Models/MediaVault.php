<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaVault extends Model implements HasMedia {

    use InteractsWithMedia;

    protected $fillable = ['id'];
    public function registerMediaConversions(Media $media = null): void {
        // $this->addMediaConversion('thumb')->fit(\Spatie\Image\Enums\Fit::Crop, 400, 400)->nonQueued();
        $this->addMediaConversion('thumb')->fit(Fit::Crop, 400, 400)->format('webp')->quality(80)->queued();
        $this->addMediaConversion('webp')->format('webp')->quality(82)->queued();
    }

}
