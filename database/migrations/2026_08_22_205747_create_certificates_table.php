<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            
            // References user_tbls and course_tbls
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            
            // Certificate Metadata
            $table->string('certificate_no')->unique(); // e.g. D-LED-TES-2026-081
            $table->string('training_id')->nullable()->default('NCIIDRM-26-032'); // e.g. NCIIDRM-26-032
            $table->string('document_type')->default('completion'); // completion / participation
            $table->date('issue_date');
            $table->string('status')->default('Pending'); // Claimed / Pending
            $table->string('grade')->nullable()->default('94%');
            $table->text('remarks')->nullable();
            
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('user_id')
                  ->references('id')
                  ->on('user_tbls')
                  ->onDelete('cascade');

            $table->foreign('course_id')
                  ->references('id')
                  ->on('course_tbls')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};