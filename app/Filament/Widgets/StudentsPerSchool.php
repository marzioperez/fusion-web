<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;

class StudentsPerSchool extends ChartWidget {

    protected ?string $heading = 'Students per school';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected ?string $maxHeight = '600px';

    protected function getData(): array {
        $rows = Student::query()
            ->selectRaw('school_id, COUNT(*) as total')
            ->groupBy('school_id')
            ->with('school:id,name')
            ->get();

        $labels = $rows->map(fn($row) => $row->school?->name ?? 'None school')->toArray();
        $data = $rows->map(fn($row) => (int) $row->total)->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Students per school',
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
