<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonProgressController;

Route::middleware('api.token')->group(function () {
    Route::post('/lessons/{lesson}/complete', [LessonProgressController::class, 'store']);
});
