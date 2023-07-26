<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'expiry_date'
    ];

    // Define the one-to-many relationship with the StudentQuestionnaire model
    public function studentQuestionnaires()
    {
        return $this->hasMany(StudentQuestionnaire::class);
    }

    // Define the many-to-many relationship with the Question model through the QuestionnaireQuestion model
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'questionnaire_questions');
    }
}
