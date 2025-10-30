@props(['data' => $data])
<div x-data="{ options: @entangle('data') }">
    <div x-ref="splide" class="splide slider" wire:ignore x-data="{
        init() {
            const el = this.$refs.splide;
            if (!el) return;

            if (el.__splide) {
                try { el.__splide.destroy(true); } catch (e) {}
                el.__splide = null;
                delete el.dataset.splideMounted;
            }

            if (el.dataset.splideMounted === '1') return;

            const splide = new Splide(el, {
                type: 'slide',
                pagination: options.pagination,
                autoplay: true,
                interval: 7000,
                rewind: true,
                arrows: options.arrows,
                breakpoints: {
                    1024: { drag: true },
                    640:  { drag: true, arrows: false, pagination: true }
                }
            });

            splide.mount();
            el.__splide = splide;
            el.dataset.splideMounted = '1';

            const cleanup = () => {
                if (el.__splide) {
                    try { el.__splide.destroy(true); } catch (e) {}
                    el.__splide = null;
                    delete el.dataset.splideMounted;
                }
            };

            window.addEventListener('livewire:navigating', cleanup, { once: true });
            window.addEventListener('pagehide', cleanup, { once: true });
        }
    }">
        <div class="splide__track">
            <div class="splide__arrows">
                <button class="splide__arrow--prev absolute top-1/2 z-10 rotate-180 bg-transparent disabled:opacity-50">
                    <svg width="28" height="43" viewBox="0 0 28 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 33L9 21.5L19 10" class="stroke-white" stroke-width="5"/>
                    </svg>
                </button>
                <button class="splide__arrow--next absolute top-1/2 z-10 rotate-180 bg-transparent disabled:opacity-50">
                    <svg width="28" height="43" viewBox="0 0 28 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 33L9 21.5L19 10" class="stroke-white" stroke-width="5"/>
                    </svg>
                </button>
            </div>
            <div class="splide__list flex w-full">
                @foreach($slides as $slide)
                    @if($slide['type'] === \App\Enums\SlideTypes::BG_IMAGE_AND_TEXT->value)
                        <div class="splide__slide relative group">
                            <div class="absolute top-0 left-0 h-full w-full bg-black/40 z-10"></div>
                            @if($slide['image_desktop_url'] && $slide['image_mobile_url'])
                                <img src="{{ $slide['image_mobile_url'] }}" class="w-full md:hidden" alt="" />
                                <img src="{{ $slide['image_desktop_url'] }}" class="w-full max-md:hidden" alt="" />
                            @else
                                <img src="{{ $slide['image_desktop_url'] }}" class="w-full" alt="" />
                            @endif
                            <div class="slide-content">
                                <div class="container">
                                    <div class="mx-auto w-full">
                                        <div class="md:space-y-4 space-y-3">
                                            @foreach($slide['content'] as $item)
                                                @if($item['type'] === \App\Enums\SlideTypes::PARAGRAPH->value)
                                                    <div class="text-white space-y-3">
                                                        {!! $item['data']['text'] !!}
                                                    </div>
                                                @endif
                                                @if($item['type'] === \App\Enums\SlideTypes::BUTTON->value)
                                                    <div class="flex justify-start md:pb-0 pb-6">
                                                        <a href="{{$item['data']['url']}}" class="btn btn-xl btn-primary" wire:navigate>{{$item['data']['text']}}</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
