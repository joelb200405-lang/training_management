<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationship — belongs to Course
    public function course()
    {
        return $this->belongsTo(Course_tbl::class, 'course_id');
    }

    // Scope — active modules lang
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope — ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}