<?php

namespace App\Livewire\Blocks\Schools;

use App\Models\School;
use Illuminate\Support\Collection;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Carousel extends Component {

    public $data;
    public Collection $schools;

    public function mount() {
        $this->loadSchools();
    }

    public function loadSchools() {
        $this->schools = collect();
        $model = School::query();
        $model->orderBy('name')->get()->each(function($school) {
            return $this->schools->push($this->parseSchool($school));
        });
    }

    public function parseSchool(School $school) {
        $logo = 'https://placehold.co/600x400';
        if ($school['logo_media_id']) {
            $media = Media::find($school['logo_media_id']);
            if ($media) {
                $logo = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
            }
        }

        $school = $school->only(['name']);

        return array_merge($school, [
            'logo' => $logo
        ]);
    }

    public function render() {
        return view('livewire.blocks.schools.carousel');
    }
}
