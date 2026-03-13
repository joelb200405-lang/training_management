<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User_tbl extends Authenticatable
{
    protected $table = "user_tbls";

    protected $fillable = [
        "firstname",
        "lastname",
        "email",
        "username",
        "password",
        "role"
    ];
}
