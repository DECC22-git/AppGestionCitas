<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentsController;
use App\Http\Controllers\Api\DiagnosticsController;
use App\Http\Controllers\Api\DoctorsController;
use App\Http\Controllers\Api\MedicationsController;
use App\Http\Controllers\Api\PatientsController;
use App\Http\Controllers\Api\TreatmentsController;



    Route::apiResource('patients', PatientsController::class);
    Route::apiResource('doctors', DoctorsController::class);
    Route::apiResource('appointments', AppointmentsController::class);
    Route::apiResource('diagnostics', DiagnosticsController::class);
    Route::apiResource('treatments', TreatmentsController::class);
    Route::apiResource('medications', MedicationsController::class);