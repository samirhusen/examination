<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResponse extends Model
{
    use HasFactory;

    // Define the many-to-one relationship with the StudentQuestionnaire model
    public function studentQuestionnaire()
    {
        return $this->belongsTo(StudentQuestionnaire::class, 'student_questionnaire_id');
    }

    // Define the one-to-one relationship with the QuestionnaireQuestion model
    public function questionnaireQuestion()
    {
        return $this->belongsTo(QuestionnaireQuestion::class, 'questionnaire_question_id');
    }
}
