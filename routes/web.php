<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameSessionController;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::post('/session/create', [GameSessionController::class, 'create']);
Route::post('/session/join', [GameSessionController::class, 'join']);
Route::get('/session/{code}/players', [GameSessionController::class, 'getPlayers']);

// Game Routes
Route::get('/categories', [GameController::class, 'getCategories']);
Route::post('/game/start', [GameController::class, 'startGame']);
Route::post('/game/answer', [GameController::class, 'submitAnswer']);
Route::get('/game/{sessionCode}/scores', [GameController::class, 'getScores']);

// Game Pages
Route::get('/create', function () {
    return view('create-session');
});

Route::get('/join', function () {
    return view('join-session');
});

Route::get('/game/{code}', function ($code) {
    return view('game', ['code' => $code]);
})->name('game.room');

require __DIR__.'/auth.php';
