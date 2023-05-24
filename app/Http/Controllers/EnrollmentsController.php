<?php

namespace App\Http\Controllers;

use App\Constants\ResponseEnum;
use App\Http\Requests\Enrollments\EnrollmentCreateRequest;
use App\Http\Requests\Enrollments\EnrollmentEditRequest;
use App\Http\Requests\Enrollments\EnrollmentsListRequest;
use App\Http\Resources\Enrollment\EnrollmentResource;
use App\Services\Enrollment\EnrollmentDataService;
use App\Services\Enrollment\Exceptions\EnrollmentCreateException;
use App\Services\Enrollment\Exceptions\EnrollmentEditException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EnrollmentsController extends Controller
{
    public function getList(EnrollmentsListRequest $request, EnrollmentDataService $dataService): JsonResponse|AnonymousResourceCollection
    {
        try {
            $items = $dataService->getList($request->data());

            if (empty($items)) {
                return $this->responseError();
            }
        } catch (\Exception $e) {
            return $this->responseError();
        }

        return EnrollmentResource::collection($items);
    }

    public function createNew()
    {
        return view('enrollments/new');
    }

    public function create(EnrollmentCreateRequest $request, EnrollmentDataService $dataService): JsonResponse
    {
        try {
            $dataService->create($request->input('user_id'), $request->input('course_id'));
        } catch (EnrollmentCreateException $e) {
            return $this->responseError(ResponseEnum::CREATE_ERROR);
        }

        return $this->responseSuccess();
    }

    public function edit(EnrollmentEditRequest $request, EnrollmentDataService $dataService): JsonResponse
    {
        try {
            $dataService->edit($request->input('id'), $request->input('status'));
        } catch (EnrollmentEditException $e) {
            return $this->responseError(ResponseEnum::EDIT_ERROR);
        }

        return $this->responseSuccess();
    }

    public function delete(EnrollmentEditRequest $request, EnrollmentDataService $dataService): JsonResponse
    {
        try {
            $dataService->delete($request->input('id'));
        } catch (EnrollmentEditException $e) {
            return $this->responseError(ResponseEnum::DELETE_ERROR);
        }

        return $this->responseSuccess();
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
