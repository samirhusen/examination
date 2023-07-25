<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions_arr = config('question');

        foreach ($questions_arr as $subjectName => $questions) {
            $subject = Subject::where('name', $subjectName)->first();

            if (!$subject) {
                continue; // Skip if the subject does not exist in the database
            }

            foreach ($questions as $questionData) {
                Question::create([
                    'subject_id' => $subject->id,
                    'question' => $questionData['question'],
                    'answer' => $questionData['answer'],
                ]);
            }
        }
    }
}
