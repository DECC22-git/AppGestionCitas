<?php

use App\Http\Controllers\Api\AppointmentsController;
use App\Http\Controllers\Api\DiagnosticsController;
use App\Http\Controllers\Api\DoctorsController;
use App\Http\Controllers\Api\MedicationsController;
use App\Http\Controllers\Api\PatientsController;
use App\Http\Controllers\Api\TreatmentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::get('/login/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('/login/github', [LoginController::class, 'redirectToGithub'])->name('auth.github');
Route::get('/login/github/callback', [LoginController::class, 'handleGithubCallback'])->name('auth.github.callback');


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    

    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');


    Route::resource('patient', PatientsController::class);
    Route::resource('doctor', DoctorsController::class);
    Route::resource('appointment', AppointmentsController::class);
    Route::resource('diagnostic', DiagnosticsController::class);
    Route::resource('treatment', TreatmentsController::class);
    Route::resource('medication', MedicationsController::class);
});
