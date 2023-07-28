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

    public function studentQuestionnaires()
    {
        return $this->hasMany(StudentQuestionnaire::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'questionnaire_questions');
    }
}
