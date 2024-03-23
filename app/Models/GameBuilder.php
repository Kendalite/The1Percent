<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameBuilder extends Model
{
    protected $table = 'project_gamebuilder';

    protected $fillable = [
        'order',
    ];

    public function manyGames(): HasMany {
        return $this->hasMany(Game::class, 'game_id');
    }

    public function manyQuestions(): HasMany {
        return $this->hasMany(Question::class, 'question_id');
    }
}
