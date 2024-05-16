<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameBuilder;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
    * Display a listing of active games allowed
    *
    * @return Response
    */
    public function hub()
    {

    }


    /**
    * Load the game screen with data linked to the code
    * @param string $asRoomCode Code of the game
    * @return Response
    */
    public function play(string $asRoomCode = '')
    {
        // Request game item
        $loGame = Game::getGameByCode($asRoomCode);
        if ( !empty($loGame) ) {
            $laGameQuestions = GameBuilder::getGameQuestions($loGame->id);
            dump($laGameQuestions);
        }
        dd($loGame);
    }

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Get All Items
        $loItems = Game::all();
        // Load View
        return view('game.index', [
            'aoItems' => $loItems
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
