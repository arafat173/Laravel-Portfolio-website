<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;

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

Route::get('/',[HomeController::class,'HomeIndex'] )->middleware('loginCheck');
Route::get('/visitor',[VisitorController::class,'VisitorIndex'] )->middleware('loginCheck');


//Admin Panel Service Management
Route::get('/service',[ServiceController::class,'ServiceIndex'] )->middleware('loginCheck');
Route::get('/getServicesData',[ServiceController::class,'getServiceData'] )->middleware('loginCheck');
Route::post('/ServiceDelete',[ServiceController::class,'ServiceDelete'] )->middleware('loginCheck');
Route::post('/ServiceDetails',[ServiceController::class,'getServiceDetails'] )->middleware('loginCheck');
Route::post('/ServiceUpdate',[ServiceController::class,'ServiceUpdate'] )->middleware('loginCheck');
Route::post('/ServiceAdd',[ServiceController::class,'ServiceAdd'] )->middleware('loginCheck');

//Admin Panel Courses Management
Route::get('/Courses',[CoursesController::class,'CoursesIndex'] )->middleware('loginCheck');
Route::get('/getCoursesData',[CoursesController::class,'getCoursesData'] )->middleware('loginCheck');
Route::post('/CoursesDelete',[CoursesController::class,'CoursesDelete'] )->middleware('loginCheck');
Route::post('/CoursesDetails',[CoursesController::class,'getCoursesDetails'] )->middleware('loginCheck');
Route::post('/CoursesUpdate',[CoursesController::class,'CoursesUpdate'] )->middleware('loginCheck');
Route::post('/CoursesAdd',[CoursesController::class,'CoursesAdd'] )->middleware('loginCheck');


//Admin Panel project Management

Route::get('/project',[ProjectController::class,'ProjectIndex'] )->middleware('loginCheck');
Route::get('/getProjectData',[ProjectController::class,'getProjectData'] )->middleware('loginCheck');
Route::post('/ProjectDelete',[ProjectController::class,'ProjectDelete'] )->middleware('loginCheck');
Route::post('/ProjectDetails',[ProjectController::class,'getProjectDetails'] )->middleware('loginCheck');
Route::post('/ProjectUpdate',[ProjectController::class,'ProjectUpdate'] )->middleware('loginCheck');
Route::post('/ProjectAdd',[ProjectController::class,'ProjectAdd'] )->middleware('loginCheck');


//Admin Panel Contact Management

Route::get('/contact',[ContactController::class,'ContactIndex'] )->middleware('loginCheck');
Route::get('/getContactData',[ContactController::class,'getContactData'] )->middleware('loginCheck');
Route::post('/ContactDelete',[ContactController::class,'ContactDelete'] )->middleware('loginCheck');
Route::post('/ContactDetails',[ContactController::class,'getContactDetails'] )->middleware('loginCheck');
Route::post('/ContactUpdate',[ContactController::class,'ContactUpdate'] )->middleware('loginCheck');
Route::post('/ContactAdd',[ContactController::class,'ContactAdd'] )->middleware('loginCheck');


//Admin Panel Review Management
Route::get('/Review',[ReviewController::class,'ReviewIndex'] )->middleware('loginCheck');
Route::get('/getReviewData',[ReviewController::class,'getReviewData'] )->middleware('loginCheck');
Route::post('/ReviewDelete',[ReviewController::class,'ReviewDelete'] )->middleware('loginCheck');
Route::post('/ReviewDetails',[ReviewController::class,'getReviewDetails'] )->middleware('loginCheck');
Route::post('/ReviewUpdate',[ReviewController::class,'ReviewUpdate'] )->middleware('loginCheck');
Route::post('/ReviewAdd',[ReviewController::class,'ReviewAdd'] )->middleware('loginCheck');


//Admin Login Review
Route::get('/Logins',[LoginController::class,'LoginIndex'] );
Route::post('/onLogin',[LoginController::class,'onLogin'] );
Route::get('/Logout',[LoginController::class,'onLogOut'] );


