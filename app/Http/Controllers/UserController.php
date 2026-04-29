<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\User_tbl;
use App\Models\Course_tbl;
use Illuminate\Http\Request;
use Auth;
use Illuminate\support\Facades\DB;
//Email
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;

class UserController extends Controller
{

    public function about_page()
    {

        return view("about");
    }

    public function SignupPage(){
        return view("student.sign_up");
    }

    public function Login(){
        return view("student.login");
    }

    public function SignUp(Request $request)
    {
        // dd($request->all());

        try {
            $request->validate(rules: [
                "firstname" => "required",
                "lastname" => "required",
                "email" => ["required", Rule::unique("user_tbls", "email")],
                "username" => "required",
                "password" => "required|confirmed",
                "role" => "in:student",
            ]);

            $user = User_tbl::create([
                "firstname" => $request->firstname,
                "lastname"  => $request->lastname,
                "email"     => $request->email,
                "username"  => $request->username,
                "password"  => bcrypt($request->password),
                "role"      => $request->role,
            ]);

            $user->sendEmailVerificationNotification();

            return redirect()->route("Login")->with('status', 'Account created! Please check your email to verify your account.');

        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getLine(), $e->getFile());
        }
    }

    public function LoginUser(Request $request){
        $textfiled = $request->validate([
            "email" => "required", 
            "password" => "required", 
        ]);
        
        if(auth()->attempt([
            'email' => $textfiled['email'],
            'password' => $textfiled['password'],
        ])
        
        ){
            $request->session()->regenerate();
            return redirect()->route("handle");
        }else{
             return redirect()->route("Login");
        }
    }

    public function handle(){
        $user = Auth::user();

        // Check if must reset password (first time trainer login)
        if($user->must_reset_password) {
            return redirect()->route("first.reset");
        }

        if($user->role === "student"){
            // if(!$user->hasVerifiedEmail()) {
            //     return redirect()->route("verification.notice");
            // }
            return redirect()->route("homepage");
        } else if($user->role === "trainer"){
            return redirect()->route("teacher");
        } else if($user->role == "admin"){
            return redirect()->route("admin1");
        } else{
            return redirect()->route("Login");
        }
    }

        public function homepage()
        {
            $userId = Auth::id();
        
            // ── Enrollments ───────────────────────────────────────────────────────────
            $enrollments = \App\Models\Enrollment_tbl::with('course')
                            ->where('user_id', $userId)
                            ->get();
        
            $selectedId = request('course_id');
            $enrollment = $selectedId
                ? $enrollments->firstWhere('course_id', $selectedId)
                : $enrollments->where('status', 'active')->first() ?? $enrollments->first();
        
            // ── Deadlines ─────────────────────────────────────────────────────────────
            $upcomingDeadlines = \App\Models\Deadline_tbl::where('due_date', '>=', now())
                                    ->where('due_date', '<=', now()->addDays(30))
                                    ->count();
        
            // ── Announcements ─────────────────────────────────────────────────────────
            $announcements = \App\Models\Announcement::active()->latest()->take(5)->get();
        
            // ── Modules / Quizzes / Results ───────────────────────────────────────────
            if ($enrollment) {
                $modules = \App\Models\Module::where('course_id', $enrollment->course_id)
                            ->active()->ordered()->get();
        
                $quizzes = \App\Models\Quiz::where('course_id', $enrollment->course_id)->get();
        
                $quizResults = \App\Models\QuizResult::where('user_id', $userId)
                                ->whereIn('quiz_id', $quizzes->pluck('id'))
                                ->get();
            } else {
                $modules     = collect();
                $quizzes     = collect();
                $quizResults = collect();
            }
        
            // ── Personal Analytics ────────────────────────────────────────────────────
        
            // 1. Stat cards
            $totalEnrolled  = $enrollments->count();
            $totalCompleted = $enrollments->where('status', 'completed')->count();
            $avgProgress    = $totalEnrolled > 0 ? round($enrollments->avg('progress')) : 0;
        
            // Total quizzes taken across all enrolled courses
            $allCourseIds   = $enrollments->pluck('course_id');
            $allQuizIds     = \App\Models\Quiz::whereIn('course_id', $allCourseIds)->pluck('id');
            $quizzesTaken   = \App\Models\QuizResult::where('user_id', $userId)
                                ->whereIn('quiz_id', $allQuizIds)
                                ->count();
            $quizzesPassed  = \App\Models\QuizResult::where('user_id', $userId)
                                ->whereIn('quiz_id', $allQuizIds)
                                ->where('status', 'passed')
                                ->count();
        
            // 2. Weekly progress — quiz results per day this week (Mon–Sun)
            $weeklyProgress = \App\Models\QuizResult::where('user_id', $userId)
                                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                                ->selectRaw('DAYOFWEEK(created_at) as dow, COUNT(*) as count')
                                ->groupBy('dow')
                                ->pluck('count', 'dow');
        
            // Build a Mon(2)–Sun(1) array, remap to index 0–6
            $weekDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $dowMap   = [2, 3, 4, 5, 6, 7, 1]; // MySQL DAYOFWEEK: 1=Sun, 2=Mon...
            $weeklyData = [];
            foreach ($dowMap as $dow) {
                $weeklyData[] = $weeklyProgress[$dow] ?? 0;
            }
        
            // 3. Donut chart — completion breakdown across all enrollments
            $notStarted  = $enrollments->where('progress', 0)->count();
            $inProgress  = $enrollments->where('progress', '>', 0)->where('status', '!=', 'completed')->count();
            $donutData   = [$totalCompleted, $inProgress, $notStarted];
        
            // 4. Recent activity — last 5 quiz results with quiz title
            $recentActivity = \App\Models\QuizResult::with('quiz')
                                ->where('user_id', $userId)
                                ->latest()
                                ->take(5)
                                ->get();
        
            return view('student.homepage', compact(
                'enrollments',
                'enrollment',
                'upcomingDeadlines',
                'announcements',
                'modules',
                'quizzes',
                'quizResults',
                // analytics
                'totalEnrolled',
                'totalCompleted',
                'avgProgress',
                'quizzesTaken',
                'quizzesPassed',
                'weekDays',
                'weeklyData',
                'donutData',
                'recentActivity'
            ));
        }
        public function admin1()
        {
            $courses  = \App\Models\Course_tbl::paginate(3);
            $allCourses   = \App\Models\Course_tbl::all(); 
            $trainers = \App\Models\User_tbl::where('role', 'trainer')->get();
            $trainees = \App\Models\User_tbl::where('role', 'student')->paginate(10, ['*'], 'trainee_page');
            $trainersList = \App\Models\User_tbl::where('role', 'trainer')->paginate(10, ['*'], 'trainer_page');
            $announcements = \App\Models\Announcement::latest()->paginate(10, ['*'], 'announcement_page');

            return view("admin.admin1", compact('courses', 'allCourses', 'trainers', 'trainees', 'trainersList', 'announcements'));
        }

