<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\ContactController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'HomeIndex'] );
Route::post('/contactSend',[HomeController::Class,'ContactSend']);
Route::get('/Courses',[CourseController::class,'Course'] );
Route::get('/Projects',[ProjectController::class,'Project'] );
Route::get('/Policy',[PolicyController::class,'Policy'] );
Route::get('/Terms',[TermsController::class,'Terms'] );
Route::get('/Contact',[ContactController::class,'ContactPage'] );
