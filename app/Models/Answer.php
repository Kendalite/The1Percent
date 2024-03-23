<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    protected $table = 'project_answers';

    protected $fillable = [
        'answer',
        'macrotime',
        'microtime',
    ];

    public function linkedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function linkedGame(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function linkedQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
