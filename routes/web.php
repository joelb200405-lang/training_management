<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
    
Route::get('/', function () {
    return view('landingpage');    //The first you will see.
});


Route::get("/login", [UserController::class, "Login"])->name("Login");
    //para matawag sa browser ang sign up 
Route::post("/login", [UserController::class, "LoginUser"])->name("LoginUser");

Route::get("/sign_up", [UserController::class, "SignupPage"])->name("SignupPage");

Route::post("/signup-form", [UserController::class, "SignUp"])->name("SignUp");

Route::get("/homepage", [UserController::class, "homepage"])->name("homepage");

Route::get("/handle", [UserController::class, "handle"])->name("handle");

Route::get("/admin1", [UserController::class, "admin1"])->name("admin1");
Route::get("/teacher", [UserController::class, "teacher"])->name("teacher");
?>