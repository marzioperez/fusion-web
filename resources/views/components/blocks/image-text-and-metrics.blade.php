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
        <div class="md:grid grid-cols-2 gap-6">
            @if($data['image_id'])
                @php $block_image = Media::find($data['image_id']); @endphp
                @if($block_image)
                    <div class="md:block hidden">
                        <img class="w-full" src="{{($block_image->hasGeneratedConversion('webp') ? $block_image->getFullUrl('webp') : $block_image->getUrl())}}" alt="" />
                    </div>
                @endif
            @endif
            <div class="flex items-center">
                <div class="space-y-4">
                    @if($data['before_title'])
                        <h6 class="text-secondary font-semibold">{{$data['before_title']}}</h6>
                    @endif
                    @if($data['title'])
                        <h1 class="font-bold">{{$data['title']}}</h1>
                    @endif
                    @if($data['sub_title'])
                        <h4 class="font-semibold">{{$data['sub_title']}}</h4>
                    @endif
                    @if($data['content'])
                        <div class="html-content">{!! $data['content'] !!}</div>
                    @endif
                    @if($data['metrics'])
                        <div class="grid grid-cols-{{count($data['metrics'])}} gap-6">
                            @foreach($data['metrics'] as $metric)
                                <div class="text-center space-y-2">
                                    <h2 style="color: {{$metric['color']}}">{{$metric['value']}}</h2>
                                    <p class="uppercase">{{$metric['title']}}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($data['button_url'] && $data['button_text'])
                        <div class="pt-6 flex justify-center">
                            <a href="{{$data['button_url']}}" wire:navigate class="btn btn-lg btn-primary">{{$data['button_text']}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
