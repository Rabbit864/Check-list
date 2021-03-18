<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CheckListController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/redirect',[LoginController::class, 'redirectToProvider'])->name('redirect-google');
Route::get('/auth/google/callback', [LoginController::class, 'handleProviderCallback'])->name('callback-google');


Route::post('/createCheckList',[CheckListController::class,'create'])->name('create-check-list');


Route::get('/home', [HomeController::class, 'index'])->name('home');
