<?php

namespace App\Console\Commands;

use App\Models\School;
use Illuminate\Console\Command;

class CreateStaffGradeToSchools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-staff-grade-to-schools';

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
        $schools = School::all();
        foreach ($schools as $school) {
            $school->grades()->createMany([
                ['name' => 'Staff', 'school_id' => $school->id]
            ]);
        }
    }
}
