<?php

use App\Http\Controllers\CoursesController;
use App\Http\Middleware\ApiTokenValid;
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CoursesController::class, 'getList'])->middleware([ApiTokenValid::class]);

