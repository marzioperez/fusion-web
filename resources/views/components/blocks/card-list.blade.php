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
        <div class="grid md:grid-cols-4 grid-cols-2 shadow-md rounded-lg">
            @foreach($data['cards'] as $i => $item)
                @php
                    $class = '';
                    if ($i === 0) {
                        $class = 'rounded-l-lg';
                    }
                    if ($i == array_key_last($data['cards'])) {
                        $class = 'rounded-r-lg';
                    }
                @endphp
                <div style="background-color: {{$item['bg_color']}}" class="p-3 {{$class}}">
                    <div class="md:grid grid-cols-12 gap-6 px-3 py-2">
                        <div class="col-span-4">
                            @if($item['icon_id'])
                                @php $icon = Media::find($item['icon_id']); @endphp
                                @if($icon)
                                    <img src="{{($icon->hasGeneratedConversion('webp') ? $icon->getFullUrl('webp') : $icon->getUrl())}}" alt="">
                                @endif
                            @endif
                        </div>
                        <div class="col-span-8 flex items-center">
                            <div style="color: {{$item['text_color']}}">
                                <h5>{{$item['title']}}</h5>
                                <p>{{$item['sub_title']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
