<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollment_tbls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_tbls')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('course_tbls')->onDelete('cascade');
            $table->enum('status', ['pending', 'active', 'completed', 'dropped'])->default('pending');
            $table->integer('progress')->default(0); // 0-100%
            $table->date('enrolled_at');
            $table->date('completed_at')->nullable();
            $table->timestamps();

            // prevent duplicate enrollment
            $table->unique(['user_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollment_tbls');
    }
};