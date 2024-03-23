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
        Schema::table('project_gamebuilders', function (Blueprint $table) {
            $table->foreignId('game_id')->after('id')->index()->constrained('project_games')->onDelete('cascade');
            $table->foreignId('question_id')->after('game_id')->index()->constrained('project_questions')->onDelete('cascade');
            $table->unsignedSmallInteger('order')->after('question_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_gamebuilders');
        Schema::create('project_gamebuilders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};
