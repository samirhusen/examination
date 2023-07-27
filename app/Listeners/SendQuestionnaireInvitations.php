<?php


namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Str;
use App\Events\QuestionnaireCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuestionnaireInvitation;

class SendQuestionnaireInvitations
{
    public function handle(QuestionnaireCreated $event)
    {
        // Fetch all users with the "student" role from the database
        $students = User::where('role', 'student')->get();

        // Send email invitation to each student with a unique URL
        foreach ($students as $student) {
            $uniqueIdentifier = Str::uuid()->toString();
            $url = url("/questionnaire/{$event->questionnaire->id}/student/{$student->id}/{$uniqueIdentifier}");
            Mail::to($student->email)->send(new QuestionnaireInvitation($url));
        }
    }
}
