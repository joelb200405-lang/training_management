<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_tbls', function (Blueprint $table) {
            $table->string('contact')->nullable()->after('email');
            $table->string('id_number')->nullable()->after('contact');
            $table->text('remarks')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('user_tbls', function (Blueprint $table) {
            $table->dropColumn(['contact', 'id_number', 'remarks']);
        });
    }
};