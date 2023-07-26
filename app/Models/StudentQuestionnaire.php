<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuestionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'questionnaire_id'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Define the many-to-one relationship with the Questionnaire model
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    // Define the one-to-many relationship with the StudentResponse model
    public function responses()
    {
        return $this->hasMany(StudentResponse::class, 'student_questionnaire_id');
    }
}
