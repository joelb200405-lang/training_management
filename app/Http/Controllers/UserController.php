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
        $courses = \App\Models\Course_tbl::where('status', 'active')->get();
        return view("student.homepage", [
        "username" => $username,
        "courses" => $courses,
    ]);
}
    public function admin1(){
        return view("admin.admin1");
    }
     public function teacher(){
        return view("trainer.teacher");
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

     public function learner()
    {

        return view("trainer.learner");
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

}
