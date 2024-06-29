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
            $table->foreignId('user_id')->after('id')->index()->constrained('users')->restrictOnDelete();
            $table->integer('question_level')->after('id')->default(-1);
            $table->string('question_lang', 8)->after('question_level')->default('en');
            $table->string('question_format', 4)->after('question_lang')->default('open');
            $table->text('question_title')->after('question_format');
            $table->json('question_visuals')->after('question_title')->nullable();
            $table->json('question_answers')->after('question_visuals');
            $table->integer('question_score')->after('question_answers')->default(1);
            $table->text('question_explanation')->after('question_score')->nullable();
            $table->integer('question_state')->after('question_explanation')->default(0);
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
