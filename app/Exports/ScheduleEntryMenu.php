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

        // 1) Mapeamos a un array base por cada registro
        $records = $records->map(function ($item) {
            $dateFormatted = $item->date->format('d/m/Y');

            $detail = \App\Models\OrderItem::find($item->order_item_id);
            $order_code = null;
            if ($detail) {
                $order_code = $detail->order->code;
            }

            return [
                'school' => $item->school,
                'grade' => $item->grade,
                'teacher_name' => $item->teacher_name,
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'product' => $item->product,
                'color' => $item->color,
                'student_id' => $item->student_id,
                'date' => $dateFormatted,
                'order_code' => $order_code,
                'allergies' => $item->allergies,
                'quantity' => 1, // valor base
            ];
        });

        // 2) Agrupamos por alumno + fecha + producto + orden
        $records = $records
            ->groupBy(function ($item) {
                return implode('|', [
                    $item['student_id'],
                    $item['date'],
                    $item['product'],
                    $item['order_code'],
                ]);
            })
            ->map(function ($group) {
                $first = $group->first();
                // quantity = cantidad de registros en el grupo
                $first['quantity'] = $group->count();

                return $first;
            })
            // 3) Ordenamos por colegio y nombre como antes
            ->sortBy([
                ['school', 'asc'],
                ['first_name', 'asc'],
                ['last_name', 'asc'],
            ])
            ->values();

        // 4) Total de quantity (todos los almuerzos sumados)
        $total_quantity = $records->sum('quantity');

        return view('exports.schedule-entry-menu', [
            'records' => $records->toArray(),
            'total_quantity' => $total_quantity,
        ]);
    }
}
