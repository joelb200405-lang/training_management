<?php

namespace App\Services;

use App\Models\Course_tbl;
use Carbon\Carbon;

class CourseScheduleService
{
    protected array $dayOrder = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

    /**
     * Checks whether a course is scheduled to meet on the given date
     * (defaults to today), based on its free-text `schedule` field
     * (e.g. "Mon-Fri 8:00 AM", "Wed-Thu 10:00 AM").
     *
     * If the schedule can't be parsed at all, we default to TRUE
     * (don't block attendance) rather than silently locking trainers
     * out over a data-formatting issue.
     */
    public function isInSessionToday(Course_tbl $course, ?Carbon $date = null): bool
    {
        $date = $date ?? now();
        $todayAbbr = $date->format('D'); // "Mon", "Tue", etc.

        $scheduleDays = $this->parseDays($course->schedule);

        if (empty($scheduleDays)) {
            return true;
        }

        return in_array($todayAbbr, $scheduleDays, true);
    }

    protected function parseDays(?string $schedule): array
    {
        if (!$schedule) {
            return [];
        }

        preg_match_all('/Mon|Tue|Wed|Thu|Fri|Sat|Sun/i', $schedule, $matches);
        $found = array_values(array_unique(array_map(
            fn ($d) => ucfirst(strtolower($d)),
            $matches[0]
        )));

        // "Mon-Fri" style range: exactly two days found, and a dash present
        if (count($found) === 2 && str_contains($schedule, '-')) {
            return $this->expandRange($found[0], $found[1]);
        }

        // "Mon, Wed, Fri" style explicit list, or a single day
        return $found;
    }

    protected function expandRange(string $start, string $end): array
    {
        $startIdx = array_search($start, $this->dayOrder);
        $endIdx = array_search($end, $this->dayOrder);

        if ($startIdx === false || $endIdx === false) {
            return [$start, $end];
        }

        $days = [];
        $i = $startIdx;
        while (true) {
            $days[] = $this->dayOrder[$i];
            if ($i === $endIdx) break;
            $i = ($i + 1) % 7;
        }

        return $days;
    }
}