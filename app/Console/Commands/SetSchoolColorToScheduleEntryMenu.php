<?php

namespace App\Console\Commands;

use App\Models\ScheduleEntryMenu;
use App\Models\School;
use Illuminate\Console\Command;

class SetSchoolColorToScheduleEntryMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-school-color-to-schedule-entry-menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle() {
        $schedule_entries = ScheduleEntryMenu::all();
        $progress_bar = $this->output->createProgressBar($schedule_entries->count());
        foreach ($schedule_entries as $schedule_entry) {
            $school = School::find($schedule_entry['school_id']);
            if ($school) {
                $schedule_entry->update(['color' => $school->color]);
            }
            $progress_bar->advance();
        }
        $progress_bar->finish();
    }
}
