<?php

use App\Http\Controllers\CandidateTestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecruiterTestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth', 'role:candidate'])->group(function () {
        Route::get('/candidate-tests', [CandidateTestController::class, 'index'])->name('candidate-tests.index');
    });

    Route::middleware(['auth', 'role:recruiter'])->group(function () {
        Route::get('/recruiter-tests', [RecruiterTestController::class, 'index'])->name('recruiter-tests.index');

        Route::get('/recruiter-tests/create', [RecruiterTestController::class, 'create'])->name('recruiter-tests.create');
        Route::post('/recruiter-tests/create', [RecruiterTestController::class, 'store']);

        Route::get('/recruiter-tests/{testId}', [RecruiterTestController::class, 'edit'])->name('recruiter-tests.edit');
        Route::post('/recruiter-tests/{testId}', [RecruiterTestController::class, 'update']);

        Route::post('/recruiter-tests/delete/{testId}', [RecruiterTestController::class, 'delete'])->name('recruiter-tests.delete');
    });
});

require __DIR__.'/auth.php';