public function assignTrainer(Request $request, $courseId)
{
    $request->validate([
        'trainer_id' => 'required|exists:user_tbls,id',
    ]);

    $course = \App\Models\Course_tbl::findOrFail($courseId);
    $course->trainer_id = $request->trainer_id;
    $course->save();

    return response()->json([
        'success' => true,
        'message' => 'Trainer assigned successfully!',
        'trainer' => \App\Models\User_tbl::find($request->trainer_id),
    ]);
}

// Idagdag ang removeTrainer() method:

public function removeTrainer($courseId)
{
    $course = \App\Models\Course_tbl::findOrFail($courseId);
    $course->trainer_id = null;
    $course->save();

    return response()->json([
        'success' => true,
        'message' => 'Trainer removed successfully!',
    ]);
}
    public function teacher()
    {
        // ── Existing stat cards ───────────────────────────────────────────────
        $totalTrainees     = \App\Models\Enrollment_tbl::where('status', 'active')->count();
    
        $monthlyEnrollment = \App\Models\Enrollment_tbl::whereMonth('enrolled_at', now()->month)
                            ->whereYear('enrolled_at', now()->year)
                            ->count();
    
        $completionRate    = \App\Models\Enrollment_tbl::count() > 0
                            ? round(\App\Models\Enrollment_tbl::where('status', 'completed')->count()
                            / \App\Models\Enrollment_tbl::count() * 100) . '%'
                            : '0%';
    
        $urgentAssessments = \App\Models\Deadline_tbl::where('due_date', '<=', now()->addDays(3))
                            ->where('due_date', '>=', now())
                            ->count();
    
        // ── Low performing trainees ───────────────────────────────────────────
        $lowPerforming = \App\Models\Enrollment_tbl::with(['user', 'course'])
                        ->where('status', 'active')
                        ->where('progress', '<', 50)
                        ->orderBy('progress', 'asc')
                        ->take(5)
                        ->get();
    
        // ── NEW: Progress distribution for donut chart ────────────────────────
        // Counts students in each progress bracket across all enrollments
        $allEnrollments = \App\Models\Enrollment_tbl::all();
    
        $progressDistribution = [
            $allEnrollments->where('status', 'completed')->count(),                                          // Completed
            $allEnrollments->where('status', '!=', 'completed')->where('progress', '>=', 50)->count(),      // 50–99%
            $allEnrollments->where('status', '!=', 'completed')->where('progress', '>', 0)->where('progress', '<', 50)->count(), // Below 50%
            $allEnrollments->where('progress', 0)->where('status', '!=', 'completed')->count(),              // Not started
        ];
    
        return view("trainer.teacher", compact(
            'totalTrainees',
            'monthlyEnrollment',
            'completionRate',
            'urgentAssessments',
            'lowPerforming',
            'progressDistribution'   // NEW
        ));
    }


    //forgotpassword

    public function ForgotPassword(){
         return view("student.forgotpassword");
    }

    //Email

    public function SendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);

    // Check if email exists in user_tbls
    $user = User_tbl::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'No account found with that email address.');
    }

    // Generate token
    $token = Str::random(64);

    // Save to password_reset_tokens table
    DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $request->email],
        [
            'token'      => $token,
            'created_at' => now(),
        ]
    );

    // Build reset link
    $resetLink = route('ResetPasswordPage', ['token' => $token]) . '?email=' . urlencode($request->email);

    // Send email
    Mail::to($request->email)->send(new ResetPasswordMail($resetLink));

    return back()->with('status', 'Reset link sent! Please check your email.');
}

