<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
Route::get('/',[HomeController :: class,'index']);
Route::get('/questions',[QuestionController :: class,'showQuestions']);
Route::get('/poseQuestions',[QuestionController :: class,'showPoseQuestions']);
Route::post('/poseQuestions/store',[QuestionController :: class,'store'])->name('store');


