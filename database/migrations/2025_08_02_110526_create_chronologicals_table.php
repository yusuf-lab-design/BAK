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
        Schema::create('chronologicals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('no')->unique()->nullable();
            $table->string('area')->index();
            $table->json('subject')->nullable();
            $table->longText('kronologis')->nullable();
            $table->json('solutions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chronologicals');
    }
};
