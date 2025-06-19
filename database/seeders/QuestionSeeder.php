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

            // Zusätzliche Geographie-Fragen (Kategorie 1)
            ['question' => 'What is the capital of Germany?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Berlin', 'is_correct' => true],
                ['answer' => 'Munich', 'is_correct' => false],
                ['answer' => 'Hamburg', 'is_correct' => false],
                ['answer' => 'Frankfurt', 'is_correct' => false],
            ]],
            ['question' => 'What is the capital of Spain?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Madrid', 'is_correct' => true],
                ['answer' => 'Barcelona', 'is_correct' => false],
                ['answer' => 'Seville', 'is_correct' => false],
                ['answer' => 'Valencia', 'is_correct' => false],
            ]],
            ['question' => 'What is the capital of Italy?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Rome', 'is_correct' => true],
                ['answer' => 'Milan', 'is_correct' => false],
                ['answer' => 'Naples', 'is_correct' => false],
                ['answer' => 'Florence', 'is_correct' => false],
            ]],
            ['question' => 'What is the capital of Japan?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Tokyo', 'is_correct' => true],
                ['answer' => 'Kyoto', 'is_correct' => false],
                ['answer' => 'Osaka', 'is_correct' => false],
                ['answer' => 'Hiroshima', 'is_correct' => false],
            ]],
            ['question' => 'What is the capital of Australia?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Canberra', 'is_correct' => true],
                ['answer' => 'Sydney', 'is_correct' => false],
                ['answer' => 'Melbourne', 'is_correct' => false],
                ['answer' => 'Perth', 'is_correct' => false],
            ]],
            ['question' => 'What is the capital of Brazil?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Brasília', 'is_correct' => true],
                ['answer' => 'Rio de Janeiro', 'is_correct' => false],
                ['answer' => 'São Paulo', 'is_correct' => false],
                ['answer' => 'Salvador', 'is_correct' => false],
            ]],
            ['question' => 'What is the capital of Egypt?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Cairo', 'is_correct' => true],
                ['answer' => 'Alexandria', 'is_correct' => false],
                ['answer' => 'Giza', 'is_correct' => false],
                ['answer' => 'Luxor', 'is_correct' => false],
            ]],
            ['question' => 'What is the capital of Canada?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Ottawa', 'is_correct' => true],
                ['answer' => 'Toronto', 'is_correct' => false],
                ['answer' => 'Montreal', 'is_correct' => false],
                ['answer' => 'Vancouver', 'is_correct' => false],
            ]],
            ['question' => 'What is the capital of Russia?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Moscow', 'is_correct' => true],
                ['answer' => 'St. Petersburg', 'is_correct' => false],
                ['answer' => 'Novosibirsk', 'is_correct' => false],
                ['answer' => 'Kazan', 'is_correct' => false],
            ]],
            ['question' => 'What is the capital of China?', 'category_id' => 1, 'answers' => [
                ['answer' => 'Beijing', 'is_correct' => true],
                ['answer' => 'Shanghai', 'is_correct' => false],
                ['answer' => 'Hong Kong', 'is_correct' => false],
                ['answer' => 'Guangzhou', 'is_correct' => false],
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
