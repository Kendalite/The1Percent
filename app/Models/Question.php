<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $table = 'project_questions';

    protected $fillable = [
        'question_level',
        'question_title',
        'question_visuals',
        'question_explanation',
        'question_state',
    ];

    public function linkedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function linkedGameBuilder(): BelongsTo
    {
        return $this->belongsTo(GameBuilder::class, 'game_id');
    }

    public function manyAnswers(): HasMany {
        return $this->hasMany(Answer::class, 'game_id');
    }
}
