<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
    
Route::get('/', function () {
    return view('landingpage');    //The first you will see.
});
// nilalagyan kolang ng ganto"//" kasi makakalimutan ako hehe joel*

Route::get("/login", [UserController::class, "Login"])->name("Login");
    //para matawag sa browser ang sign up 
Route::post("/login", [UserController::class, "LoginUser"])->name("LoginUser");

Route::get("/sign_up", [UserController::class, "SignupPage"])->name("SignupPage");

Route::post("/signup-form", [UserController::class, "SignUp"])->name("SignUp");

Route::get("/homepage", [UserController::class, "homepage"])->name("homepage");

Route::get("/handle", [UserController::class, "handle"])->name("handle");
//new

Route::get("/admin1", [UserController::class, "admin1"])->name("admin1")->middleware("admin");
Route::get("/trainees", [UserController::class, "trainees"])->name("trainees")->middleware("admin");

Route::get("/teacher", [UserController::class, "teacher"])->name("teacher");

//forgotpassword
// show forgot password (just a form)
Route::get("/forgotpassword", [UserController::class, "ForgotPassword"])->name("ForgotPassword");

//Email 

// send the resetlink email (when user submits the form)
Route::post("/forgotpassword", [UserController::class, "SendResetLink"])->name("SendResetLink");
// show the reset password page (when linking the button in email)
Route::get("/reset-password/{token}", [UserController::class, "ResetPasswordPage"])->name("ResetPasswordPage");
// Save the new password
Route::post("/reset-password", [UserController::class, "ResetPassword"])->name("ResetPassword");


//iya
Route::get("/adminlogin", [UserController::class, "adminlogin"])->name("adminlogin");

Route::post("/Logout", [UserController::class, "Logout"])->name("Logout");

//bocita
Route::get("/learner", [UserController::class, "learner"])->name("learner");
Route::get("/trainer/courses", [UserController::class, "courses"])->name("trainer.courses");
Route::get("/assessment", [UserController::class, "assessment"])->name("assessment");
Route::get("/certificates", [UserController::class, "certificates"])->name("certificates");
Route::get("/reports", [UserController::class, "reports"])->name("reports");
Route::get("/settings", [UserController::class, "settings"])->name("settings");


//cources 
Route::get("/courses", [UserController::class, "allCourses"])->name("all.courses");
Route::get("/courses/{id}", [UserController::class, "courseDetail"])->name("course.detail");
Route::post("/courses/{id}/enroll", [UserController::class, "enroll"])->name("course.enroll");
?>