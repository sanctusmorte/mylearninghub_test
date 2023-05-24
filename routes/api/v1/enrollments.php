<?php

use App\Http\Controllers\EnrollmentsController;
use Illuminate\Support\Facades\Route;

Route::get('/enrollments', [EnrollmentsController::class, 'getList']);
Route::post('/enrollments', [EnrollmentsController::class, 'create']);
Route::put('/enrollments', [EnrollmentsController::class, 'edit']);
Route::delete('/enrollments', [EnrollmentsController::class, 'delete']);
Route::get('/enrollments/available-statuses', [EnrollmentsController::class, 'getAvailableStatuses']);

