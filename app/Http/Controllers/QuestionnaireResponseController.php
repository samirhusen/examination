<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;
use App\Models\StudentResponse;
use Illuminate\Support\Facades\Log;
use App\Models\StudentQuestionnaire;
use App\Models\QuestionnaireQuestion;

class QuestionnaireResponseController extends Controller
{
    public function show($questionnaireId, $studentId, $uniqueIdentifier)
    {
        // Get the questionnaire questions
        $questionnaireQuestions = QuestionnaireQuestion::where('questionnaire_id', $questionnaireId)->get();

        // Get details of questionnaire
        $questionnaireDetail = Questionnaire::where('id', $questionnaireId)->get()->first();

        // Check if a response already exists for the given questionnaire and student
        $existingResponse = $this->checkResponseExistsForSameQuestionnaire($questionnaireId, $studentId);

        return view('questionnaire.response.show', compact(
            'questionnaireId',
            'studentId',
            'uniqueIdentifier',
            'questionnaireQuestions',
            'existingResponse',
            'questionnaireDetail'
        ));
    }

    public function submit(Request $request, $questionnaireId, $studentId)
    {
        // Check if a response already exists for the given questionnaire and student
        $existingResponse = $this->checkResponseExistsForSameQuestionnaire($questionnaireId, $studentId);

        if (!$existingResponse) {
            // Create a new student questionnaire entry
            $studentQuestionnaire = StudentQuestionnaire::create([
                'student_id' => $studentId,
                'questionnaire_id' => $questionnaireId,
            ]);

            // Save the student's responses to the database
            foreach ($request->input('question') as $questionId => $answer) {
                $answerBool = filter_var($answer, FILTER_VALIDATE_BOOLEAN);

                StudentResponse::create([
                    'questionnaire_question_id' => $questionId,
                    'student_questionnaire_id' => $studentQuestionnaire->id,
                    'answer' => $answerBool,
                ]);
            }
        }

        // Redirect to a success page or any other desired location
        return view('questionnaire.response.submit');
    }

    private function checkResponseExistsForSameQuestionnaire($questionnaireId, $studentId)
    {
        return StudentQuestionnaire::where('questionnaire_id', $questionnaireId)
            ->where('student_id', $studentId)
            ->exists();
    }
}
