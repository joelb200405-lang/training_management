<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_tbl extends Model
{
    use HasFactory;

    protected $table = 'course_tbls';

    protected $fillable =[

        'title',
        'description',
        'objectives',
        'sector',
        'duration',
        'schedule',
        'location',
        'thumbnail',
        'slots',
        'status',
        'trainer_id',
    ];

    public function trainer(){
        return $this->belongsTo(User_tbl::class, 'trainer_id');
    }
}
