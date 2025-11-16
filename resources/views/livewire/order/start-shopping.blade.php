<div class="container space-y-12 py-6" x-data="{ activeTab: '0' }">
    <div>
        <livewire:student.card :student="$student" />
    </div>
    <div class="space-y-10">
        <div class="flex space-x-3">
            @foreach($menu_entries as $g => $group)
                <button class="btn btn-md" :class="activeTab === '{{$g}}' ? 'btn-primary' : 'btn-outline-primary'" x-on:click="activeTab = '{{$g}}'">
                    {{ \Illuminate\Support\Str::ucfirst($group['label']) }}
                </button>
            @endforeach
        </div>
        @foreach($menu_entries as $g => $group)
            <div x-show="activeTab === '{{ $g }}'">
                <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-6 gap-y-10">
                    @foreach($group['items'] as $item)
                        <livewire:product.item :product="$item" :student="$student" lazy />
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
