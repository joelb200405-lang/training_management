<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_tbls')->cascadeOnDelete();
            $table->foreignId('enrollment_id')->constrained('enrollment_tbls')->cascadeOnDelete();
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'excused'])->default('present');
            $table->foreignId('marked_by')->nullable()->constrained('user_tbls')->nullOnDelete();
            $table->boolean('auto_marked')->default(false);
            $table->timestamps();

            $table->unique(['enrollment_id', 'date']);
            $table->index(['user_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};