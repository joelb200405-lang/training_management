<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyProgress extends Model
{
    use HasFactory;

    protected $table = 'daily_progress';

    protected $fillable = [
        'user_id',
        'enrollment_id',
        'date',
        'progress_percent',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User_tbl::class, 'user_id');
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment_tbl::class, 'enrollment_id');
    }
}