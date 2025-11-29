<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ScheduleEntryMenu implements FromView {

    public function __construct(
        protected string $from,
        protected string $to,
        protected ?array $school_ids = null
    ) {
    }

    public function view(): View {
        $model = \App\Models\ScheduleEntryMenu::query();
        if (!empty($this->school_ids)) {
            $model->whereIn('school_id', $this->school_ids);
        }

        $records = $model->whereBetween('date', [$this->from . ' 00:00', $this->to . ' 23:59'])->get();

        // Detectar combinaciones repetidas (student_id + date)
        $duplicatedKeys = $records
            ->groupBy(function ($item) {
                return $item->student_id.'|'.$item->date->format('d/m/Y');
            })
            ->filter(function ($group) {
                return $group->count() > 1; // solo las que se repiten
            })
            ->keys(); // colección de strings "student_id|YYYY-MM-DD"

        // Se ordenan y mapean agregando el indicador de duplicidad
        $records = $records->sortBy([
            ['school', 'asc'],
            ['first_name', 'asc'],
            ['last_name', 'asc']
        ])->groupBy(['school', 'grade'])
            ->flatMap(function ($school_group, $school_name) use ($duplicatedKeys) {
                return $school_group->flatMap(function ($grade_group, $grade_name) use ($school_name, $duplicatedKeys) {
                    return $grade_group->map(function ($item) use ($school_name, $grade_name, $duplicatedKeys) {
                        $dateFormatted = $item->date->format('d/m/Y');
                        $key = $item->student_id . '|' . $dateFormatted;

                        $detail = \App\Models\OrderItem::find($item->order_item_id);
                        $order_code = null;
                        if ($detail) {
                            $order_code = $detail->order->code;
                        }

                        // true si el alumno tiene más de un item ese mismo día
                        $isDuplicated = $duplicatedKeys->contains($key);

                        return [
                            'school' => $school_name,
                            'grade' => $grade_name,
                            'first_name' => $item->first_name,
                            'last_name' => $item->last_name,
                            'product' => $item->product,
                            'color' => $item->color,
                            'student_id' => $item->student_id,
                            'date' => $item->date->format('d/m/Y'),
                            'is_duplicate' => $isDuplicated,
                            'order_code' => $order_code,
                            'allergies' => $item->allergies
                        ];
                    });
                });
            })->values();

        return view('exports.schedule-entry-menu', ['records' => $records->toArray()]);
    }
}
