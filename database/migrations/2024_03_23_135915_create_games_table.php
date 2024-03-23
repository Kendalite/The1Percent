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
            $table->text('label')->after('id');
            $table->string('code', 8)->after('label')->default('0XXXX0');
            $table->string('author', 255)->after('code')->nullable();
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
