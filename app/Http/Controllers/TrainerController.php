<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;
 
class TrainerController extends Controller
{
    /**
     * Dashboard — stat cards + recent students + upcoming schedules
     */
    public function dashboard()
    {
        $trainer = Auth::user();
 
        // Courses assigned to this trainer
        $courses = Course::where('trainer_id', $trainer->id)->withCount('students')->get();
 
        // Stat counts
        $totalStudents  = $courses->sum('students_count');
        $totalCourses   = $courses->count();
 
        // Completion rate: students with status 'completed' / total enrolled
        $totalEnrolled  = $courses->sum(fn($c) => $c->students()->count());
        $totalCompleted = $courses->sum(fn($c) => $c->students()->wherePivot('status', 'completed')->count());
        $completionRate = $totalEnrolled > 0
            ? round(($totalCompleted / $totalEnrolled) * 100)
            : 0;
 
        // Recent 5 students across trainer's courses
        $recentStudents = User::whereHas('enrollments', fn($q) =>
                $q->whereIn('course_id', $courses->pluck('id'))
            )
            ->with(['enrollments' => fn($q) =>
                $q->whereIn('course_id', $courses->pluck('id'))->with('course')
            ])
            ->orderByDesc('created_at')
            ->take(5)
            ->get()
            ->each(fn($u) => $u->setRelation('pivot', $u->enrollments->first()));
 
        // Upcoming schedules (if you have a Schedule model)
        // $upcomingSchedules = Schedule::whereIn('course_id', $courses->pluck('id'))
        //     ->where('date', '>=', today())
        //     ->orderBy('date')
        //     ->take(5)
        //     ->with('course')
        //     ->get();
 
        return view('trainer.dashboard', compact(
            'totalStudents',
            'totalCourses',
            'completionRate',
            'recentStudents',
            // 'upcomingSchedules',
        ));
    }
 
    /**
     * My Courses
     */
    public function courses()
    {
        $trainer = Auth::user();
        $courses = Course::where('trainer_id', $trainer->id)
            ->withCount('students')
            ->get();
 
        return view('trainer.courses', compact('courses'));
    }
 
    /**
     * Course detail (optional)
     */
    public function courseShow($id)
    {
        $trainer = Auth::user();
        $course  = Course::where('trainer_id', $trainer->id)
            ->with(['students'])
            ->findOrFail($id);
 
        return view('trainer.course-detail', compact('course'));
    }
 
    /**
     * Students — all students enrolled in trainer's courses
     */
    public function students(Request $request)
    {
        $trainer = Auth::user();
        $courses = Course::where('trainer_id', $trainer->id)->get();
 
        $students = User::whereHas('enrollments', fn($q) =>
                $q->whereIn('course_id', $courses->pluck('id'))
            )
            ->with(['enrollments' => fn($q) =>
                $q->whereIn('course_id', $courses->pluck('id'))->with('course')
            ])
            ->get()
            ->each(fn($u) => $u->setRelation('pivot', $u->enrollments->first()));
 
        return view('trainer.students', compact('students', 'courses'));
    }
 
    /**
     * Schedule
     */
    public function schedule()
    {
        $trainer = Auth::user();
        $courses = Course::where('trainer_id', $trainer->id)->pluck('id');
 
        // $schedules = Schedule::whereIn('course_id', $courses)
        //     ->orderBy('date')
        //     ->with('course')
        //     ->get();
 
        return view('trainer.schedule', [
            'schedules' => collect(), // replace with real query above
        ]);
    }
 
    /**
     * Assessment
     */
    public function assessment()
    {
        $trainer = Auth::user();
        $courses = Course::where('trainer_id', $trainer->id)->get();
 
        // $assessments = Assessment::whereIn('course_id', $courses->pluck('id'))
        //     ->with(['student', 'course'])
        //     ->orderByDesc('date')
        //     ->get();
 
        return view('trainer.assessment', [
            'courses'     => $courses,
            'assessments' => collect(), // replace with real query
        ]);
    }
}