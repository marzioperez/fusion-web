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
@if($data['visible'])
    <div style="{{$bg_data}}" class="{{$padding_classes}}">
        <div class="container space-y-6">
            <div class="md:grid grid-cols-2 gap-6">
                <div class="space-y-3">
                    @if($data['before_title'])
                        <h6 class="text-secondary font-semibold">{{$data['before_title']}}</h6>
                    @endif
                    @if($data['title'])
                        <h2>{{$data['title']}}</h2>
                    @endif
                    <div class="html-content">{!! $data['content'] !!}</div>
                    @if(count($data['lists']) > 0)
                        <div class="md:grid grid-cols-2 gap-6">
                            @foreach($data['lists'] as $list)
                                <div class="html-content">{!! $list['content'] !!}</div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="space-y-3">
                    @if($data['video_title'])
                        <h2>{{$data['video_title']}}</h2>
                    @endif
                    <div class="html-content">{!! $data['video_iframe'] !!}</div>
                </div>
            </div>
        </div>
    </div>
@endif
