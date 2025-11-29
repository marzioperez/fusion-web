<?php

namespace App\Filament\Widgets;

use App\Models\ScheduleEntryMenu;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class TopDishesPerMonth extends Widget {

    protected string $view = 'filament.widgets.top-dishes-per-month';
    protected int | string | array $columnSpan = 'full';

    public string $month;
    public string $year;
    public array $rows = [];

    public function mount(): void {
        $this->month = now()->format('m');
        $this->year  = now()->format('Y');

        $this->loadData();
    }

    public function updated($property): void {
        if (in_array($property, ['month', 'year'])) {
            $this->loadData();
        }
    }

    protected function loadData(): void {
        $this->rows = ScheduleEntryMenu::query()
            ->select('product_id', DB::raw('COUNT(*) as total_qty'))
            ->with('product:id,name')
            ->whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->get()
            ->map(fn ($row) => [
                'product_name' => $row->product->name ?? 'Producto eliminado',
                'total_qty'    => (int) $row->total_qty,
            ])
            ->toArray();
    }

    public static function canView(): bool {
        return true;
    }
}
