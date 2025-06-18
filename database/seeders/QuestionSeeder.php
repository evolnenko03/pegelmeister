<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            ['question' => 'What is the capital of France?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Paris', 'is_correct' => true],
                ['answer' => 'London', 'is_correct' => false],
                ['answer' => 'Berlin', 'is_correct' => false],
                ['answer' => 'Madrid', 'is_correct' => false],
            ]],
            ['question' => 'Who directed the movie Titanic?', 'category_id' => 2, 'answers' => [
                ['answer' => 'James Cameron', 'is_correct' => true],
                ['answer' => 'Steven Spielberg', 'is_correct' => false],
                ['answer' => 'Christopher Nolan', 'is_correct' => false],
                ['answer' => 'Martin Scorsese', 'is_correct' => false],
            ]],
            ['question' => 'How many players are on a basketball team?', 'category_id' => 3, 'answers' => [
                ['answer' => '5', 'is_correct' => true],
                ['answer' => '6', 'is_correct' => false],
                ['answer' => '7', 'is_correct' => false],
                ['answer' => '4', 'is_correct' => false],
            ]],
            ['question' => 'In which year did World War II end?', 'category_id' => 4, 'answers' => [
                ['answer' => '1945', 'is_correct' => true],
                ['answer' => '1944', 'is_correct' => false],
                ['answer' => '1946', 'is_correct' => false],
                ['answer' => '1943', 'is_correct' => false],
            ]],
            ['question' => 'What is the chemical symbol for gold?', 'category_id' => 5, 'answers' => [
                ['answer' => 'Au', 'is_correct' => true],
                ['answer' => 'Ag', 'is_correct' => false],
                ['answer' => 'Go', 'is_correct' => false],
                ['answer' => 'Gd', 'is_correct' => false],
            ]],
        ];

        foreach ($questions as $questionData) {
            $question = Question::create([
                'question' => $questionData['question'],
                'category_id' => $questionData['category_id'],
            ]);

            foreach ($questionData['answers'] as $answerData) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $answerData['answer'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }
        }
    }
}
