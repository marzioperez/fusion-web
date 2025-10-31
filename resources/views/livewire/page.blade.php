<div>
    @foreach($blocks as $block)
        @if($block['type'] === 'slider')
            <livewire:blocks.slider :data="$block['data']" />
        @endif
        @if($block['type'] === 'card-list')
            <x-blocks.card-list :data="$block['data']" />
        @endif
    @endforeach
</div>
