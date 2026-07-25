<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'uli_number', 'entry_date', 'id_picture_path',
        'last_name', 'first_name', 'middle_name',
        'address_street', 'address_barangay', 'address_city', 'address_province',
        'address_district', 'address_region', 'email', 'contact_no', 'nationality',
        'training_venue',
        'sex', 'employment_status', 'civil_status',
        'birth_month', 'birth_day', 'birth_year', 'age',
        'birthplace_city', 'birthplace_province', 'birthplace_region',
        'education_attainment', 'guardian_name', 'guardian_address',
        'classification', 'classification_other',
        'disability_type', 'disability_multiple_specify',
        'disability_cause', 'disability_cause_other',
        'course_name', 'scholarship_package',
        'privacy_consent',
        'date_accomplished', 'date_received', 'photo_1x1_path',
    ];

    protected $casts = [
        'classification' => 'array',
        'disability_type' => 'array',
        'entry_date' => 'date',
        'date_accomplished' => 'date',
        'date_received' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User_tbl::class, 'user_id');
    }
}