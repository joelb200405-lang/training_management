<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Course_tbl;
use App\Models\Enrollment_tbl;
use Illuminate\Console\Command;

class AutoFillAttendance extends Command
{
    protected $signature = 'attendance:auto-fill';

    protected $description = 'Marks any student without an attendance record today as present, for courses whose trainer never submitted attendance.';

    public function handle(): void
    {
        $today = now()->toDateString();

        $courses = Course_tbl::whereNotNull('trainer_id')->get();

        foreach ($courses as $course) {
            $enrollments = Enrollment_tbl::where('course_id', $course->id)
                ->where('status', 'active')
                ->get();

            if ($enrollments->isEmpty()) {
                continue;
            }

            // Find which of today's enrollments already have an attendance row
            // (whether the trainer submitted, or this already ran once today).
            $alreadyMarkedIds = Attendance::whereIn('enrollment_id', $enrollments->pluck('id'))
                ->where('date', $today)
                ->pluck('enrollment_id');

            $toAutoFill = $enrollments->whereNotIn('id', $alreadyMarkedIds);

            foreach ($toAutoFill as $enrollment) {
                Attendance::create([
                    'user_id'       => $enrollment->user_id,
                    'enrollment_id' => $enrollment->id,
                    'date'          => $today,
                    'status'        => 'present',
                    'marked_by'     => null,
                    'auto_marked'   => true,
                ]);
                // AttendanceObserver fires automatically here too,
                // recalculating progress just like a manual submission.
            }

            if ($toAutoFill->count() > 0) {
                $this->info("Auto-filled {$toAutoFill->count()} student(s) for {$course->title}.");
            }
        }

        $this->info('Auto-fill complete for ' . $today . '.');
    }
}