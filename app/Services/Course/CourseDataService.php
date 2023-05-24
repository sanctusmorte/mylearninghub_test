<?php

namespace App\Services\Course;

use App\Models\Course\Course;

class CourseDataService
{
    public function getList()
    {
        return Course::select('title', 'id')->get();
    }
}
