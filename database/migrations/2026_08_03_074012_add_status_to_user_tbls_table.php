<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('user_tbls', function (Blueprint $table) {
        $table->string('status')->default('Active'); // or string/enum depending on your setup
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_tbls', function (Blueprint $table) {
            //
        });
    }
};
