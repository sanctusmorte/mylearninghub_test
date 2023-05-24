<?php

namespace App\Http\Controllers;

use App\Services\Course\CourseDataService;


class CoursesController extends Controller
{
    public function getList(CourseDataService $dataService)
    {
        try {
            return $this->responseSuccess(['items' => $dataService->getList()]);
        } catch (\Exception $e) {
            return $this->responseError();
        }
    }
}
