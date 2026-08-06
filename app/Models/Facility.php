<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facilities';

    protected $fillable = [
        'name',
        'address',
        'capacity',
    ];

    public function courses()
    {
        return $this->hasMany(Course_tbl::class, 'facility_id');
    }
}