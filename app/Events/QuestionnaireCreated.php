<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Questionnaire;

class QuestionnaireCreated
{
    use Dispatchable, SerializesModels;

    public $questionnaire;

    public function __construct(Questionnaire $questionnaire)
    {
        $this->questionnaire = $questionnaire;
    }
}
