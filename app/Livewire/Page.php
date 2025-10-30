<?php

namespace App\Livewire;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Attributes\Url;
use Livewire\Component;

class Page extends Component {

    #[Url]
    public $slug = '/';

    public array $blocks = [];
    public \App\Models\Page $page;
    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';

    public function mount() {
        $model = \App\Models\Page::where('slug', $this->slug)->first();
        if ($model) {
            $seo = new SEOMeta();
            $graph = new OpenGraph();
            $twitter = new TwitterCard();
            $jsonld = new JsonLd();

            $title = $model->title;
            $description = null;
            $image = null;
            $robots = null;

            if ($model->meta) {
                if ($model->meta->title) {
                    $title = $model->meta->title;
                }
                if ($model->meta->description) {
                    $description = $model->meta->description;
                }
                if ($model->meta->image_url) {
                    $image = $model->meta->image_url;
                }
                if ($model->meta->robots) {
                    $robots = $model->meta->robots;
                }
            }

            $seo::setTitle($title);
            $seo::setCanonical(route('page', ['slug' => $model->slug]));
            if ($robots) {
                $seo::setRobots($robots);
            }

            $graph::setTitle($title);
            $graph::setUrl(route('page', ['slug' => $model->slug]));
            $graph::addProperty('locale', 'es_ES');
            $graph::addProperty('type', 'website');
            $graph::setSiteName(config('app.name'));

            $twitter::setTitle($title);
            $twitter::setDescription($description);
            $twitter::setType('website');
            $twitter::setUrl(route('page', ['slug' => $model->slug]));
            $twitter::setSite(config('app.name'));

            $jsonld::setTitle($title);
            $jsonld::setType('website');

            if ($description) {
                $seo::setDescription($description);
                $graph::setDescription($description);
                $jsonld::setDescription($description);
            }

            if ($image) {
                $graph::addImage($image);
                $jsonld::addImage($image);
            }

            $this->page = $model;
            $this->layout = $model->layout ?? 'components.layouts.app';
            $this->header_position = $model->header_position ?? 'fixed';
            $this->blocks = $model->content ?? [];
        } else {
            abort(404);
        }
    }

    public function render() {
        return view('livewire.page')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
