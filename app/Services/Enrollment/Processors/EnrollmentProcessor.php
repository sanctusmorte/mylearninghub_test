<?php

namespace App\Services\Enrollment\Processors;

use App\Services\Enrollment\DTO\EnrollmentGetListDTO;

interface EnrollmentProcessor
{
    public function getList(EnrollmentGetListDTO $DTO);
}
