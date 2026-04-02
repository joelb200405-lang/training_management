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
        Schema::create('course_tbls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('objective')->nullable();
            $table->string('sector');
            $table->string('duration');
            $table->string('schedule')->nullable();
            $table->string('location')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('slots')->default(30);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('trainer_id')->nullable()->constrained('user_tbls')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_tbls');
    }
};
