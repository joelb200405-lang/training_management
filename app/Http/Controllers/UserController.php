<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\product_table;
use App\Models\User_tbl;
use Illuminate\Http\Request;
use Auth;
use Illuminate\support\Facades\DB;

class UserController extends Controller
{
    public $product;

    public function __construct()
    {
        $this->product = new product_table();
    }

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
        } else if($user->role === "teacher"){
            return redirect()->route("teacher");
        } else{
            return redirect()->route("admin");
        }
    }

    public function homepage(){

        $username = Auth::check() ? Auth::user()->username : null;
        return view(
            "student.homepage", ["username" => $username]);

    }
    public function admin1(){
        return view("admin.admin1");
    }
     public function teacher(){
        return view("trainer.teacher");
    }

}
