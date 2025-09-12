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
        Schema::table('chronologicals', function (Blueprint $table) {
            // $table->json('subject')->nullable()->change();
            // $table->json('solutions')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chronologicals', function (Blueprint $table) {
            // $table->string('subject')->nullable()->change();
            // $table->string('solutions')->nullable()->change();
        });
    }
};
