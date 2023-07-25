<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireQuestion extends Model
{
    use HasFactory;

    // Define the many-to-many relationship with the Question model
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Define the many-to-many relationship with the Questionnaire model
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
