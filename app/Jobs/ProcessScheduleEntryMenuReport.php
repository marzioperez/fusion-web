<?php

namespace App\Jobs;

use App\Exports\ScheduleEntryMenu;
use App\Mail\Report\ScheduleEntryMenusReport;
use App\Models\School;
use App\Settings\GeneralSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProcessScheduleEntryMenuReport implements ShouldQueue {
    use Queueable;

    public function __construct(
        protected $from,
        protected $to,
        protected ?array $school_ids,
        protected bool $send_to_schools = false
    ) {
    }

    public function handle(): void {
        // Generar nombre y ruta del archivo
        $fileName = "menus-{$this->from}-{$this->to}.xlsx";
        $relativePath = "exports/schedule-entry-menus/{$fileName}";
        $disk = 'local';

        // Aseguramos carpeta
        Storage::disk($disk)->makeDirectory('exports/schedule-entry-menus');

        // Reporte general para los administradores
        Excel::store(new ScheduleEntryMenu($this->from, $this->to, $this->school_ids), $relativePath, $disk);
        $fullPath = Storage::disk($disk)->path($relativePath);

        $settings = new GeneralSettings();
        // Se envía el correo a los administradores
        if ($settings->send_admin_reports) {
            foreach ($settings->send_admin_reports as $email) {
                Mail::to($email)->send(new ScheduleEntryMenusReport($this->from, $this->to, $fullPath, $fileName));
            }
        }

        // Opcional, enviar a los colegios
        if ($this->send_to_schools) {
            $this->sendReportsToSchools($disk);
        }
    }

    protected function sendReportsToSchools(string $disk): void {
        // Query base con mismo rango y filtros que el reporte general
        $query = \App\Models\ScheduleEntryMenu::query()->whereBetween('date', [$this->from . ' 00:00:00', $this->to . ' 23:59:59']);
        if (!empty($this->school_ids)) {
            $query->whereIn('school_id', $this->school_ids);
        }

        // Se obtienen los colegios que SI tienen registros en ese rango
        $school_ids = $query->clone()->select('school_id')->distinct()->pluck('school_id');

        foreach ($school_ids as $school_id) {
            $school = School::find($school_id);
            if (!$school) {
                continue;
            }

            $emails = $school->emails;

            if (is_string($emails)) {
                $emails = json_encode($emails, true) ?? [];
            }

            if (!is_array($emails) || empty($emails)) {
                continue;
            }

            $schoolFileName = "menus-{$school->id}-{$this->from}-{$this->to}.xlsx";
            $schoolRelative = "exports/schedule-entry-menus/schools/{$schoolFileName}";
            Storage::disk($disk)->makeDirectory('exports/schedule-entry-menus/schools');

            Excel::store(
                new ScheduleEntryMenu($this->from, $this->to, [$school->id]),
                $schoolRelative,
                $disk
            );

            $schoolFullPath = Storage::disk($disk)->path($schoolRelative);

            foreach ($emails as $email) {
                if (! $email) {
                    continue;
                }

                Mail::to($email)->send(new ScheduleEntryMenusReport($this->from, $this->to, $schoolFullPath, $schoolFileName));
            }
        }
    }
}
