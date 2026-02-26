<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\product_controller;

Route::get('/', function () {
    return view('homepage');
});

Route::get("/about-page", [product_controller::class, "about_page"])->name("about_page");

Route::post("/insert-data", [product_controller::class, "InsertData"])->name("InsertData");

// Route::get("/about-page", function () {
//     return view("about");
// })->name("about");
