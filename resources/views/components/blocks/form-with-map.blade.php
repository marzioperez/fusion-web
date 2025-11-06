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
        <div class="md:grid grid-cols-2 gap-6 md:space-y-0 space-y-6">
            <div class="px-6 py-8 border border-primary rounded-xl bg-white">
                <livewire:common.form-builder :form_id="$data['form_id']" />
            </div>
            <div>{!! $data['map'] !!}</div>
        </div>
    </div>
</div>
