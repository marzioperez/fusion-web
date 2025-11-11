<?php

namespace App\Livewire\Common;

use App\Enums\MenuItemTypes;
use App\Enums\Positions;
use App\Models\Menu;
use App\Settings\GeneralSettings;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Header extends Component {

    public $logo;
    public $header_position = 'fixed';
    public $logged_in = false;
    public array $menu = [];

    public function mount() {
        $general_settings = new GeneralSettings();
        if ($general_settings->logo) {
            $media = Media::find($general_settings->logo);
            if ($media) {
                $this->logo = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
            }
        }
        $this->logged_in = auth()->check();
        $this->loadMenu();
    }

    public function loadMenu() {
        $menu = Menu::with('items')->where('position', Positions::HEADER->value)->get()->last();
        if ($menu) {
            foreach ($menu->items()->ordered()->get() as $item) {
                if ($item['show']) {
                    $element = $item->only([
                        'name',
                        'url',
                        'open_in_new_window',
                        'style_button',
                        'anchor_button',
                        'type'
                    ]);
                    $this->menu[] = $element;
                }
            }
        }
    }

    #[On('refresh-header')]
    public function refresh_header() {
        $this->logged_in = auth()->check();
    }

    public function logout(): void {
        auth()->logout();
        $this->refresh_header();
    }

    public function storeIntendedUrl($origin, $destination): void {
        session(['url.intended' => $origin]);
        $this->redirect(url($destination), navigate: true);
    }

    public function render() {
        return view('livewire.common.header');
    }
}