public function ResetPasswordPage(Request $request, $token)
{
    return view('student.reset_password', [
        'token' => $token,
        'email' => $request->email,
    ]);
}

public function ResetPassword(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'token'    => 'required',
        'password' => 'required|confirmed|min:8',
    ]);

    // Check token
    $record = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->first();

    if (!$record) {
        return back()->with('error', 'Invalid or expired reset link.');
    }

    // Update password
    User_tbl::where('email', $request->email)->update([
        'password' => bcrypt($request->password),
    ]);

    // Delete token
    DB::table('password_reset_tokens')->where('email', $request->email)->delete();

    return redirect()->route('Login')->with('status', 'Password reset successfully! Please login.');


    }

        public function adminlogin()
    {

        return view("admin.adminlogin");
    }
    
            public function trainees()
    {

        return view("admin.trainees");
    }

    public function Logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('Login');
    }

    //bocita

    public function learner(){
    $enrollments = \App\Models\Enrollment_tbl::with(['user', 'course'])->get();

    $totalRegistered   = \App\Models\User_tbl::where('role', 'student')->count();
    $currentlyEnrolled = \App\Models\Enrollment_tbl::where('status', 'active')->count();
    $graduates         = \App\Models\Enrollment_tbl::where('status', 'completed')->count();
    $urgentAssessments = 0; // we'll update this later when we build assessments

    return view("trainer.learner", compact(
        'enrollments',
        'totalRegistered',
        'currentlyEnrolled',
        'graduates',
        'urgentAssessments'
    ));
    }

    public function courses()
    {
        $trainer = Auth::user();

        $course = Course_tbl::where('trainer_id', $trainer->id)->first();

        $totalStudents = $course
            ? \App\Models\Enrollment_tbl::where('course_id', $course->id)->count()
            : 0;

        return view('trainer.courses', compact('course', 'totalStudents'));
    }

    public function assessment()
    {
        $trainer = Auth::user();
        $course  = Course_tbl::where('trainer_id', $trainer->id)->first();

        if (!$course) {
            return view('trainer.assessment', [
                'course'       => null,
                'results'      => collect(),
                'totalTaken'   => 0,
                'avgScore'     => 0,
                'passingRate'  => 0,
                'topPerformers'=> collect(),
                'quizzes'      => collect(),
            ]);
        }

        // Kunin lahat ng quiz results ng course
        $results = \App\Models\QuizResult::with(['user', 'quiz'])
            ->whereHas('quiz', fn($q) => $q->where('course_id', $course->id))
            ->orderByDesc('created_at')
            ->get();

        // Stats
        $totalTaken  = $results->count();
        $avgScore    = $totalTaken > 0 ? round($results->avg('percentage')) : 0;
        $passed      = $results->where('status', 'passed')->count();
        $passingRate = $totalTaken > 0 ? round(($passed / $totalTaken) * 100) : 0;

        // Top performers — pinaka-mataas na average per student
        $topPerformers = \App\Models\QuizResult::with('user')
            ->whereHas('quiz', fn($q) => $q->where('course_id', $course->id))
            ->select('user_id', \DB::raw('ROUND(AVG(percentage)) as avg_score'), \DB::raw('COUNT(*) as total_taken'))
            ->groupBy('user_id')
            ->orderByDesc('avg_score')
            ->take(5)
            ->get();

        // Quizzes ng course
        $quizzes = \App\Models\Quiz::where('course_id', $course->id)->get();

        return view('trainer.assessment', compact(
            'course',
            'results',
            'totalTaken',
            'avgScore',
            'passingRate',
            'topPerformers',
            'quizzes'
        ));
    }

      public function certificates()
    {

        return view("trainer.certificates");
    }

     public function reports()
    {

        return view("trainer.reports");
    }

       public function settings()
    {

        return view("trainer.settings");
    }
        //ctudent leaner
    public function allCourses(){
    $courses = \App\Models\Course_tbl::where('status', 'active')->get();
    return view("student.all_courses", compact('courses'));
}

