<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BienController;
use App\Http\Controllers\UserController;


Route::get('/', [BienController::class, 'Home'])->name('home');

Route::get('/CreateAccount', [UserController::class, 'create'])->name('users.create');
Route::post('/CreateAccount', [UserController::class, 'store'])->name('users.store');

Route::get('/login', [UserController::class, 'log'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('users.login');
Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');

Route::get('/forgot-password', [UserController::class, 'ViewForgotPassword'])->name('ViewforgotPassword');
Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('ForgotPassword');

Route::get('/reset-password', [UserController::class, 'ViewResetPassword'])->name('ViewResetPassword');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('ResetPassword');


Route::middleware('auth')->group(function () {
    Route::get('/account', fn() => view('account.index'));
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/create', function () {
        return view('biens.createbien');
    });
    Route::post('/create', [BienController::class, 'store'])->name('biens.store');
    Route::get('/biens/{bien}/edit', [BienController::class, 'edit'])->name('biens.edit');
    Route::post('/biens/{bien}/edit', [BienController::class, 'update'])->name('biens.update');
    Route::delete('/biens/{bien}', [BienController::class, 'destroy'])->name('biens.destroy');
});

Route::get('/biens', [BienController::class, 'index'])->name('biens.index');
Route::get('/biens/{bien}', [BienController::class, 'show'])->name('biens.show');
Route::post('/biens/{bien}/contact', [BienController::class, 'contact'])->name('biens.contact');


//Route::get('/biens/deepsearch', [BienController::class, 'deepsearch'])->name('biens.deepsearch');
//Route::get('/biens')
