<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Mail\QuestionnaireInvitation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class QuestionnaireInvitationTest extends TestCase
{
    public function test_questionnaire_invitation_email_sent()
    {
        $url = 'https://localhost/questionnaire/1/student/12/abcd12345678';

        // send the questionnaire invitation email
        Mail::fake();
        Queue::fake();

        Mail::queue(new QuestionnaireInvitation($url));

        // assert that the email was queued for sending
        Mail::assertQueued(QuestionnaireInvitation::class);
    }
}
