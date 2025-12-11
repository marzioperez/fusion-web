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

    $bg_block = null;
    if ($data['image_id']) {
        $image = Media::find($data['image_id']);
        if ($image) {
            $bg_block = ($image->hasGeneratedConversion('webp') ? $image->getFullUrl('webp') : $image->getUrl());
        }
    }

    $bg_inner_block = null;
    if ($data['inner_image_id']) {
        $image = Media::find($data['inner_image_id']);
        if ($image) {
            $bg_inner_block = ($image->hasGeneratedConversion('webp') ? $image->getFullUrl('webp') : $image->getUrl());
        }
    }
@endphp
@if($data['visible'])
    <div style="{{$bg_data}}" class="{{$padding_classes}}">
        <div class="container space-y-6">
            <div class="overflow-hidden relative rounded-2xl md:py-12 py-8 md:px-8 px-4 bg-fixed bg-top" style="background-image: url({{$bg_block}})">
                <div class="absolute top-0 left-0 w-full h-full z-10 bg-cover bg-bottom opacity-50 bg-black/80" style="background-image: url({{$bg_inner_block}})"></div>
                <div class="text-center text-white space-y-6 relative z-20">
                    @if($data['title'])
                        <h2>{{$data['title']}}</h2>
                    @endif
                    @if($data['content'])
                        <div class="html-content mx-auto md:w-[500px] w-full">{!! $data['content'] !!}</div>
                    @endif
                    @if($data['button_url'] && $data['button_text'])
                        <div class="flex justify-center">
                            <a href="{{$data['button_url']}}" wire:navigate class="btn btn-lg btn-primary">{{$data['button_text']}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
