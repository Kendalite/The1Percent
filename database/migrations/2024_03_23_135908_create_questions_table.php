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
        Schema::table('project_questions', function (Blueprint $table) {
            $table->json('question_data')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_questions');
        Schema::create('project_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};
