@props(['data'])
@php
    use \Spatie\MediaLibrary\MediaCollections\Models\Media;
    use \App\Settings\GeneralSettings;

    $image_url = 'https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80';
    if ($data['bg_image_id']) {
        $media = Media::find($data['bg_image_id']);
        if ($media) {
            $image_url = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
        }
    }

    $logo = null;
    $settings = new GeneralSettings();
    if ($settings->logo) {
        $media = Media::find($settings->logo);
        if ($media) {
            $logo = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
        }
    }
@endphp
<div class="h-screen">
    <div class="flex min-h-full">
        <div class="flex flex-1 flex-col justify-center px-4 py-6 sm:px-6 lg:flex-none lg:px-14 xl:px-16">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    @if($logo)
                        <a href="{{config('app.url')}}" wire:navigate>
                            <img src="{{$logo}}" alt="{{config('app.name')}}" class="h-16" />
                        </a>
                    @endif
                </div>

                <div class="mt-6">
                    <livewire:auth.login :data="$data" />
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img src="{{$image_url}}" alt="" class="absolute inset-0 size-full object-cover" />
        </div>
    </div>
</div>
