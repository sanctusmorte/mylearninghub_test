<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require 'api/v1/enrollments.php';
    require 'api/v1/courses.php';
    require 'api/v1/users.php';
});
