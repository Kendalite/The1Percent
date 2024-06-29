<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Get All Items
        $loItems = Question::orderByDesc('created_at')->paginate(10);
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
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }

    /**
     * Load question from storage
     * @param int $aiId Identifiant de la question
     * @param bool $abAdminMode If true, get all infos. If false, retrieve playable question
     */
    public function retrieveQuestion(Request $request)
    {
        // Get Current Item and Format
        $loQuestion = Question::getQuestionById($request?->aiId);
        return response()->json($loQuestion);
    }
}
