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
        Schema::table('project_games', function (Blueprint $table) {
            $table->string('_game_author', 128)->after('id')->nullable();
            $table->string('game_label', 128)->after('_game_author');
            $table->string('game_code', 8)->after('game_label')->unique()->default('0XXXXXX0');
            $table->integer('game_mode')->after('game_code')->default(0);
            $table->integer('game_timer')->after('game_mode')->default(30);
            $table->integer('game_state')->after('game_timer')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_games');
        Schema::create('project_games', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};
