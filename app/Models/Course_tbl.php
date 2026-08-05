<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_tbl extends Model
{
    use HasFactory;

    protected $table = 'course_tbls';

    protected $fillable = [
        'course_code',
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
        'facility_id',
    ];

    /**
     * Type casting for attributes.
     */
    protected $casts = [
        'slots' => 'integer',
        'duration' => 'integer',
    ];

    /**
     * Virtual attributes automatically included in array/JSON serialization.
     */
    protected $appends = [
        'enrolled_count',
        'available_slots',
    ];

    /* ==========================================================
     * RELATIONSHIPS
     * ========================================================== */

    public function trainer()
    {
        return $this->belongsTo(User_tbl::class, 'trainer_id');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment_tbl::class, 'course_id');
    }

    /**
     * Relationship to Course Modules
     */
    public function modules()
    {
        return $this->hasMany(Module::class, 'course_id');
    }

    /**
     * Relationship to Course Quizzes
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'course_id');
    }

    /* ==========================================================
     * ACCESSORS & VIRTUAL ATTRIBUTES
     * ========================================================== */

    /**
     * Get total enrolled count.
     */
    public function getEnrolledCountAttribute(): int
    {
        return $this->enrollments()->count();
    }

    /**
     * Calculate remaining available slots.
     */
    public function getAvailableSlotsAttribute(): int
    {
        return max(0, (int) $this->slots - $this->enrolled_count);
    }
}