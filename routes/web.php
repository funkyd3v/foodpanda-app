<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return '<h1>Welcome, ' . auth()->user()->name . '</h1>';
    })->name('dashboard');
});