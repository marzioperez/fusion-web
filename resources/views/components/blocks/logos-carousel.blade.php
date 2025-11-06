@props(['data'])
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
<div style="{{$bg_data}}" class="{{$padding_classes}}">
    <div class="container space-y-6">
        @if ($data['title'])
            <h2 class="text-center">{{$data['title']}}</h2>
        @endif
        @if ($data['content'])
            <div class="text-center html-content">{!! $data['content'] !!}</div>
        @endif
        <div>
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
                                    perPage: 2,
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
                        @foreach ($data['logos'] as $logo)
                            <div class="splide__slide px-3 flex justify-center">
                                @php $logo = Media::find($logo['logo']); @endphp
                                @if($logo)
                                    <img class="w-full" src="{{($logo->hasGeneratedConversion('webp') ? $logo->getFullUrl('webp') : $logo->getUrl())}}" alt="" />
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
