<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CheckListController;
use App\Http\Controllers\DetailingController;
use App\Http\Controllers\ParagraphController;
use App\Http\Controllers\SubParagraphController;
use App\Models\SubParagraph;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/redirect',[LoginController::class, 'redirectToProvider'])->name('redirect-google');
Route::get('/auth/google/callback', [LoginController::class, 'handleProviderCallback'])->name('callback-google');


Route::post('/createCheckList',[CheckListController::class,'create'])->name('create-check-list');
Route::get('/detailing/{id}',[DetailingController::class,'show'])->name('detailing');
Route::post('/createParagraph/{checkList}',[ParagraphController::class,'create'])->name('create-paragraph');
Route::post('/updateStatus/{paragraph}',[ParagraphController::class,'updateStatus'])->name('update-status');
Route::post('/createSubParagraph',[SubParagraphController::class,'create'])->name('create-sub-paragraph');
Route::post('/updateSubStatus/{subParagraph}', [SubParagraphController::class,'updateStatus'])->name('update-sub-status');
Route::put('/updateCheckList/{checkList}',[CheckListController::class,'update'])->name('update-check-list');
Route::delete('/deleteCheckList/{checkList}', [CheckListController::class,'destroy'])->name('destroy-check-list');

Route::get('/home', [HomeController::class, 'index'])->name('home');
