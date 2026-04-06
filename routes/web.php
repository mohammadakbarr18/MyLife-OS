<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ========== Home ==========
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// ========== Guest Routes (Auth Forms) ==========
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========== Authenticated App Routes ==========
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/transactions/summary', [TransactionController::class, 'summary'])->name('transactions.summary');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    
    Route::get('/todo', [TodoController::class, 'index'])->name('todo');
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
    Route::patch('/todo/{todo}/toggle', [TodoController::class, 'toggle'])->name('todo.toggle');
    Route::put('/todo/{todo}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');

    // ========== Schedule (Daily Planner) ==========
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::put('/schedule/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

    // ========== Settings ==========
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
    Route::post('/settings/categories', [SettingsController::class, 'storeCategory'])->name('settings.categories.store');
    Route::put('/settings/categories/{category}', [SettingsController::class, 'updateCategory'])->name('settings.categories.update');
    Route::delete('/settings/categories/{category}', [SettingsController::class, 'destroyCategory'])->name('settings.categories.destroy');
    Route::post('/settings/priorities', [SettingsController::class, 'storePriority'])->name('settings.priorities.store');
    Route::put('/settings/priorities/{taskPriority}', [SettingsController::class, 'updatePriority'])->name('settings.priorities.update');
    Route::delete('/settings/priorities/{taskPriority}', [SettingsController::class, 'destroyPriority'])->name('settings.priorities.destroy');

});
