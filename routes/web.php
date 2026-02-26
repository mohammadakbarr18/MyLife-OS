<?php

use App\Http\Controllers\AuthController;
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

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/transactions', function () {
        return view('transactions');
    })->name('transactions');

    Route::get('/todo', function () {
        return view('todo');
    })->name('todo');

    Route::get('/settings', function () {
        return view('dashboard'); // placeholder — settings page TBD
    })->name('settings');

});
