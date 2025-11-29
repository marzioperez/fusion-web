<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-4">
            <div class="flex flex-wrap items-center gap-3">
                <x-filament::input.select wire:model.live="month">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endfor
                </x-filament::input.select>
                <x-filament::input.select wire:model.live="year">
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </x-filament::input.select>
            </div>
            <div class="fi-ta-content-ctn fi-fixed-positioning-context">
                <table class="fi-ta-table">
                    <thead>
                        <tr>
                            <th class="fi-ta-header-cell fi-ta-header-cell-name">Date</th>
                            <th class="fi-ta-header-cell fi-ta-header-cell-name">Product</th>
                            <th class="fi-ta-header-cell fi-ta-header-cell-name">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($rows as $row)
                            <tr class="fi-ta-row">
                                <td class="fi-ta-cell">
                                    <div class="fi-size-sm  fi-ta-text-item  fi-ta-text">{{$row['date']}}</div>
                                </td>
                                <td class="fi-ta-cell">
                                    <div class="fi-size-sm  fi-ta-text-item  fi-ta-text">{{$row['product']}}</div>
                                </td>
                                <td class="fi-ta-cell">
                                    <div class="fi-size-sm  fi-ta-text-item  fi-ta-text">{{$row['total_qty'] }}</div>
                                </td>
                            </tr>
                            @php $total += $row['total_qty']; @endphp
                        @endforeach
                        @if($total !== 0)
                            <tr class="fi-ta-row">
                                <td class="fi-ta-cell" colspan="2">
                                    <div class="fi-size-sm fi-ta-text-item  fi-ta-text"><b>Total: {{$total}}</b></div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
