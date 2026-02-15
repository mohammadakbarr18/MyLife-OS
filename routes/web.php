<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ========== Home ==========
Route::get('/', function () {
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

// ========== Authenticated App Routes (Placeholder) ==========
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/transactions', function () {
    return view('dashboard'); // placeholder
})->name('transactions');

Route::get('/todos', function () {
    return view('dashboard'); // placeholder
})->name('todos');

Route::get('/settings', function () {
    return view('dashboard'); // placeholder
})->name('settings');
