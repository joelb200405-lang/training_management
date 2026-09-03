<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_tbls')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->timestamp('completed_at')->useCurrent();
            $table->timestamps();

            // Prevent the same student from marking the same module done twice
            $table->unique(['user_id', 'module_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_completions');
    }
};