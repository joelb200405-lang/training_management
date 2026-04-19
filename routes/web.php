<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainerController;
    
Route::get('/', [UserController::class, 'index'])->name('index');   //The first you will see.
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
Route::post("/admin/course/{courseId}/assign-trainer", [UserController::class, "assignTrainer"])
    ->name("admin.course.assignTrainer")
    ->middleware("admin");
Route::post("/admin/course/{courseId}/remove-trainer", [UserController::class, "removeTrainer"])
    ->name("admin.course.removeTrainer")
    ->middleware("admin");
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

//contact
Route::get("/contact", [UserController::class, "contact"])->name("contact");
Route::post("/contact", [UserController::class, "sendContact"])->name("contact.send");
//only for landingpage
Route::get("/contact-us", [UserController::class, "landingContact"])->name("landing.contact");
Route::post("/contact-us", [UserController::class, "landingContactSend"])->name("landing.contact.send");
Route::get("/about", [UserController::class, "landingAbout"])->name("landing.about");

Route::get("/our-courses/{id}", [UserController::class, "landingCourseDetail"])->name("landing.course.detail");
//student about
Route::get("/student/about", [UserController::class, "about"])->name("about");
//dashboard for trainee
// Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');


// ── MODULES & QUIZZES (Admin) ──
Route::get("/admin/course/{courseId}/content", [UserController::class, "getCourseContent"])
    ->name("admin.course.content")
    ->middleware("admin");

Route::post("/admin/module", [UserController::class, "storeModule"])
    ->name("admin.module.store")
    ->middleware("admin");

Route::match(['POST', 'DELETE'], "/admin/module/{id}", [UserController::class, "destroyModule"])
    ->name("admin.module.destroy")
    ->middleware("admin");


Route::post("/admin/quiz", [UserController::class, "storeQuiz"])
    ->name("admin.quiz.store")
    ->middleware("admin");

Route::match(['POST', 'DELETE'], "/admin/quiz/{id}", [UserController::class, "destroyQuiz"])
    ->name("admin.quiz.destroy")
    ->middleware("admin");


// trainer
