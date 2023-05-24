<?php

use App\Http\Controllers\EnrollmentsController;
use App\Http\Middleware\ApiTokenValid;
use Illuminate\Support\Facades\Route;

Route::get('/enrollments', [EnrollmentsController::class, 'getList'])->middleware([ApiTokenValid::class]);
Route::post('/enrollments', [EnrollmentsController::class, 'create']);
Route::put('/enrollments', [EnrollmentsController::class, 'edit']);
Route::delete('/enrollments', [EnrollmentsController::class, 'delete']);
Route::get('/enrollments/available-statuses', [EnrollmentsController::class, 'getAvailableStatuses'])->middleware([ApiTokenValid::class]);

