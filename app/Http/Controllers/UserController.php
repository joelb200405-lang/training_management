<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\product_table;
use App\Models\User_tbl;
use Illuminate\Http\Request;
use Auth;

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

    // public function InsertData(Request $request){
    //     $incomingFields = $request->validate([
    //         "product_name" => "required",
    //         "product_quantity" => "required",
    //         "product_description" => "required",
    //     ]);

    //     $this->product->InsertDataTbl($incomingFields);

    //     return redirect()->route("about_page");
    // }

    public function Login(){
        return view("student.login");
    }

    public function SignUp(Request $request)
    {
        // dd($request->all());

        try {
            $request->validate([
                "firstname" => "required",
                "lastname" => "required",
                "email" => ["required", Rule::unique("user_tbls", "email")],
                "username" => "required",
                "password" => "required|confirmed",
            ]);

            User_tbl::create([
                "firstname" => $request->firstname,
                "lastname" => $request->lastname,
                "email" => $request->email,
                "username" => $request->username,
                "password" => bcrypt($request->password),
            ]);

            return redirect()->route("Login");
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getLine(), $e->getFile());
        }
    }
}
