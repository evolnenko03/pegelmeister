<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\GameSession;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function getCategories()
    {
        return response()->json(['categories' => Category::all()]);
    }

    public function startGame(Request $request)
    {
        $request->validate([
            'session_code' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'total_rounds' => 'integer|min:5|max:50'
        ]);

        $gameSession = GameSession::where('code', $request->session_code)->first();

        if (!$gameSession) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $totalRounds = $request->total_rounds ?? 20;

        $questions = Question::where('category_id', $request->category_id)
            ->with('answers')
            ->inRandomOrder()
            ->limit($totalRounds)
            ->get();

        return response()->json([
            'questions' => $questions,
            'total_rounds' => $totalRounds,
            'current_round' => 1
        ]);
    }

    public function submitAnswer(Request $request)
    {
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'session_code' => 'required|string',
            'answer_id' => 'required|exists:answers,id',
            'is_first' => 'boolean'
        ]);

        $gameSession = GameSession::where('code', $request->session_code)->first();
        $answer = Answer::find($request->answer_id);

        $points = 0;
        if ($answer->is_correct) {
            $points = $request->is_first ? 20 : 10;
        }

        $gameSession->players()->updateExistingPivot($request->player_id, [
            'score' => \DB::raw('score + ' . $points)
        ]);

        return response()->json([
            'correct' => $answer->is_correct,
            'points_earned' => $points,
            'drink' => !$answer->is_correct
        ]);
    }

    public function getScores($sessionCode)
    {
        $gameSession = GameSession::where('code', $sessionCode)
            ->with(['players' => function($query) {
                $query->orderBy('pivot_score', 'desc');
            }])
            ->first();

        return response()->json(['scores' => $gameSession->players]);
    }
}
