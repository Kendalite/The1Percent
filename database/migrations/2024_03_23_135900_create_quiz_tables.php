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
        Schema::create('project_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('project_answers', function (Blueprint $table) {
            $table->id();
        });
        Schema::create('project_games', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('project_gamebuilders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_questions');
        Schema::dropIfExists('project_answers');
        Schema::dropIfExists('project_games');
        Schema::dropIfExists('project_gamebuilders');
    }
};
