<?php

use App\Http\Controllers\cms\ListeningController;
use App\Http\Controllers\cms\PracticeController;
use App\Http\Controllers\cms\ReadingController;
use App\Http\Controllers\cms\SpeakingController;
use Illuminate\Support\Facades\Route;

Route::prefix('cms')->name('cms.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard',    [PracticeController::class,'dashboard'])->name('dashboard');
    Route::get('/chat',         [PracticeController::class,'chat'])->name('chat');
    Route::post('/ask-ai',      [PracticeController::class,'askAI'])->name('askAi');
    Route::post('/save-session',[PracticeController::class,'saveSession'])->name('saveSession');
    Route::get('/progress',     [PracticeController::class,'progress'])->name('progress');

    //SpeakingController
    Route::get('/speaking',             [SpeakingController::class,'index'])->name('speaking');
    Route::post('/speaking/evaluate',   [SpeakingController::class,'evaluate'])->name('speaking.evaluate');

    // ListeningController
    Route::get('/listening',            [ListeningController::class,'index'])->name('listening');
    Route::post('/listening/evaluate',  [ListeningController::class,'evaluate'])->name('listening.evaluate');

    //ReadingController
    Route::get('/reading',              [ReadingController::class,'index'])->name('reading');
    Route::post('/reading/evaluate',    [ReadingController::class,'evaluate'])->name('reading.evaluate');
});
