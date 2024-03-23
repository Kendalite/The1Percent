<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $table = 'project_games';

    protected $fillable = [
        'label',
        'author',
    ];

    public function manyAnswers(): HasMany {
        return $this->hasMany(Answer::class, 'game_id');
    }

    public function linkedGameBuilder(): BelongsTo
    {
        return $this->belongsTo(GameBuilder::class, 'game_id');
    }
}
