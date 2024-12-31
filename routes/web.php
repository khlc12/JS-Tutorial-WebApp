<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicController;

Route::get('/', [TopicController::class, 'index'])->name('topics.index');
Route::get('/topics/{topic:slug}/{subtopic?}', [TopicController::class, 'show'])->name('topics.show');

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');
    Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])->name('topics.destroy');
    Route::post('/topics/reorder', [TopicController::class, 'updateOrder'])->name('topics.reorder');
});

require __DIR__.'/auth.php';
