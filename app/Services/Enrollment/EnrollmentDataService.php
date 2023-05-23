<?php

namespace App\Services\Enrollment;

use App\Models\Enrollment\Enrollment;
use App\Services\Enrollment\DTO\EnrollmentGetListDTO;

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
