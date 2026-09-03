<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'user_id',
        'enrollment_id',
        'date',
        'status',
        'marked_by',
        'auto_marked',
    ];

    protected $casts = [
        'date'        => 'date',
        'auto_marked' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User_tbl::class, 'user_id');
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment_tbl::class, 'enrollment_id');
    }

    public function markedBy()
    {
        return $this->belongsTo(User_tbl::class, 'marked_by');
    }
}