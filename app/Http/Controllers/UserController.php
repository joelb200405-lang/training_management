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
    public function homepage(){
        $username = Auth::check() ? Auth::user()->username : null;
        
        // Latest 4 courses for "What's New"
        $newCourses = \App\Models\Course_tbl::where('status', 'active')
                        ->orderBy('id', 'desc')
                        ->take(4)
                        ->get();

        // Older courses for "Other Courses"
        $otherCourses = \App\Models\Course_tbl::where('status', 'active')
                        ->orderBy('id', 'asc')
                        ->skip(4)
                        ->take(4)
                        ->get();

        return view("student.homepage", [
            "username"     => $username,
            "newCourses"   => $newCourses,
            "otherCourses" => $otherCourses,
        ]);
    }
    public function admin1(){
        return view("admin.admin1");
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
        public function landingCourses(){
        $courses = \App\Models\Course_tbl::where('status', 'active')->get();
        return view("index", compact('courses'));
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
}
