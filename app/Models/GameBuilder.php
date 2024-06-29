<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameBuilder extends Model
{
    protected $table = 'project_gamebuilders';

    protected $fillable = [
        'order',
    ];

    public function manyGames(): HasMany {
        return $this->hasMany(Game::class, 'game_id');
    }

    public function manyQuestions(): HasMany {
        return $this->hasMany(Question::class, 'question_id');
    }

    /**
    * Retrieve questions for game and stack them in order
    * @param int $aiId Identifier of the game
    * @param bool $abOrder If true, questions will be retrieved in order (order must be declared). If false, retrieve all.
    * @param bool $abLiveState If true, only get live questions (null will be in place for non-live). If false, retrieve all.
    * @param bool $abAdminMode If true, get all infos. If false, retrieve ID only.
    * @return Array
    */
    public static function getGameQuestions($aiId = 0, $abOrder = 1, $abLiveState = 1, $abAdminMode = 0): Array
    {
        // Retrieve
        $laReturnArray = [];
        $loGameBuilder = GameBuilder::where([
            ['game_id', '=', $aiId],
            ( $abOrder ? ['order', '>', 0] : ['order', '>=', 0] )
        ])->orderBy( ( $abOrder ? 'order' : 'id' ))->get();
        // Upload
        if ( count($loGameBuilder) > 0 ) {
            foreach ( $loGameBuilder as $liCounter => $loLinkage ) {
                $laReturnArray[$liCounter+1] = ($abAdminMode) ? Question::getQuestionById($loLinkage->question_id, $abLiveState) : $loLinkage->question_id;
            }
        }
        return $laReturnArray;
    }

}
