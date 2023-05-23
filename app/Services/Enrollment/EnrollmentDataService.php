<?php

namespace App\Services\Enrollment;

use App\Models\Enrollment\Enrollment;
use App\Services\Enrollment\DTO\EnrollmentGetListDTO;

class EnrollmentDataService
{
    public function getList(EnrollmentGetListDTO $DTO)
    {
        $where = [];

        if (!empty($DTO->getStatus())) {
            $where['status'] = $DTO->getStatus();
        }

        return Enrollment::where($where)->limit($DTO->getLimit())->skip($DTO->getOffset())->get()->toArray();
    }
}
