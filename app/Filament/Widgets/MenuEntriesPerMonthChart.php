<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\ScheduleEntryMenu;
use Carbon\Carbon;

class MenuEntriesPerMonthChart extends ChartWidget {

    protected ?string $heading = 'Menu sales per month';
    protected int | string | array $columnSpan = 'full';
    protected ?string $maxHeight = '450px';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $start = now()->subMonths(11)->startOfMonth();
        $end = now()->endOfYear();

        $rows = ScheduleEntryMenu::query()
            ->selectRaw("DATE_FORMAT(`date`, '%Y-%m') as month_key, COUNT(*) as total")
            ->whereBetween('date', [$start, $end])
            ->groupByRaw("DATE_FORMAT(`date`, '%Y-%m')")
            ->orderBy('month_key')
            ->get();

        $labels = [];
        $data = [];

        foreach ($rows as $row) {
            $labels[] = Carbon::createFromFormat('Y-m', $row->month_key)->translatedFormat('M Y');
            $data[] = (int) $row->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Menu sales per month',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string {
        return 'bar';
    }
}
