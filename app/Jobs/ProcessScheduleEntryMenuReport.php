<?php

namespace App\Jobs;

use App\Exports\ScheduleEntryMenu;
use App\Mail\Report\ScheduleEntryMenusReport;
use App\Settings\GeneralSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProcessScheduleEntryMenuReport implements ShouldQueue {
    use Queueable;

    public function __construct(
        protected $from,
        protected $to,
        protected ?array $school_ids,
    ) {
    }

    public function handle(): void {
        // 1️⃣ Generar nombre y ruta del archivo
        $fileName = "menus-{$this->from}-{$this->to}.xlsx";
        $relativePath = "exports/schedule-entry-menus/{$fileName}";
        $disk = 'local';

        // Aseguramos carpeta
        Storage::disk($disk)->makeDirectory('exports/schedule-entry-menus');

        Excel::store(new ScheduleEntryMenu($this->from, $this->to, $this->school_ids), $relativePath, $disk);

        $fullPath = Storage::disk($disk)->path($relativePath);

        $settings = new GeneralSettings();
        if ($settings->send_admin_reports) {
            foreach ($settings->send_admin_reports as $email) {
                \Mail::to($email)->send(new ScheduleEntryMenusReport($this->from, $this->to, $fullPath, $fileName));
            }
        }

    }
}