public function courseDetail($id){
    $course = \App\Models\Course_tbl::findOrFail($id);
    return view("student.course_detail", compact('course'));
}

public function enroll(Request $request, $id){
    $course = \App\Models\Course_tbl::findOrFail($id);

    // Count current enrollments
    $enrolledCount = \App\Models\Enrollment_tbl::where('course_id', $id)->count();

    // Check if no more slots
    if($enrolledCount >= $course->slots){
        return back()->with('error', 'Sorry, no more slots available for this course!');
    }

    // Check if already enrolled
    $existing = \App\Models\Enrollment_tbl::where('user_id', Auth::id())
                ->where('course_id', $id)
                ->first();

    if($existing){
        return back()->with('error', 'You are already enrolled in this course!');
    }

    // Enroll the student
    \App\Models\Enrollment_tbl::create([
        'user_id'     => Auth::id(),
        'course_id'   => $id,
        'status'      => 'active',
        'progress'    => 0,
        'enrolled_at' => now(),
    ]);

    return back()->with('success', 'Successfully enrolled in ' . $course->title . '!');
}

//contact
public function contact(){
    return view("student.contact");
}

    public function sendContact(Request $request){
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ]);

        // For now just redirect with success message
        // Later we can add email sending feature
        return back()->with('success', 'Your message has been sent! We will contact you within 24 hours.');
    }

//landingpage contact
        public function landingContact(){
        return view("landing_contact");
    }

    public function landingContactSend(Request $request){
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ]);

        return back()->with('success', 'Your message has been sent! We will contact you within 24 hours.');
    }

    public function landingAbout(){
    $totalStudents = \App\Models\User_tbl::where('role', 'student')->count();
    $totalCourses  = \App\Models\Course_tbl::where('status', 'active')->count();
    $totalTrainers = \App\Models\User_tbl::where('role', 'trainer')->count();

    return view("landing_about", compact(
        'totalStudents',
        'totalCourses',
        'totalTrainers'
    ));
    }
    //about
        public function index(){
        $courses = \App\Models\Course_tbl::where('status', 'active')->get();
        $totalStudents = \App\Models\User_tbl::where('role', 'student')->count();
        $totalCourses  = \App\Models\Course_tbl::where('status', 'active')->count();
        $totalTrainers = \App\Models\User_tbl::where('role', 'trainer')->count();
        return view("index", compact(
            'courses',
            'totalStudents',
            'totalCourses',
            'totalTrainers'
            ));
    }

    public function landingCourseDetail($id){
        $course = \App\Models\Course_tbl::findOrFail($id);
        return view("landing_course_detail", compact('course'));
    }

    public function about(){
    $totalStudents = \App\Models\User_tbl::where('role', 'student')->count();
    $totalCourses  = \App\Models\Course_tbl::where('status', 'active')->count();
    $totalTrainers = \App\Models\User_tbl::where('role', 'trainer')->count();

    return view("student.about", compact(
        'totalStudents',
        'totalCourses',
        'totalTrainers'
    ));
    }

    //dashboard
