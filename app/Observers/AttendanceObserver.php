<?php

namespace App\Observers;

use App\Models\Attendance;
use App\Services\ProgressService;

class AttendanceObserver
{
    public function saved(Attendance $attendance): void
    {
        $enrollment = $attendance->enrollment;

        if (! $enrollment) {
            return;
        }

        app(ProgressService::class)->recordToday($enrollment);
    }
}