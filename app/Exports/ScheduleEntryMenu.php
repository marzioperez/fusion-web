<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ScheduleEntryMenu implements FromView {

    protected array $params;

    public function __construct(array $params) {
        $this->params = $params;
    }

    public function view(): View {
        $model = \App\Models\ScheduleEntryMenu::query();
        $model->with('school');
        if ($this->params['school_id']) {
            $model->where('school_id', $this->params['school_id']);
        }
        $model->whereBetween('date', [$this->params['start_date'] . ' 00:00', $this->params['end_date'] . ' 23:59']);
        return view('exports.schedule-entry-menu', ['records' => $model->get()]);
    }
}
