<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_tbl extends Model
{
    protected $table = "user_tbls";

    protected $fillable = [
        "firstname",
        "lastname",
        "email",
        "username",
        "password"
    ];
}
