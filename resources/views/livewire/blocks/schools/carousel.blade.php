<div>
    @php
        $padding_classes = implode(' ', [
            "md:pt-{$data['padding_top_desktop']}",
            "md:pb-{$data['padding_bottom_desktop']}",
            "pb-{$data['padding_bottom_mobile']}",
            "pt-{$data['padding_top_mobile']}",
        ]);
        use \Spatie\MediaLibrary\MediaCollections\Models\Media;

        $bg_data = null;
        if ($data['bg_type'] === 'color') {
            $bg_data = "background-color: " . $data['bg_color'];
        }
        if ($data['bg_type'] === 'image') {
            if ($data['bg_image_id']) {
                $image = Media::find($data['bg_image_id']);
                if ($image) {
                    $bg_data = "background-image: url(" . ($image->hasGeneratedConversion('webp') ? $image->getFullUrl('webp') : $image->getUrl()) . ")";
                }
            }
        }
    @endphp
    <div>
        @if($data['visible'])
            <div style="{{$bg_data}}" class="{{$padding_classes}}">
                <div class="container space-y-6">
                    @if($data['title'])
                        <h2 class="text-center">{{$data['title']}}</h2>
                    @endif
                    <div class="p-6 bg-white shadow rounded-lg">
                        <div x-ref="splide" class="splide carousel-schools grid" x-data="{
                            init() {
                                new Splide(this.$refs.splide, {
                                    perPage: 4,
                                    drag: true,
                                    rewind: true,
                                    type: 'carousel',
                                    pagination: true,
                                    autoplay: true,
                                    interval: 3000,
                                    arrows: true,
                                    breakpoints: {
                                        1024: {
                                            perPage: 2,
                                            drag: true,
                                            pagination: true,
                                            rewind: true
                                        },
                                        640: {
                                            perPage: 1,
                                            drag: true,
                                            pagination: true,
                                            rewind: true
                                        }
                                    }
                                }).mount()
                            }
                        }">
                            <div class="splide__track">
                                <div class="splide__list">
                                    @foreach ($schools as $school)
                                        <div class="splide__slide px-3">
                                            <img src="{{ $school['logo'] }}" class="md:h-44 md:w-44 object-contain" alt="{{$school['name']}}" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($data['button_url'] && $data['button_text'])
                        <div class="flex justify-center">
                            <a href="{{$data['button_url']}}" wire:navigate class="btn btn-lg btn-primary">{{$data['button_text']}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
