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

    $bg_inner_block = null;
    if ($data['inner_image_id']) {
        $image = Media::find($data['inner_image_id']);
        if ($image) {
            $bg_inner_block = ($image->hasGeneratedConversion('webp') ? $image->getFullUrl('webp') : $image->getUrl());
        }
    }
@endphp
<div style="{{$bg_data}}" class="{{$padding_classes}}">
    <div class="container space-y-6">
        <div class="section-title">
            <h1 class="text-white">{{$data['title']}}</h1>
            <div class="absolute top-0 left-0 w-full h-full z-10 bg-cover bg-bottom" style="background-image: url({{$bg_inner_block}})"></div>
        </div>
    </div>
</div>
