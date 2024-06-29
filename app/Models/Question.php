<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Enums\QuestionFormat;
use App\Enums\States;

class Question extends Model
{
    protected $table = 'project_questions';

    protected $fillable = [
        'question_level',
        'question_lang',
        'question_format',
        'question_title',
        'question_visuals',
        'question_answers',
        'question_explanation',
        'question_state',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'question_format' => QuestionFormat::class,
        'question_state' => States::class,
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

    /**
    * Retrieve question by identifier
    * @param int $aiId Identifier for the question
    * @param bool $abLiveState If true, retrieves only live questions. If false, retrieve all questions
    * @param bool $abAdminMode If true, get all infos. If false, retrieve ID only.
    * @return Question
    */
    public static function getQuestionById($aiId = -1, $abLiveState = 1, $abAdminMode = 0): ?Question
    {
        return Question::where([
            ['id', '=', $aiId],
            ($abLiveState ? ['question_state', '=', States::Ready] : ['question_state', '>=', 0]),
        ])->first()->makeHidden(($abAdminMode > 0) ? [] : ['question_answers', 'question_explanation', 'question_state', 'question_score']);
    }
}
