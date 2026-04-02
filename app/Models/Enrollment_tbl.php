<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment_tbl extends Model
{
    use HasFactory;

    protected $table = 'enrollment_tbls';

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'progress',
        'enrolled_at',
        'completed_at',
    ];

    protected $casts = [
        'enrolled_at'  => 'date',
        'completed_at' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User_tbl::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course_tbl::class, 'course_id');
    }
}