<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\DailyProgress;
use App\Models\Enrollment_tbl;

class ProgressService
{
    const ATTENDANCE_WEIGHT = 90;
    const ASSESSMENT_WEIGHT = 10;

    public function calculate(Enrollment_tbl $enrollment): int
    {
        $course = $enrollment->course;
        $durationDays = $course->duration_days ?? 15;

        $daysPresent = Attendance::where('enrollment_id', $enrollment->id)
            ->where('status', 'present')
            ->count();

        $attendancePercent = min(1, $daysPresent / max($durationDays, 1)) * self::ATTENDANCE_WEIGHT;

        $assessmentPercent = $this->calculateAssessmentPercent($enrollment) * (self::ASSESSMENT_WEIGHT / 100);

        return (int) round($attendancePercent + $assessmentPercent);
    }

    protected function calculateAssessmentPercent(Enrollment_tbl $enrollment): float
    {
        return 0;
    }

    public function recordToday(Enrollment_tbl $enrollment): int
    {
        $percent = $this->calculate($enrollment);

        $enrollment->progress = $percent;
        $enrollment->save();

        DailyProgress::updateOrCreate(
            [
                'enrollment_id' => $enrollment->id,
                'date'          => now()->toDateString(),
            ],
            [
                'user_id'          => $enrollment->user_id,
                'progress_percent' => $percent,
            ]
        );

        return $percent;
    }
}