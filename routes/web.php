<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
Route::get('/',[HomeController :: class,'index'])->name('home');
Route::get('/questions', [QuestionController::class, 'showQuestions'])->name('questions');
Route::get('/poseQuestions',[QuestionController :: class,'showPoseQuestions']);
Route::post('/poseQuestions/store',[QuestionController :: class,'store'])->name('store');
Route::get('/register' ,[AuthController :: class ,'index'])->name('register');
Route::post('/register/store', [AuthController::class, 'store'])->name('auth.register.store');
Route::get('/login',[AuthController::class,'showLogin']);
Route::post('/login',[AuthController::class ,'login'])->name('login');
Route::get('/logout',[AuthController::class ,'logout'])->name('logout');





