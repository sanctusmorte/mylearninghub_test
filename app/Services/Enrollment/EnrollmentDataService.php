<?php

namespace App\Services\Enrollment;

use App\Models\Course\Course;
use App\Models\Enrollment\Enrollment;
use App\Models\Enrollment\Enum\EnrollmentStatusEnum;
use App\Models\User\User;
use App\Services\Enrollment\DTO\EnrollmentGetListDTO;
use App\Services\Enrollment\Exceptions\EnrollmentCreateException;
use App\Services\Enrollment\Exceptions\EnrollmentEditException;

class EnrollmentDataService
{
    private EnrollmentProcessorFactory $factory;

    public function __construct(EnrollmentProcessorFactory $factory)
    {
        $this->factory = $factory;
    }

    public function getList(EnrollmentGetListDTO $DTO)
    {
        $processor = $this->factory->getProcessor($this->isFullSearch($DTO));

        return $processor->getList($DTO);
    }

    public function create(int $userId, int $courseId)
    {
        try {
            $user = User::findOrFail($userId);
            $course = Course::findOrFail($courseId);

            $enrollment = new Enrollment();
            $enrollment->user_id = $user->id;
            $enrollment->course_id = $course->id;
            $enrollment->status = EnrollmentStatusEnum::IN_PROGRESS;
            $enrollment->save();
        } catch (\Exception $e) {
            throw new EnrollmentCreateException();
        }
    }

    public function edit(int $id, string $status)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);
            $enrollment->status = $status;
            $enrollment->save();
        } catch (\Exception $e) {
            throw new EnrollmentEditException();
        }
    }

    public function delete(int $id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);
            $enrollment->delete();
        } catch (\Exception $e) {
            throw new EnrollmentEditException();
        }
    }

    public function getAvailableStatuses()
    {
        return Enrollment::select('status')->distinct()->get();
    }

    private function IsFullSearch(EnrollmentGetListDTO $DTO): bool
    {
        return !empty($DTO->getUserEmail()) || !empty($DTO->getUserName()) || !empty($DTO->getCourseTitle()) ||
               in_array($DTO->getSortColumn(), ['user_name', 'user_email', 'course_title']);
    }
}
