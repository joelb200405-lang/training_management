<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Temporarily turn off foreign key checks
        Schema::disableForeignKeyConstraints();

        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->text('question');
            $table->string('choice_a');
            $table->string('choice_b');
            $table->string('choice_c');
            $table->string('choice_d');
            $table->enum('correct_answer', ['a', 'b', 'c', 'd']);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 2. Turn foreign key checks back on
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};