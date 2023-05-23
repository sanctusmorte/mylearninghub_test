<?php

namespace App\Http\Controllers;

use App\Http\Requests\Enrollments\EnrollmentsListRequest;
use App\Http\Resources\Enrollment\EnrollmentResource;
use App\Services\Enrollment\EnrollmentDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EnrollmentsController extends Controller
{
    public function getList(EnrollmentsListRequest $request, EnrollmentDataService $dataService): JsonResponse|AnonymousResourceCollection
    {
        try {
            $items = $dataService->getList($request->data());

            #dd($items);

            if (empty($items)) {
                return $this->responseError();
            }
        } catch (\Exception $e) {
            return $this->responseError();
        }

        return EnrollmentResource::collection($items);
    }

    public function getAvailableStatuses(EnrollmentDataService $dataService)
    {
        try {
            return $this->responseSuccess(['items' => $dataService->getAvailableStatuses()]);
        } catch (\Exception $e) {
            return $this->responseError();
        }
    }
}
