<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\StudentResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\StudentQuestionnaire;
use App\Models\QuestionnaireQuestion;

class QuestionnaireResponseController extends Controller
{
    public function show($questionnaireId, $studentId, $uniqueIdentifier)
    {
        $questionnaireQuestions = QuestionnaireQuestion::where('questionnaire_id', $questionnaireId)->get();

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

            try {
                DB::beginTransaction();

                $studentQuestionnaire = StudentQuestionnaire::create([
                    'student_id' => $studentId,
                    'questionnaire_id' => $questionnaireId,
                ]);

                // students responses to the db
                foreach ($request->input('question') as $questionId => $answer) {
                    $answerBool = filter_var($answer, FILTER_VALIDATE_BOOLEAN);

                    StudentResponse::create([
                        'questionnaire_question_id' => $questionId,
                        'student_questionnaire_id' => $studentQuestionnaire->id,
                        'answer' => $answerBool,
                    ]);
                }

                DB::commit();

                Log::info('Student questionnaire response submitted successfully', [
                    'questionnaire_id' => $questionnaireId,
                    'student_id' => $studentId,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();

                Log::error('Failed to submit student questionnaire response', [
                    'questionnaire_id' => $questionnaireId,
                    'student_id' => $studentId,
                    'error_message' => $e->getMessage(),
                ]);
            }
        }

        return view('questionnaire.response.submit');
    }

    private function checkResponseExistsForSameQuestionnaire($questionnaireId, $studentId)
    {
        return StudentQuestionnaire::where('questionnaire_id', $questionnaireId)
            ->where('student_id', $studentId)
            ->exists();
    }
}
