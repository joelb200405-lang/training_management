<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
    //para matawag sa browser ang landingpage 
Route::get('/', function () {
    return view('student.landingpage');
});
       //para matawag sa browser ang login 
// Route::get('/login', function (){
//     return view('student.login')->name("login");
// });

Route::get("/login", [UserController::class, "Login"])->name("Login");
    //para matawag sa browser ang sign up 
Route::get('/sign_up', function (){
    return view('student.sign_up');
});
    //para matawag sa browser ang homepage 
Route::get('/homepage', function () {
    return view('student.homepage');
});

Route::post("/signup-form", [UserController::class, "SignUp"])->name("SignUp");

// Route::get("/about-page", [product_controller::class, "about_page"])->name("about_page");

// Route::post("/insert-data", [product_controller::class, "InsertData"])->name("InsertData");

// Route::get("/about-page", function () {
//     return view("about");
// })->name("about");
?>