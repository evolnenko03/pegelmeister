<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drinking Game Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-8">🍻 Drinking Game</h1>
        <div class="space-y-4">
            <a href="/create" class="block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">
                Create New Game
            </a>
            <a href="/join" class="block bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">
                Join Game
            </a>
        </div>
    </div>
</div>
@livewireScripts
</body>
</html>
