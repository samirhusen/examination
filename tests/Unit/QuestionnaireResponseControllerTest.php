<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Questionnaire;
use App\Models\QuestionnaireQuestion;
use App\Models\StudentQuestionnaire;
use App\Models\StudentResponse;

class QuestionnaireResponseControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_submit_method_creates_student_responses()
    {
        $user = User::factory()->create(['role' => 'student']);
        $this->actingAs($user);

        // sample questionnaire with some questions
        $questionnaire = Questionnaire::create([
            'title' => 'Sample Questionnaire',
            'expiry_date' => now()->addDays(7)->format('Y-m-d'),
        ]);

        // response to the questionnaire
        $data = [
            'question' => [
                '1' => 'true',
                '2' => 'false',
                '3' => 'true',
            ],
        ];

        // post request to submit the questionnaire response
        $response = $this->post(route('questionnaire.response.submit', [
            'questionnaireId' => $questionnaire->id,
            'studentId' => $user->id,
            'uniqueIdentifier' => 'abcd1234',
        ]), $data);

        // assert response redirects to the correct view or route
        $response->assertViewIs('questionnaire.response.submit');
    }
}
