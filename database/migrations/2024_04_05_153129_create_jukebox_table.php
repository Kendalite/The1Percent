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
        Schema::create('project_jukebox', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained('users')->restrictOnDelete();
            $table->string('music_title', 255)->nullable();
            $table->text('music_link')->nullable();
            $table->text('music_thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_jukebox');
    }
};