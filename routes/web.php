<?php

use Illuminate\Support\Facades\Route;

// Controller Public
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ProfileController;

// Controller Autentikasi
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\PasswordController;

// Controller Admin
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admin\SessionController as AdminSessionController;
use App\Http\Controllers\Admin\UserController as AdminUserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE UNTUK PENGUNJUNG (TIDAK PERLU LOGIN) ---
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// --- RUTE AUTENTIKASI (LOGIN, REGISTER, LUPA PASSWORD, SOCIALITE) ---
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');

    
    // Socialite Routes
    Route::get('auth/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirect');
    Route::get('auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])->name('socialite.callback');
});


// --- RUTE UNTUK USER YANG SUDAH LOGIN ---
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/quizzes/attempts/{attempt}', [QuizController::class, 'result'])->name('quizzes.result');
});


// --- RUTE KHUSUS UNTUK ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('courses', AdminCourseController::class);
    Route::post('sessions', [AdminSessionController::class, 'store'])->name('sessions.store');
    Route::delete('sessions/{session}', [AdminSessionController::class, 'destroy'])->name('sessions.destroy');
    Route::post('lessons', [AdminLessonController::class, 'store'])->name('lessons.store');
    Route::delete('lessons/{lesson}', [AdminLessonController::class, 'destroy'])->name('lessons.destroy');
    Route::post('quizzes', [AdminQuizController::class, 'store'])->name('quizzes.store');
    Route::post('questions', [AdminQuestionController::class, 'store'])->name('questions.store');
    Route::delete('questions/{question}', [AdminQuestionController::class, 'destroy'])->name('questions.destroy');
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
});