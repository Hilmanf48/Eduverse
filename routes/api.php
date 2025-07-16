<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonProgressController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route untuk menyimpan progress lesson
Route::post('/lessons/{lesson}/complete', [LessonProgressController::class, 'store'])->middleware('auth:sanctum');