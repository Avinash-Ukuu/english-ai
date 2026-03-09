<?php

use App\Http\Controllers\cms\ConversationController;
use App\Http\Controllers\cms\DashboardController;
use App\Http\Controllers\cms\ListeningController;
use App\Http\Controllers\cms\PracticeController;
use App\Http\Controllers\cms\ProgressController;
use App\Http\Controllers\cms\ReadingController;
use App\Http\Controllers\cms\SpeakingController;
use Illuminate\Support\Facades\Route;

Route::prefix('cms')->name('cms.')->middleware(['auth'])->group(function () {
    //Dashboard
    Route::get('/dashboard',            [DashboardController::class,'dashboard'])->name('dashboard');

    //SpeakingController
    Route::get('/speaking',             [SpeakingController::class,'index'])->name('speaking');
    Route::post('/speaking/evaluate',   [SpeakingController::class,'evaluate'])->name('speaking.evaluate');

    // ListeningController
    Route::get('/listening',            [ListeningController::class,'index'])->name('listening');
    Route::post('/listening/evaluate',  [ListeningController::class,'evaluate'])->name('listening.evaluate');

    //ReadingController
    Route::get('/reading',              [ReadingController::class,'index'])->name('reading');
    Route::post('/reading/evaluate',    [ReadingController::class,'evaluate'])->name('reading.evaluate');

    //ConversationController
    Route::get('/conversation',         [ConversationController::class,'index'])->name('conversation');
    Route::post('/conversation/send',   [ConversationController::class,'send'])->name('conversation.send');

    //ProgressController
    Route::get('/progress',             [ProgressController::class,'index'])->name('progress');
});
