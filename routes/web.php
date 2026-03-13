<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReportController; // Don't forget this!
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OverdueNotificationController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated & Verified Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('index');
    Route::get('/overdue-pdf', [ReportController::class, 'overdueLoansPdf'])->name('overdue.pdf');
    Route::get('/borrowed-pdf', [ReportController::class, 'borrowedBooksPdf'])->name('borrowed.pdf');
});

    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin-only routes (add 'role:admin' middleware)
    Route::middleware(['role:admin'])->group(function () {
        // Resource controllers
        Route::resource('books', BookController::class);
        Route::resource('members', MemberController::class);
        Route::resource('loans', LoanController::class);

        Route::post('/overdue/send-notifications', [OverdueNotificationController::class, 'sendNotifications'])
    ->name('overdue.send')
    ->middleware(['auth', 'role:admin']);

        // Custom return route for loans
        Route::put('/loans/{loan}/return', [LoanController::class, 'returnBook'])
            ->name('loans.return');
    });
});

// Auth routes (login, register, etc.) - DO NOT remove this
require __DIR__.'/auth.php';