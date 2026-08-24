<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $table = 'certificates';

    protected $fillable = [
        'user_id',
        'course_id',
        'certificate_no',
        'training_id',
        'document_type',
        'issue_date',
        'status',
        'grade',
        'remarks',
    ];

    public function user()
    {
        // Matches App\Models\User_tbl (or UserTbl depending on your file name)
        return $this->belongsTo(User_tbl::class, 'user_id');
    }

    public function course()
    {
        // Matches App\Models\Course_tbl (or CourseTbl depending on your file name)
        return $this->belongsTo(Course_tbl::class, 'course_id');
    }
}