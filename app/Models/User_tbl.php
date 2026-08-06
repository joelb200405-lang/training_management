<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
        "status",
        "remarks",
        "contact",
        "id_number",
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}