<?php

use App\Http\Controllers\Auth\KeycloakController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return redirect()->route('auth.keycloak.redirect');
})->name('login');

Route::post('/logout', [KeycloakController::class, 'logout'])
    ->name('logout');

Route::get('/auth/redirect', [KeycloakController::class, 'redirect'])
    ->name('auth.keycloak.redirect');

Route::get('/auth/callback', [KeycloakController::class, 'callback'])
    ->name('auth.keycloak.callback');

Route::post('/auth/logout/backchannel', [KeycloakController::class, 'backchannelLogout'])
    ->name('auth.keycloak.backchannel')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);