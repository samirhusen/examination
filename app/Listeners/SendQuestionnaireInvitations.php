<?php


namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Events\QuestionnaireCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuestionnaireInvitation;

class SendQuestionnaireInvitations
{
    public function handle(QuestionnaireCreated $event)
    {
        // fetch users with the student role from the database
        $students = User::where('role', 'student')->get();

        // Send email invitation to each student with a unique URL
        foreach ($students as $student) {
            $uniqueIdentifier = Str::uuid()->toString();
            $url = url("/questionnaire/{$event->questionnaire->id}/student/{$student->id}/{$uniqueIdentifier}");

            try {
                // Send the email
                Mail::to($student->email)->send(new QuestionnaireInvitation($url));

                Log::info('Questionnaire invitation email sent to student', [
                    'student_id' => $student->id,
                    'questionnaire_id' => $event->questionnaire->id,
                    'email' => $student->email,
                    'url' => $url,
                    'subject' => 'Questionnaire Invitation',
                    'timestamp' => now()->toDateTimeString(),
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send questionnaire invitation email', [
                    'student_id' => $student->id,
                    'questionnaire_id' => $event->questionnaire->id,
                    'email' => $student->email,
                    'error_message' => $e->getMessage(),
                    'timestamp' => now()->toDateTimeString(),
                ]);
            }
        }
    }
}
