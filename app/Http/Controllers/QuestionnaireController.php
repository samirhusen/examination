<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\DB;
use App\Events\QuestionnaireCreated;
use App\Models\QuestionnaireQuestion;
use App\Http\Requests\QuestionnaireRequest;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionnaires = Questionnaire::all()->where('expiry_date', '>=', now());
        return view('questionnaire.list')->with('questionnaires', $questionnaires);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questionnaire.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionnaireRequest $request)
    {
        $validated = $request->validated();

        // Create the questionnaire
        $questionnaire = Questionnaire::create($validated);

        $physicsQuestions = Question::inRandomOrder()
            ->where('subject_id', 1) // Assuming Physics subject_id is 1
            ->limit(5)
            ->get();

        $chemistryQuestions = Question::inRandomOrder()
            ->where('subject_id', 2) // Assuming Chemistry subject_id is 2
            ->limit(5)
            ->get();

        // Combine the selected questions
        $selectedQuestions = $physicsQuestions->merge($chemistryQuestions);

        // Associate the random questions with the questionnaire using a transaction
        DB::transaction(function () use ($questionnaire, $selectedQuestions) {
            foreach ($selectedQuestions as $question) {
                QuestionnaireQuestion::create([
                    'question_id' => $question->id,
                    'questionnaire_id' => $questionnaire->id,
                ]);
            }
        });

        event(new QuestionnaireCreated($questionnaire));

        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $questionnaire = Questionnaire::with('questions')->findOrFail($id);
        return view('questionnaire.detail')->with('questionnaire', $questionnaire);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
