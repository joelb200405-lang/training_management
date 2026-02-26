<?php

namespace App\Http\Controllers;

use App\Models\product_table;
use Illuminate\Http\Request;
use Auth;

class product_controller extends Controller
{
    public $product;

    public function __construct(){
        $this->product = new product_table();
    }

    public function about_page(){

        return view("about");
    }

    public function InsertData(Request $request){
        $incomingFields = $request->validate([
            "product_name" => "required",
            "product_quantity" => "required",
            "product_description" => "required",
        ]);

        $this->product->InsertDataTbl($incomingFields);

        return redirect()->route("about_page");
    }
}
