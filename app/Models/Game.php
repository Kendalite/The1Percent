<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Enums\States;
use App\Enums\Gamemodes;

class Game extends Model
{
    protected $table = 'project_games';

    protected $fillable = [
        '_game_author',
        'game_label',
        'game_code',
        'game_mode',
        'game_timer',
        'game_state'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'game_mode' => Gamemodes::class,
        'game_state' => States::class,
    ];

    public function manyAnswers(): HasMany {
        return $this->hasMany(Answer::class, 'game_id');
    }

    public function linkedGameBuilder(): BelongsTo
    {
        return $this->belongsTo(GameBuilder::class, 'game_id');
    }

    /**
    * Retrieve game by code
    * @param string $asQuizCode Label for the quiz
    * @param bool $abLiveState If true, retrieves only live game. If false, retrieve all games
    * @return Game
    */
    public static function getGameByCode($asQuizCode = '', $abLiveState = 1): ?Game
    {
        return Game::where([
            ['game_code', '=', $asQuizCode],
            ($abLiveState ? ['game_state', '=', States::Ready] : ['game_state', '>=', 0]),
        ])->first();
    }
}
