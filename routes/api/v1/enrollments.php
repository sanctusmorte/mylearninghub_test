<?php

use App\Http\Controllers\EnrollmentsController;
use Illuminate\Support\Facades\Route;

Route::get('/enrollments', [EnrollmentsController::class, 'getList']);
Route::get('/enrollments/available-statuses', [EnrollmentsController::class, 'getAvailableStatuses']);

