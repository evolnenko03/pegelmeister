<div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    @if(!$sessionCreated)
        <h2 class="text-2xl font-bold mb-4">Create Game Session</h2>
        <form wire:submit.prevent="createSession">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Your Name</label>
                <input type="text" wire:model="playerName" class="w-full p-2 border rounded" required>
                @error('playerName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                Create Session
            </button>
        </form>
    @else
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4">Session Created!</h2>
            <div class="mb-4">
                <p class="text-lg">Session Code:</p>
                <p class="text-3xl font-mono bg-gray-100 p-4 rounded">{{ $sessionCode }}</p>
            </div>
            <a href="/game/{{ $sessionCode }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Enter Game Room
            </a>
        </div>
    @endif
</div>
