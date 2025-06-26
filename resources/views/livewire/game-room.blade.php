<div class="max-w-4xl mx-auto mt-8 p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="text-2xl font-bold">Game Room: {{ $sessionCode }}</div>
            <div class="text-sm text-gray-600">Round {{ $currentRound }}/{{ $totalRounds }}</div>
        </div>

        <div class="mb-6">
            <div class="text-lg font-semibold mb-2">Players:</div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                @foreach($players as $player)
                    <div class="bg-gray-100 p-2 rounded text-center">
                        <div class="font-medium">{{ $player->player_name }}</div>
                        <div class="text-sm text-gray-600">{{ $player->pivot?->score ?? 0 }} pts</div>
                    </div>
                @endforeach
            </div>
        </div>

        @if(!$gameStarted)
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Game Setup</h3>

                @if($isHost)
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Select Category:</label>
                        <select wire:model="selectedCategory" class="w-full p-2 border rounded">
                            <option value="">Choose a category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Number of Rounds:</label>
                        <input type="number" wire:model="totalRounds" min="5" max="50" class="w-full p-2 border rounded">
                    </div>
                    <button wire:click="startGame" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Start Game
                    </button>
                @else
                    <div class="p-4 bg-yellow-100 rounded text-center">
                        Warte darauf, dass der Host das Spiel startet...
                    </div>
                @endif
            </div>
        @elseif($gameFinished)
            <div class="text-center">
                <h2 class="text-3xl font-bold mb-4">Game Over!</h2>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold mb-2">Final Scores:</h3>
                    @foreach($players->sortByDesc('pivot.score') as $player)
                        <div class="bg-gray-100 p-3 rounded mb-2">
                            <span class="font-medium">{{ $player->player_name }}</span>
                            <span class="float-right">{{ $player->pivot?->score ?? 0 }} points</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @elseif($showResults)
            <div class="text-center mb-6">
                <div class="text-xl font-semibold mb-4">Round {{ $currentRound }} Results</div>
                <div class="mb-4">
                    <div class="text-lg">Correct Answer: <div class="font-bold">{{ $currentQuestion->correctAnswer->answer }}</div></div>
                </div>
                <button wire:click="nextRound" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Next Round
                </button>
            </div>
        @else
            <div class="mb-6">
                <div class="bg-blue-100 p-4 rounded mb-4">
                    <h3 class="text-xl font-semibold mb-2">Question {{ $currentRound }}:</h3>
                    <p class="text-lg">{{ $currentQuestion->question }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($currentQuestion->answers as $answer)
                        <button
                            wire:click="submitAnswer({{ $answer->id }})"
                            class="p-3 border rounded hover:bg-blue-50 text-left"
                            @if($selectedAnswer) disabled @endif
                        >
                            {{ $answer->answer }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
