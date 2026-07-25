<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            // Link back to the logged-in student (nullable in case guests ever apply)
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            // Section 1 — TE2MIS
            $table->string('uli_number')->nullable();
            $table->date('entry_date')->nullable();
            $table->string('id_picture_path')->nullable();

            // Section 2 — Learner/Manpower Profile
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_barangay')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_province')->nullable();
            $table->string('address_district')->nullable();
            $table->string('address_region')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('nationality')->nullable();
            $table->string('training_venue')->nullable();

            // Section 3 — Personal Information
            $table->enum('sex', ['Male', 'Female'])->nullable();
            $table->enum('employment_status', ['Employed', 'Unemployed'])->nullable();
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Separated', 'Solo Parent'])->nullable();
            $table->string('birth_month')->nullable();
            $table->string('birth_day')->nullable();
            $table->string('birth_year')->nullable();
            $table->unsignedSmallInteger('age')->nullable();
            $table->string('birthplace_city')->nullable();
            $table->string('birthplace_province')->nullable();
            $table->string('birthplace_region')->nullable();
            $table->string('education_attainment')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_address')->nullable();

            // Section 4 — Classification (multi-select, stored as JSON array)
            $table->json('classification')->nullable();
            $table->string('classification_other')->nullable();

            // Section 5/6 — Disability
            $table->json('disability_type')->nullable();
            $table->string('disability_multiple_specify')->nullable();
            $table->string('disability_cause')->nullable();
            $table->string('disability_cause_other')->nullable();

            // Section 7/8 — Course & Scholarship
            $table->string('course_name');
            $table->string('scholarship_package')->nullable();

            // Section 9 — Privacy
            $table->enum('privacy_consent', ['Agree', 'Disagree']);

            // Section 10 — Signature
            $table->date('date_accomplished')->nullable();
            $table->date('date_received')->nullable();
            $table->string('photo_1x1_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};