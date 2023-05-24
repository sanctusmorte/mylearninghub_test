<?php

use App\Http\Controllers\UsersController;
use App\Http\Middleware\ApiTokenValid;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UsersController::class, 'getList'])->middleware([ApiTokenValid::class]);

