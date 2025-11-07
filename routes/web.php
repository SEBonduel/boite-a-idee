<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdeaController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/inscription', [AuthController::class, 'register'])->name('register.perform');

Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/connexion', [AuthController::class, 'login'])->name('login.perform');

Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [IdeaController::class, 'index'])->name('dashboard');

    Route::get('/ideas/create', [IdeaController::class, 'create'])->name('ideas.create');
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');

    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit');
    Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->name('ideas.update');
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy');

    Route::get('/ideas', function () {
        return redirect()->route('ideas.create');
    })->name('ideas.index');
});
