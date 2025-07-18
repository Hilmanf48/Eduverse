<?php




use Illuminate\Support\Facades\Route;


// Controller untuk User
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ProfileController;

// Controller untuk Admin
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admin\SessionController as AdminSessionController;
use App\Http\Controllers\Admin\UserController as AdminUserController;


/*
|
| Web Routes
|
*/

// Halaman utama user
Route::get('/', function () {
    return view('client.landing');
});


Route::get('/kelas', function () {
    return view('client.courses.index');
})->name('courses.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Route Dashboard menggunakan 
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

// Grup route untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // profile bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk fitur belajar user
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');

    Route::get('/quizzes/attempts/{attempt}', [QuizController::class, 'result'])->name('quizzes.result');
    
    // Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard'); // Kita nonaktifkan dulu sampai controllernya dibuat
});

// Grup route khusus untuk admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route resource untuk Courses
    Route::resource('courses', AdminCourseController::class);

    // Route untuk Sesi
    Route::post('sessions', [AdminSessionController::class, 'store'])->name('sessions.store');
    Route::delete('sessions/{session}', [AdminSessionController::class, 'destroy'])->name('sessions.destroy');

    // Route untuk Lessons (Video)
    Route::post('lessons', [AdminLessonController::class, 'store'])->name('lessons.store');
    Route::delete('lessons/{lesson}', [AdminLessonController::class, 'destroy'])->name('lessons.destroy');

    // Route untuk Quizzes
    Route::post('quizzes', [AdminQuizController::class, 'store'])->name('quizzes.store');

    // Route untuk Questions
    Route::post('questions', [AdminQuestionController::class, 'store'])->name('questions.store');
    Route::delete('questions/{question}', [AdminQuestionController::class, 'destroy'])->name('questions.destroy');

    // Route untuk Manajemen User
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
});


// Route untuk otentikasi (login, register, dll)
 require __DIR__.'/auth.php';