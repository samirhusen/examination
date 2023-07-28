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

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function responses()
    {
        return $this->hasMany(StudentResponse::class, 'student_questionnaire_id');
    }
}
