<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'questionnaire_question_id',
        'student_questionnaire_id',
        'answer'
    ];

    public function studentQuestionnaire()
    {
        return $this->belongsTo(StudentQuestionnaire::class, 'student_questionnaire_id');
    }

    public function questionnaireQuestion()
    {
        return $this->belongsTo(QuestionnaireQuestion::class, 'questionnaire_question_id');
    }
}
