<?php

namespace App\Livewire\Blocks;

use App\Models\Slide;
use Illuminate\Support\Collection;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Slider extends Component {

    public $data;
    public Collection $slides;

    public function mount() {
        $this->slides = collect();

        $slides = Slide::where('slider_id', $this->data['slider'])->where('show', true)->get();
        $slides->each(function($slide) {
            return $this->slides->push($this->parseSlide($slide));
        });
    }

    public function parseSlide(Slide $slide): array {
        $image_desktop_url = null;
        if ($slide['image_desktop_id']) {
            $media = Media::find($slide['image_desktop_id']);
            if ($media) {
                $image_desktop_url = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
            }
        }

        $image_mobile_url = null;
        if ($slide['image_mobile_id']) {
            $media = Media::find($slide['image_mobile_id']);
            if ($media) {
                $image_mobile_url = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
            }
        }

        $slide = $slide->only([
            'content',
            'type',
            'url'
        ]);

        return array_merge($slide, [
            'image_desktop_url' => $image_desktop_url,
            'image_mobile_url' => $image_mobile_url
        ]);

    }

    public function render() {
        return view('livewire.blocks.slider');
    }
}
