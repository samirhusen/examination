<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionnaireControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_correctly_creates_questionnaire()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $physicsSubject = Subject::create(['name' => 'Physics']);
        $chemistrySubject = Subject::create(['name' => 'Chemistry']);

        // create some questions manually
        $questionsCreate = [
            Question::create(['subject_id' => 1, 'question' => 'Physics Question 1', 'answer' => true]),
            Question::create(['subject_id' => 1, 'question' => 'Physics Question 2', 'answer' => false]),
            Question::create(['subject_id' => 2, 'question' => 'Chemistry Question 1', 'answer' => true]),
            Question::create(['subject_id' => 2, 'question' => 'Chemistry Question 2', 'answer' => false]),
        ];

        $questionnaire = [
            'title' => 'Sample Questionnaire',
            'expiry_date' => now()->addDays(7)->format('Y-m-d'),
        ];

        $response = $this->post(route('question.store'), $questionnaire);

        $response->assertRedirect(route('question.index'));

        $this->assertDatabaseHas('questionnaires', $questionnaire);

        // fetch created questionnaire from the database
        $questionnaire = Questionnaire::where('title', $questionnaire['title'])
            ->where('expiry_date', $questionnaire['expiry_date'])
            ->first();

        // assert that the selected questions are associated with the questionnaire
        $this->assertCount(count($questionsCreate), $questionnaire->questions);
        foreach ($questionnaire->questions as $question) {
            $this->assertTrue(in_array($question->subject_id, [1, 2])); // subject_id 1 for physics and 2 for chemistry
            $this->assertDatabaseHas('questions', ['id' => $question->id]);
        }
    }
}
