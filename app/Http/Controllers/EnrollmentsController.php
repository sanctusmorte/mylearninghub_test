<?php

namespace App\Http\Controllers;

use App\Http\Requests\Enrollments\EnrollmentsListRequest;
use App\Services\Enrollment\EnrollmentDataService;

class EnrollmentsController extends Controller
{
    public function getList(EnrollmentsListRequest $request, EnrollmentDataService $dataService)
    {
        try {
            $data = $dataService->getList($request->data());
            dd($data);
            return $this->responseList($dataService->getList($request->data()), 10);
        } catch (\Exception $e) {
            dd($e);
            return $this->responseError();
        }
    }
}
