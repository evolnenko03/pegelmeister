<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\GameSession;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class GameRoom extends Component
{
    public $sessionCode;
    public $gameSession;
    public $players = [];
    public $categories = [];
    public $selectedCategory;
    public $totalRounds = 20;
    public $gameStarted = false;
    public $currentQuestion;
    public $currentRound = 1;
    public $questions = [];
    public $selectedAnswer;
    public $showResults = false;
    public $roundResults = [];
    public $gameFinished = false;

    protected $listeners = ['answer-submitted' => 'handleAnswer'];

    public function mount($code)
    {
        $this->sessionCode = strtoupper($code);
        $this->gameSession = GameSession::where('code', $this->sessionCode)->first();

        if (!$this->gameSession) {
            abort(404, 'Session not found');
        }

        $this->loadPlayers();
        $this->categories = Category::all();
    }

    public function loadPlayers(): void
    {
        $this->gameSession = GameSession::where('code', $this->sessionCode)->first();
        $this->players = $this->gameSession->players()->withPivot('score')->get();
    }

    public function startGame()
    {
        $this->validate(['selectedCategory' => 'required']);

        $this->questions = Question::where('category_id', $this->selectedCategory)
            ->with('answers')
            ->inRandomOrder()
            ->limit($this->totalRounds)
            ->get();

        if (count($this->questions) < $this->totalRounds) {
            $this->totalRounds = count($this->questions);
        }

        if (count($this->questions) > 0) {
            $this->currentQuestion = $this->questions[0];
            $this->gameStarted = true;
        }
    }

    public function submitAnswer($answerId)
    {
        $playerId = session('player_id');
        $answer = Answer::find($answerId);

        $points = 0;
        if ($answer->is_correct) {
            $points = 10;
        }

        $this->gameSession->players()->updateExistingPivot($playerId, [
            'score' => \DB::raw('score + ' . $points)
        ]);

        $this->roundResults[] = [
            'player_id' => $playerId,
            'correct' => $answer->is_correct,
            'points' => $points
        ];

        $this->showResults = true;
        $this->dispatch('answer-submitted');
    }

    public function nextRound()
    {
        $this->currentRound++;

        if ($this->currentRound > $this->totalRounds || $this->currentRound > count($this->questions)) {
            $this->gameFinished = true;
            $this->loadPlayers();
            return;
        }

        if (isset($this->questions[$this->currentRound - 1])) {
            $this->currentQuestion = $this->questions[$this->currentRound - 1];
        } else {
            $this->gameFinished = true;
            return;
        }

        $this->showResults = false;
        $this->selectedAnswer = null;
        $this->roundResults = [];
        $this->loadPlayers();
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.game-room');
    }
}
