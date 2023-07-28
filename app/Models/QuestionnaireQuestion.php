<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'questionnaire_id'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
