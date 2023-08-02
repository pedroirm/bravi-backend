<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt.verify')->group(function () {
    Route::post('/store', [ContactController::class, 'store'])->name('store')->withoutMiddleware(VerifyCsrfToken::class);
    Route::put('contato/{id}', [ContactController::class, 'update'])->withoutMiddleware(VerifyCsrfToken::class)->name('update');
    Route::get('contato/{id}', [ContactController::class, 'show'])->name('update');
    Route::delete('contato/{id}', [ContactController::class, 'destroy'])->withoutMiddleware(VerifyCsrfToken::class)->name('destroy');
    Route::get('/contatos', [ContactController::class, 'index']);
});

Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware(VerifyCsrfToken::class)->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->withoutMiddleware(VerifyCsrfToken::class)->name('logout');
Route::post('/refresh', [AuthController::class, 'refresh'])->withoutMiddleware(VerifyCsrfToken::class)->name('refresh');
Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(VerifyCsrfToken::class)->name('login');

