<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route::middleware(['auth'])->group(function () {
//Route::get('/', [ContactController::class, 'index']);
Route::post('/store', [ContactController::class, 'store'])->name('store')->withoutMiddleware(VerifyCsrfToken::class);
Route::put('contato/{id}', [ContactController::class, 'update'])->withoutMiddleware(VerifyCsrfToken::class)->name('update');
Route::get('contato/{id}', [ContactController::class, 'show'])->name('update');
Route::delete('contato/{id}', [ContactController::class, 'destroy'])->withoutMiddleware(VerifyCsrfToken::class)->name('destroy');

//Route::resource('/contatos', ContactController::class);

//});        Route::resource('/influencers', AdminInfluencersController::class);

Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware(VerifyCsrfToken::class)->name('register');
//Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(VerifyCsrfToken::class)->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->withoutMiddleware(VerifyCsrfToken::class)->name('logout');
Route::post('/refresh', [AuthController::class, 'refresh'])->withoutMiddleware(VerifyCsrfToken::class)->name('refresh');
//Route::post('/refresh', 'refresh');

//Route::controller(AuthController::class)->group(function () {
//});
