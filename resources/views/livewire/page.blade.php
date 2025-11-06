<div>
    @foreach($blocks as $block)
        @if($block['type'] === 'slider')
            <livewire:blocks.slider :data="$block['data']" />
        @endif
        @if($block['type'] === 'school-carousel')
            <livewire:blocks.schools.carousel :data="$block['data']" />
        @endif
        @if($block['type'] === 'card-list')
            <x-blocks.card-list :data="$block['data']" />
        @endif
        @if($block['type'] === 'image-text-and-metrics')
            <x-blocks.image-text-and-metrics :data="$block['data']" />
        @endif
        @if($block['type'] === 'text-and-video')
            <x-blocks.text-and-video :data="$block['data']" />
        @endif
        @if($block['type'] === 'logos-carousel')
            <x-blocks.logos-carousel :data="$block['data']" />
        @endif
    @endforeach
</div>
