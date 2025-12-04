<?php

namespace App\Jobs;

use App\Enums\Status;
use App\Mail\Communication\UserMail;
use App\Models\Communication;
use App\Models\Student;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessCommunication implements ShouldQueue {
    use Queueable;

    public function __construct(public int $communication_id) {
    }

    public function handle(): void {
        $communication = Communication::find($this->communication_id);
        if (!$communication) {
            return;
        }

        $students_query = Student::query()->whereNotNull('user_id');
        if (!$communication->send_all) {
            $school_ids = $communication->school_ids ?? [];
            if (empty($school_ids)) {
                return;
            }
            $students_query->whereIn('school_id', $school_ids);
        }

        $user_ids = $students_query->pluck('user_id')->filter()->unique()->values();

        $communication->update(['total_recipients' => $user_ids->count()]);

        if ($user_ids->isEmpty()) {
            $communication->update([
                'status' => Status::FINISHED->value,
                'sent_at' => now()
            ]);
            return;
        }

        User::whereIn('id', $user_ids)
            ->whereNotNull('email')
            ->chunkById(200, function ($parents) use ($communication) {
                foreach ($parents as $parent) {
                    Mail::to($parent->email)->queue(new UserMail($communication, $parent));
                }
            });

        $communication->update([
            'status' => Status::FINISHED->value,
            'sent_at' => now()
        ]);
    }

    public function failed(\Throwable $exception): void {
        Communication::where('id', $this->communication_id)->update([
            'status' => Status::ERROR->value
        ]);
    }
}
