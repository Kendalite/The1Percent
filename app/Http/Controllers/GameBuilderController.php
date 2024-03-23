<?php

namespace App\Http\Controllers;

use App\Models\GameBuilder;
use Illuminate\Http\Request;

class GameBuilderController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Get All Items
        $loItems = GameBuilder::all();
        // Load View
        return view('question.index', [
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
    public function show(GameBuilder $gameBuilder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GameBuilder $gameBuilder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GameBuilder $gameBuilder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameBuilder $gameBuilder)
    {
        //
    }
}
