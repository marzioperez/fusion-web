<div class="container" x-data="{ activeTab: '0' }">
    @foreach($menu_entries as $g => $group)
        <button x-on:click="activeTab = '{{$g}}'">
            {{ \Illuminate\Support\Str::ucfirst($group['label']) }}
        </button>
    @endforeach

        @foreach($menu_entries as $g => $group)
            <div x-show="activeTab === '{{ $g }}'">
                @foreach($group['items'] as $item)
                    @if($item['type'] === 'bundle')
                        <div class="mb-4 rounded border p-3">
                            <div class="font-semibold">{{ $item['name'] }}</div>
                            <div class="text-sm text-gray-600">
                                {{ ucfirst($group['label']) }} · {{ $item['entries_count'] }} días · {{ $item['products_count'] }} platos
                            </div>
                            <div class="mt-2 text-lg font-bold">S/ {{ number_format($item['total_price'], 2) }}</div>
                            <button class="mt-2 inline-flex items-center rounded bg-blue-600 px-3 py-1.5 text-white">
                                Comprar todo el mes
                            </button>
                        </div>
                    @else
                        <div class="flex items-center gap-3 py-2">
                            <span class="w-24 shrink-0">{{ ucfirst($item['display_date']) }}</span>
                            {{-- aquí info del menú del día --}}
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
</div>
