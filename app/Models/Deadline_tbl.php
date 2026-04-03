<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deadline_tbl extends Model
{
    use HasFactory;

    protected $table = 'deadline_tbls';

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'course_id',
        'type',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course_tbl::class, 'course_id');
    }
}