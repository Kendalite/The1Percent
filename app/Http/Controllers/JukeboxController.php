<?php

namespace App\Http\Controllers;

use App\Models\Jukebox;
use Illuminate\Http\Request;

class JukeboxController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Get All Items
        $loItems = Jukebox::all();
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
    public function show(Jukebox $jukebox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jukebox $jukebox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jukebox $jukebox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jukebox $jukebox)
    {
        //
    }
}
