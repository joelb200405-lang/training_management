<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class User_tbl extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = "user_tbls";

    protected $fillable = [
        "firstname",
        "lastname",
        "email",
        "username",
        "password",
        "role",
        "must_reset_password",
        "email_verified_at",
        "status",   // <-- ADD THIS
        "remarks",  // <-- ADD THIS
    ];

    protected $dates = ['email_verified_at'];
}