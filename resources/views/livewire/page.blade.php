<div>
    @foreach($blocks as $block)
        @if($block['type'] === 'slider')
            <livewire:blocks.slider :data="$block['data']" />
        @endif
    @endforeach
</div>
