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
            <div class="space-y-4">
                @if($data['before_title'])
                    <h6 class="text-secondary font-semibold">{{$data['before_title']}}</h6>
                @endif
                @if ($data['title'])
                    <h2>{{$data['title']}}</h2>
                @endif
                @if ($data['content'])
                    <div class="html-content">{!! $data['content'] !!}</div>
                @endif
                @if($data['time_line_title'])
                    <h6 class="text-secondary font-semibold">{{$data['time_line_title']}}</h6>
                @endif
                @if($data['items'])
                    <div class="relative">
                        <div class="absolute top-0 -left-20 text-center md:block hidden">
                            <img src="{{asset('img/scroll.gif')}}" alt="" class="h-24" />
                            <span>Scroll</span>
                        </div>
                        <div x-ref="splide" class="splide carousel-time-line grid" x-data="{
                        init() {
                            const splide = new Splide(this.$refs.splide, {
                                direction: 'ttb',
                                height: '400px',
                                perPage: 2,
                                focus: 'bottom',
                                gap: '10px',
                                pagination: false,
                                arrows: false,
                                wheel: true,
                                releaseWheel: true,
                                drag: false,
                                padding: { top: '0px', bottom: '28px' },
                                trimSpace: false,
                                breakpoints: {
                                    640: {
                                        perPage: 1,
                                        height: 'auto',
                                        direction: 'ltr',
                                        releaseWheel: false,
                                        drag: true,
                                        wheel: false,
                                        pagination: true
                                    }
                                }
                            });

                            const markProximity = () => {
                                const slides = splide.Components.Slides.get();
                                const i = splide.index;

                                slides.forEach((s, idx) => {
                                    const el = s.slide;
                                    el.classList.remove('tl-active', 'tl-near', 'tl-far');
                                    const d = Math.abs(idx - i);
                                    if (d === 0) el.classList.add('tl-active');
                                    else if (d === 1) el.classList.add('tl-near');
                                    else el.classList.add('tl-far');
                                });
                            };

                            splide.on('mounted move moved', markProximity);
                            splide.mount();
                        }
                    }">
                            <div class="splide__track">
                                <div class="splide__list">
                                    @foreach ($data['items'] as $item)
                                        <div class="splide__slide">
                                            <div class="tl-card bg-white rounded-2xl p-5 pl-12 shadow-sm relative md:h-auto h-full md:block flex items-center">
                                                <div>
                                                    <span class="absolute left-4 top-6 h-3 w-3 rounded-full bg-primary ring-4 ring-primary/30"></span>
                                                    <div class="flex items-baseline justify-between">
                                                        <h5 class="text-xl font-semibold">{{$item['year']}}</h5>
                                                    </div>
                                                    <p>{{$item['content']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @if($data['image_id'])
                @php $block_image = Media::find($data['image_id']); @endphp
                @if($block_image)
                    <div class="md:block hidden">
                        <img class="w-full" src="{{($block_image->hasGeneratedConversion('webp') ? $block_image->getFullUrl('webp') : $block_image->getUrl())}}" alt="" />
                    </div>
                @endif
            @endif
        <div>
    </div>
</div>
