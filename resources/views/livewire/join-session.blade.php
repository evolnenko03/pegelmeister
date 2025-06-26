<div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    @if(!$joined)
        <h2 class="text-2xl font-bold mb-4">Join Game Session</h2>
        @if($error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ $error }}</div>
        @endif
        <form wire:submit.prevent="joinSession">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Session Code</label>
                <input type="text" wire:model="sessionCode" class="w-full p-2 border rounded uppercase" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Your Name</label>
                <input type="text" wire:model="playerName" class="w-full p-2 border rounded" required>
                @error('playerName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                Join Session
            </button>
        </form>
    @endif
</div>
