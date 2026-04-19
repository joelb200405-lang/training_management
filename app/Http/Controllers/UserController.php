<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\product_table;
use App\Models\User_tbl;
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
                "role" => "required",
            ]);

            User_tbl::create([
                "firstname" => $request->firstname,
                "lastname" => $request->lastname,
                "email" => $request->email,
                "username" => $request->username,
                "password" => bcrypt($request->password),
                "role" => $request->role,
            ]);

            return redirect()->route("Login");

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

        if($user->role === "student"){
            return redirect()->route("homepage");
        } else if($user->role === "trainer"){
            return redirect()->route("teacher");
        } else if($user->role == "admin"){
            return redirect()->route("admin1");
        } else{
            return redirect()->route("Login");
        }
    }
        //new (temporary)
// I-update ang homepage() method sa UserController.php

public function homepage()
{
    $userId = Auth::id();

    $enrollment = \App\Models\Enrollment_tbl::with('course')
                    ->where('user_id', $userId)
                    ->where('status', 'active')
                    ->first();

    $upcomingDeadlines = \App\Models\Deadline_tbl::where('due_date', '>=', now())
                            ->where('due_date', '<=', now()->addDays(30))
                            ->count();

    $announcements = \App\Models\Announcement::active()->latest()->take(5)->get();

    if ($enrollment) {
        $modules = \App\Models\Module::where('course_id', $enrollment->course_id)
                    ->active()->ordered()->get();
    } else {
        $modules = collect();
    }

    return view('student.homepage', compact(
        'enrollment',
        'upcomingDeadlines',
        'announcements',
        'modules'
    ));
}
public function admin1()
{
    $courses = \App\Models\Course_tbl::paginate(3);
    $trainers = \App\Models\User_tbl::where('role', 'trainer')->get();

    return view("admin.admin1", compact('courses', 'trainers'));
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
public function teacher(){
    // Stat cards
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

    // Low performing trainees (progress below 50%)
    $lowPerforming = \App\Models\Enrollment_tbl::with(['user', 'course'])
                     ->where('status', 'active')
                     ->where('progress', '<', 50)
                     ->orderBy('progress', 'asc')
                     ->take(5)
                     ->get();

    // Upcoming deadlines
    $deadlines = \App\Models\Deadline_tbl::where('due_date', '>=', now())
                 ->orderBy('due_date', 'asc')
                 ->take(5)
                 ->get();

    return view("trainer.teacher", compact(
        'totalTrainees',
        'monthlyEnrollment',
        'completionRate',
        'urgentAssessments',
        'lowPerforming',
        'deadlines'
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

        return view("trainer.courses");
    }

       public function assessment()
    {

        return view("trainer.assessment");
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

    

}
