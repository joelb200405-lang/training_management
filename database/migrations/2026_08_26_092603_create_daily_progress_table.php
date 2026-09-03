<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_tbls')->cascadeOnDelete();
            $table->foreignId('enrollment_id')->constrained('enrollment_tbls')->cascadeOnDelete();
            $table->date('date');
            $table->unsignedTinyInteger('progress_percent')->default(0);
            $table->timestamps();

            $table->unique(['enrollment_id', 'date']);
            $table->index(['user_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_progress');
    }
};