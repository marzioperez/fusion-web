<?php

namespace App\Livewire\Order;

use App\Models\Student;
use App\Models\MenuEntry;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;

class StartShopping extends Component {

    public $layout = 'components.layouts.app';
    public $header_position = 'sticky';
    public Collection $menu_entries;

    #[Url]
    public $code;

    public ?Student $student = null;

    public function mount() {
        if ($this->code) {
            $student = Student::where('code', $this->code)
                ->where('user_id', auth()->id())
                ->first();
            if (!$student) {
                $this->redirect(route('page', ['slug' => '/']));
                return;
            }
            $this->student = $student;
        } else {
            $this->redirect(route('page', ['slug' => '/']));
            return;
        }
        $this->menu_entries = collect();
        $this->loadMenu();
    }

    public function loadMenu() {
        if (!$this->student) {
            $this->menu_entries = collect();
            return;
        }

        $now = now();
        $from = $now->copy()->addDay()->startOfDay(); // día siguiente en adelante
        // Fin del siguiente mes calendario
        $endOfNextMonth = $now->copy()->addMonthNoOverflow(1)->endOfMonth();

        // Fechas bloqueadas por colegio (LockedDate.date)
        $lockedDates = optional($this->student->school)
            ?->locked_dates()
            ->pluck('date')
            ->map(fn ($d) => Carbon::parse($d)->toDateString())
            ->all() ?? [];

        // Consulta de MenuEntries por school/grade y rango, excluyendo bloqueados
        $entries = MenuEntry::query()
            ->where('school_id', $this->student->school_id)
            ->where('grade_id', $this->student->grade_id)
            ->whereDate('date', '>=', $from->toDateString())
            ->whereDate('date', '<=', $endOfNextMonth->toDateString())
            ->when(!empty($lockedDates), function ($q) use ($lockedDates) {
                $q->whereNotIn('date', $lockedDates);
            })
            ->with(['product:id,name,price'])
            ->orderBy('date')
            ->get();

        // Agrupar por mes (current y next) y parsear items
        $grouped = $entries->groupBy(function ($entry) {
            return Carbon::parse($entry->date)->format('Y-m');
        })->map(function ($items, $ym) {
            $first = Carbon::createFromFormat('Y-m', $ym)->startOfMonth();
            $label = $first->translatedFormat('F Y');

            // Calcular precio total del mes (suma de todos los productos de todos los MenuEntries del mes)
            $totalPrice = $items->sum(function ($entry) {
                return (float) ($entry->product->price ?? 0);
            });

            // Producto sintético "The whole month!" al inicio
            $bundle = [
                'type' => 'bundle',
                'id' => 'bundle-' . $ym,
                'name' => 'The whole month!',
                'total_price' => $totalPrice,
                'entries_count' => $items->count(),
                'products_count' => $items->filter(fn ($e) => !is_null($e->product))->count(),
                'month_key' => $ym,
                'label' => $label,
            ];

            $parsedItems = $items->map(fn ($e) => $this->parseMenuEntry($e))->values();
            $itemsWithBundle = collect([$bundle])->merge($parsedItems)->values();

            return [
                'key' => $ym,
                'label' => $label,
                'items' => $itemsWithBundle,
            ];
        })->values();

        $this->menu_entries = collect($grouped);
    }

    public function parseMenuEntry(MenuEntry $entry): array {
        $dt = Carbon::parse($entry->date);
        return [
            'type' => 'entry',
            'id' => $entry->id,
            'date' => $dt->toDateString(),
            'display_date' => $dt->translatedFormat('D d'),
            'weekday' => $dt->translatedFormat('l'),
            'school_id' => $entry->school_id,
            'grade_id' => $entry->grade_id,
        ];
    }

    public function render() {
        return view('livewire.order.start-shopping')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