public function dashboard()
{
    $userId = Auth::id();

    // My enrollments with course info
    $enrollments = \App\Models\Enrollment_tbl::with('course')
                    ->where('user_id', $userId)
                    ->get();

    // Stats
    $totalEnrolled   = $enrollments->count();
    $totalCompleted  = $enrollments->where('status', 'completed')->count();
    $avgProgress     = $totalEnrolled > 0
                        ? round($enrollments->avg('progress'))
                        : 0;

    // Upcoming deadlines (next 30 days)
    $deadlines = \App\Models\Deadline_tbl::where('due_date', '>=', now())
                    ->where('due_date', '<=', now()->addDays(30))
                    ->orderBy('due_date', 'asc')
                    ->get();

    $upcomingDeadlines = $deadlines->count();

    return view('student.dashboard', compact(
        'enrollments',
        'totalEnrolled',
        'totalCompleted',
        'avgProgress',
        'upcomingDeadlines',
        'deadlines'
    ));
}

// ── COURSE CONTENT (Modules & Quizzes) ────────────────────────────────────

    public function getCourseContent($courseId)
    {
        $modules = \App\Models\Module::where('course_id', $courseId)
                         ->orderBy('order')
                         ->get(['id', 'title', 'description', 'order', 'is_active']);

        $quizzes = \App\Models\Quiz::where('course_id', $courseId)
                       ->with('module')
                       ->get();

        return response()->json([
            'modules' => $modules,
            'quizzes' => $quizzes,
        ]);
    }

    // ── MODULES ───────────────────────────────────────────────────────────────

    public function storeModule(Request $request)
    {
        $request->validate([
            'course_id'   => 'required|exists:course_tbls,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $order = \App\Models\Module::where('course_id', $request->course_id)->max('order') + 1;

        $filePath = null;
        $fileType = null;
        $fileSize = null;

        if ($request->hasFile('file')) {
            $file     = $request->file('file');
            $filePath = $file->store('modules', 'public');
            $fileType = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
        }

        $module = \App\Models\Module::create([
            'course_id'   => $request->course_id,
            'title'       => $request->title,
            'description' => $request->description,
            'order'       => $order,
            'is_active'   => true,
            'file_path'   => $filePath,
            'file_type'   => $fileType,
            'file_size'   => $fileSize,
        ]);

        return response()->json(['success' => true, 'module' => $module]);
    }

    public function destroyModule($id)
    {
        $module = \App\Models\Module::findOrFail($id);
        $module->delete();
        return response()->json(['success' => true]);
    }

    // ── QUIZZES ───────────────────────────────────────────────────────────────

    public function storeQuiz(Request $request)
    {
        $request->validate([
            'course_id'     => 'required|exists:course_tbls,id',
            'module_id'     => 'nullable|exists:modules,id',
            'title'         => 'required|string|max:255',
            'passing_score' => 'required|integer|min:1|max:100',
            'time_limit'    => 'required|integer|min:1',
        ]);

        $quiz = \App\Models\Quiz::create($request->only(
            'course_id', 'module_id', 'title', 'passing_score', 'time_limit'
        ));

        $quiz->load('module');

        return response()->json(['success' => true, 'quiz' => $quiz]);
    }

    public function destroyQuiz($id)
    {
        $quiz = \App\Models\Quiz::findOrFail($id);
        $quiz->delete();
        return response()->json(['success' => true]);
    }

    // ── QUIZ QUESTIONS (Admin) ────────────────────────────────────────────────

public function getQuizQuestions($quizId)
{
    $questions = \App\Models\QuizQuestion::where('quiz_id', $quizId)
                    ->orderBy('order')
                    ->get();
    return response()->json(['success' => true, 'questions' => $questions]);
}

public function storeQuizQuestion(Request $request)
{
    $request->validate([
        'quiz_id'        => 'required|exists:quizzes,id',
        'question'       => 'required|string',
        'choice_a'       => 'required|string',
        'choice_b'       => 'required|string',
        'choice_c'       => 'required|string',
        'choice_d'       => 'required|string',
        'correct_answer' => 'required|in:a,b,c,d',
    ]);

    $order = \App\Models\QuizQuestion::where('quiz_id', $request->quiz_id)->max('order') + 1;

    $question = \App\Models\QuizQuestion::create([
        'quiz_id'        => $request->quiz_id,
        'question'       => $request->question,
        'choice_a'       => $request->choice_a,
        'choice_b'       => $request->choice_b,
        'choice_c'       => $request->choice_c,
        'choice_d'       => $request->choice_d,
        'correct_answer' => $request->correct_answer,
        'order'          => $order,
    ]);

    return response()->json(['success' => true, 'question' => $question]);
}

public function destroyQuizQuestion($id)
{
    $question = \App\Models\QuizQuestion::findOrFail($id);
    $question->delete();
    return response()->json(['success' => true]);
}

// ── QUIZ TAKING (Student) ─────────────────────────────────────────────────

public function getQuizForStudent($quizId)
{
    $userId = \Auth::id();

    // Check if already taken
    $existing = \App\Models\QuizResult::where('quiz_id', $quizId)
                    ->where('user_id', $userId)
                    ->first();

    $quiz = \App\Models\Quiz::with('questions')->findOrFail($quizId);

    return response()->json([
        'success'  => true,
        'quiz'     => $quiz,
        'taken'    => $existing ? true : false,
        'result'   => $existing,
    ]);
}

    public function submitQuiz(Request $request)
    {
    $request->validate([
        'quiz_id' => 'required|exists:quizzes,id',
        'answers' => 'required|array',
    ]);

    $userId = \Auth::id();
    $quiz   = \App\Models\Quiz::with('questions')->findOrFail($request->quiz_id);

    // Check if already taken
    $existing = \App\Models\QuizResult::where('quiz_id', $request->quiz_id)
                    ->where('user_id', $userId)
                    ->first();
    if ($existing) {
        return response()->json(['success' => false, 'message' => 'Already taken.']);
    }

    // Score
    $score = 0;
    $total = $quiz->questions->count();

    foreach ($quiz->questions as $q) {
        $answer = $request->answers[$q->id] ?? null;
        if ($answer && strtolower($answer) === $q->correct_answer) {
            $score++;
        }
    }

    $percentage = $total > 0 ? round(($score / $total) * 100) : 0;
    $status     = $percentage >= $quiz->passing_score ? 'passed' : 'failed';

    $result = \App\Models\QuizResult::create([
        'quiz_id'     => $request->quiz_id,
        'user_id'     => $userId,
        'score'       => $score,
        'total_items' => $total,
        'percentage'  => $percentage,
        'status'      => $status,
    ]);

        // I-update ang enrollment progress
    $enrollment = \App\Models\Enrollment_tbl::where('user_id', $userId)
        ->where('course_id', $quiz->course_id)
        ->first();

    if ($enrollment) {
        // Kunin lahat ng quizzes ng course
        $totalQuizzes = \App\Models\Quiz::where('course_id', $quiz->course_id)->count();
        
        // Kunin kung ilan na ang natapos ng student
        $completedQuizzes = \App\Models\QuizResult::where('user_id', $userId)
            ->whereIn('quiz_id', \App\Models\Quiz::where('course_id', $quiz->course_id)->pluck('id'))
            ->count();

        // I-compute ang progress percentage
        $progress = $totalQuizzes > 0
            ? round(($completedQuizzes / $totalQuizzes) * 100)
            : 0;

        $enrollment->progress = $progress;

        // Kung 100% na, i-mark as completed
        if ($progress >= 100) {
            $enrollment->status = 'completed';
            $enrollment->completed_at = now();
        }

        $enrollment->save();
    }

    return response()->json([
        'success'    => true,
        'score'      => $score,
        'total'      => $total,
        'percentage' => $percentage,
        'status'     => $status,
        'passing'    => $quiz->passing_score,
        'progress'   => $progress ?? 0, 
    ]);
    }


// Ilagay sa UserController.php (o TrainerController.php)
// Huwag kalimutang i-import ang models sa itaas ng file:
// use App\Models\Course_tbl;
// use App\Models\User_tbl;

public function trainerStudents()
{
    $trainer = Auth::user();

    // Kunin ang course na naka-assign sa trainer
    $course = Course_tbl::where('trainer_id', $trainer->id)->first();

    // Kung walang course, i-return agad ng empty
    if (!$course) {
        return view('trainer.students', [
            'course'   => null,
            'students' => collect(),
        ]);
    }

    // Kunin lahat ng students enrolled sa course ng trainer
    // via enrollment_tbls JOIN user_tbls
    $students = User_tbl::join('enrollment_tbls', 'user_tbls.id', '=', 'enrollment_tbls.user_id')
        ->where('enrollment_tbls.course_id', $course->id)
        ->where('user_tbls.role', 'student')   // i-adjust kung iba ang role name mo
        ->select(
            'user_tbls.id',
            'user_tbls.firstname',
            'user_tbls.lastname',
            'user_tbls.email',
            'enrollment_tbls.status',
            'enrollment_tbls.progress',
            'enrollment_tbls.enrolled_at',
        )
        ->orderBy('enrollment_tbls.enrolled_at', 'desc')
        ->get();

    return view('trainer.students', compact('course', 'students'));
    }

    public function trainerSchedule()
{
    $trainer = Auth::user();
 
    $course = Course_tbl::where('trainer_id', $trainer->id)->first();
 
    $totalStudents = $course
        ? \App\Models\Enrollment_tbl::where('course_id', $course->id)->count()
        : 0;
 
    return view('trainer.schedule', compact('course', 'totalStudents'));
}

    public function storeTrainer(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
            'email'     => 'required|email|unique:user_tbls,email',
            'password'  => 'required|min:6',
            'course_id' => 'nullable|exists:course_tbls,id',
        ]);

        $trainer = \App\Models\User_tbl::create([
            'firstname'            => $request->firstname,
            'lastname'             => $request->lastname,
            'email'                => $request->email,
            'username'             => strtolower($request->firstname . '.' . $request->lastname),
            'password'             => bcrypt($request->password),
            'role'                 => 'trainer',
            'must_reset_password'  => true,
        ]);

        // I-assign sa course kung may pinili
        if ($request->course_id) {
            \App\Models\Course_tbl::where('id', $request->course_id)
                ->update(['trainer_id' => $trainer->id]);
        }

        return response()->json(['success' => true]);
    }

    // ── FIRST TIME RESET PASSWORD ─────────────────────────────────────────────
    public function firstResetPage()
    {
        if (!Auth::check() || !Auth::user()->must_reset_password) {
            return redirect()->route("Login");
        }
        return view("student.first_reset");
    }

    public function firstResetSave(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.min'       => 'Ang password ay dapat hindi bababa sa 6 na characters.',
            'password.confirmed' => 'Hindi magkatugma ang mga password. Subukan ulit.',
            'password.required'  => 'Kailangan ng password.',
        ]);

        $user = Auth::user();
        $user->password            = bcrypt($request->password);
        $user->must_reset_password = false;
        $user->save();

        return redirect()->route("handle");
    }

    // ── STUDENT PROFILE ───────────────────────────────────────────────────────

    public function studentProfile()
    {
        $user        = Auth::user();
        $enrollments = \App\Models\Enrollment_tbl::with('course')
                        ->where('user_id', $user->id)
                        ->get();

        $avgProgress    = $enrollments->count() > 0
                            ? round($enrollments->avg('progress'))
                            : 0;
        $completedCount = $enrollments->where('status', 'completed')->count();

        return view('student.profile', compact('user', 'enrollments', 'avgProgress', 'completedCount'));
    }

    public function studentProfileUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname'  => 'required|string|max:100',
            'email'     => 'required|email|unique:user_tbls,email,' . $user->id,
            'username'  => 'required|string|max:100|unique:user_tbls,username,' . $user->id,
        ]);

        User_tbl::where('id', $user->id)->update([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'username'  => $request->username,
        ]);

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully!');
    }

    public function studentProfilePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('student.profile')
                ->with('error', 'Current password is incorrect.');
        }

        User_tbl::where('id', $user->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('student.profile')->with('success', 'Password updated successfully!');
    }

    // ── TRAINER PROFILE ───────────────────────────────────────────────────────

    public function trainerProfile()
    {
        $user   = Auth::user();
        $course = Course_tbl::where('trainer_id', $user->id)->first();

        $totalStudents = $course
            ? \App\Models\Enrollment_tbl::where('course_id', $course->id)->count()
            : 0;

        return view('trainer.profile', compact('user', 'course', 'totalStudents'));
    }

    public function trainerProfileUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname'  => 'required|string|max:100',
            'email'     => 'required|email|unique:user_tbls,email,' . $user->id,
            'username'  => 'required|string|max:100|unique:user_tbls,username,' . $user->id,
        ]);

        User_tbl::where('id', $user->id)->update([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'username'  => $request->username,
        ]);

        return redirect()->route('trainer.profile')->with('success', 'Profile updated successfully!');
    }

    public function trainerProfilePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('trainer.profile')
                ->with('error', 'Current password is incorrect.');
        }

        User_tbl::where('id', $user->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('trainer.profile')->with('success', 'Password updated successfully!');
        }

        // ── ANNOUNCEMENTS ─────────────────────────────────────────────────────────
            public function storeAnnouncement(Request $request)
            {
                $request->validate([
                    'title'   => 'required|string|max:255',
                    'message' => 'required|string',
                    'type'    => 'required|in:reminder,notice,urgent',
                ]);

                \App\Models\Announcement::create([
                    'title'     => $request->title,
                    'message'   => $request->message,
                    'type'      => $request->type,
                    'is_active' => true,
                ]);

                return response()->json(['success' => true]);
            }

            public function updateAnnouncement(Request $request, $id)
            {
                $request->validate([
                    'title'   => 'required|string|max:255',
                    'message' => 'required|string',
                    'type'    => 'required|in:reminder,notice,urgent',
                ]);

                $announcement = \App\Models\Announcement::findOrFail($id);
                $announcement->update($request->only('title', 'message', 'type'));

                return response()->json(['success' => true]);
            }

            public function destroyAnnouncement($id)
            {
                $announcement = \App\Models\Announcement::findOrFail($id);
                $announcement->delete();
                return response()->json(['success' => true]);
            }

            public function toggleAnnouncement($id)
            {
                $announcement = \App\Models\Announcement::findOrFail($id);
                $announcement->is_active = !$announcement->is_active;
                $announcement->save();
                return response()->json(['success' => true, 'is_active' => $announcement->is_active]);
        
            }

            public function studentModules(Request $request)
    {
        $userId = Auth::id();
    
        // Lahat ng enrollments ng student
        $enrollments = \App\Models\Enrollment_tbl::with('course')
                        ->where('user_id', $userId)
                        ->get();
    
        // Piliin ang course — mula sa ?course_id= o default sa active/first
        $selectedId  = $request->get('course_id');
        $enrollment  = $selectedId
            ? $enrollments->firstWhere('course_id', $selectedId)
            : $enrollments->where('status', 'active')->first() ?? $enrollments->first();
    
        if ($enrollment) {
            $modules = \App\Models\Module::where('course_id', $enrollment->course_id)
                        ->active()
                        ->ordered()
                        ->get();
    
            $quizzes = \App\Models\Quiz::where('course_id', $enrollment->course_id)->get();
    
            $quizResults = \App\Models\QuizResult::where('user_id', $userId)
                            ->whereIn('quiz_id', $quizzes->pluck('id'))
                            ->get();
        } else {
            $modules     = collect();
            $quizzes     = collect();
            $quizResults = collect();
        }
    
        return view('student.modules', compact(
            'enrollments',
            'enrollment',
            'modules',
            'quizzes',
            'quizResults'
        ));
    }
    }
    

