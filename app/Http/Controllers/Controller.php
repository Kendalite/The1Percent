<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
    * Generate a random string of characters
    */
    public function generateRandomString(Int $aiLenght = 4, String $asBannedCharacters = '123456789') {
        // Liste des caractères autorisés
        $lsListCharacters = '123456789BCDFGHJKLMNPQRSTVWXYZ';
        // Retrait des caractères bannis
        $lsListCharacters = str_replace(str_split($asBannedCharacters), '', $lsListCharacters);
        $lsAllowedCharacterCount = strlen($lsListCharacters);
        // Génération et renvoi 
        $lsReturnString = '';
        for ($liTracker = 0; $liTracker < $aiLenght; $liTracker++) {
            $lsReturnString .= $lsListCharacters[rand(0, $lsAllowedCharacterCount - 1)];
        }
        return $lsReturnString;
    }
}
