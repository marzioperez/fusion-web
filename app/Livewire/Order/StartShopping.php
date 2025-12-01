<?php

namespace App\Livewire\Order;

use App\Enums\ProductTypes;
use App\Models\Media;
use App\Models\Student;
use App\Models\MenuEntry;
use App\Settings\GeneralSettings;
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
        $cutoff = $now->copy()->setTime(19, 0, 0);

        // Por defecto, desde mañana
        $fromDay = $now->copy()->addDay();

        // Pasada las 7PM, desde pasado mañana
        if ($now->gt($cutoff)) {
            $fromDay->addDay();
        }

        $from = $fromDay->startOfDay();

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
            ->with('product')
            ->orderBy('date')
            ->get();

        // Agrupar por mes (current y next) y parsear items
        $grouped = $entries->groupBy(function ($entry) {
            return Carbon::parse($entry->date)->format('Y-m');
        })->map(function ($items, $ym) {
            $first = Carbon::createFromFormat('Y-m', $ym)->startOfMonth();
            $month = $first->translatedFormat('M.');
            $label = $month . ' - The whole month!';

            $group_label = $first->translatedFormat('F Y');

            // Calcular precio total del mes (suma de todos los productos de todos los MenuEntries del mes)
            $totalPrice = $items->sum(function ($entry) {
                return (float) ($entry->price ?? 0);
            });

            $image_url = null;
            $settings = new GeneralSettings();
            if ($settings->default_product_image) {
                $media = Media::find($settings->default_product_image);
                if ($media) {
                    $image_url = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
                }
            }

            // Producto sintético "The whole month!" al inicio
            $bundle = [
                'type' => ProductTypes::ALL_DAYS->value,
                'id' => 'bundle-' . $ym,
                'name' => 'All days!',
                'price' => round($totalPrice, 2),
                'entries_count' => $items->count(),
                'products_count' => $items->filter(fn ($e) => !is_null($e->product))->count(),
                'month_key' => $ym,
                'label' => $label,
                'items' => $items,
                'image_url' => $image_url
            ];

            $parsedItems = $items->map(fn ($e) => $this->parseMenuEntry($e, $month))->values();
            $itemsWithBundle = collect([$bundle])->merge($parsedItems)->values();

            return [
                'key' => $ym,
                'label' => $group_label,
                'items' => $itemsWithBundle,
            ];
        })->values();

        $this->menu_entries = collect($grouped);
    }

    public function parseMenuEntry(MenuEntry $entry, $month): array {
        $dt = Carbon::parse($entry->date);
        $image_url = null;
        $settings = new GeneralSettings();
        if ($settings->default_product_image) {
            $media = Media::find($settings->default_product_image);
            if ($media) {
                $image_url = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
            }
        }

        if ($entry->product['media_id']) {
            $media = Media::find($entry->product['media_id']);
            if ($media) {
                $image_url = ($media->hasGeneratedConversion('webp') ? $media->getFullUrl('webp') : $media->getUrl());
            }
        }

        return [
            'type' => ProductTypes::FOOD->value,
            'id' => $entry->id,
            'date' => $dt->toDateString(),
            'label' => $month . ' - ' . $dt->translatedFormat('l d'),
            'product_id' => $entry->product_id,
            'name' => $entry->product['name'],
            'price' => $entry->price,
            'offer_price' => $entry->offer_price,
            'school_id' => $entry->school_id,
            'grade_id' => $entry->grade_id,
            'image_url' => $image_url,
        ];
    }

    public function render() {
        return view('livewire.order.start-shopping')->layout($this->layout, ['header_position' => $this->header_position]);
    }
}
