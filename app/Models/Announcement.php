<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'type',
        'is_active',
        'publish_at',
        'expires_at',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'publish_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Scope — Master active switch only.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope — Active AND currently valid based on schedule and expiration dates.
     * Use this for displaying announcements to trainees/general users.
     */
    public function scopeActiveAndPublished(Builder $query): Builder
    {
        $now = now();

        return $query->active()
            ->where(function ($q) use ($now) {
                $q->whereNull('publish_at')
                  ->orWhere('publish_at', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', $now);
            });
    }

    /**
     * Scope — Urgent announcements only.
     */
    public function scopeUrgent(Builder $query): Builder
    {
        return $query->where('type', 'urgent');
    }
}