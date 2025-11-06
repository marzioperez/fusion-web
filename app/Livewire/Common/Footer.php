<?php

namespace App\Livewire\Common;

use App\Settings\GeneralSettings;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Footer extends Component {

    public $logo;
    public $instagram;

    public function mount() {
        $settings = new GeneralSettings();
        if ($settings->logo_footer) {
            $media = Media::find($settings->logo_footer);
            if ($media) {
                $this->logo = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
            }
        }
        $this->instagram = $settings->instagram;
    }

    public function render() {
        return view('livewire.common.footer');
    }
}
