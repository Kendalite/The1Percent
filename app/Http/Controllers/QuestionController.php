<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @param object $request Sent request by user (id question)
     * @return object
     */
    public function retrieveQuestion(Request $request)
    {
        $loValidator = Validator::make($request->all(), [
            'aiId' => 'required|string',
        ]);
        if ( $loValidator->fails() ) {
            return false;
        }
        $loValidatedData = $loValidator->validated();
        // Get Current Item and Format
        $loQuestion = Question::getQuestionById($loValidatedData['aiId']);
        return response()->json($loQuestion);
    }

    /**
     * Check input by user against question from storage
     * @param object $request Sent request by user (id question + input)
     * @return bool
     */
    public function checkAnswer(Request $request)
    {
        $loValidator = Validator::make($request->all(), [
            'asAnswer' => 'required|string',
            'aiId' => 'required|string',
        ]);
        if ( $loValidator->fails() ) {
            return response()->json(false);
        }
        $loValidatedData = $loValidator->validated();
        // Get Current Item and Format
        $loAnswerString = json_decode(Question::getQuestionById($loValidatedData['aiId'], 0, 1)->question_answers);
        foreach ( $loAnswerString as $lsAnswerValid ) {
            if ( strtolower($loValidatedData['asAnswer']) === strtolower($lsAnswerValid) ) {
                return response()->json(true);
            }
        }
        return response()->json(false);
    }
}
