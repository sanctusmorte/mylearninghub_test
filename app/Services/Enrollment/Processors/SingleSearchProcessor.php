<?php

namespace App\Services\Enrollment\Processors;

use App\Models\Enrollment\Enrollment;
use App\Services\Enrollment\DTO\EnrollmentGetListDTO;

class SingleSearchProcessor implements EnrollmentProcessor
{
    public function getList(EnrollmentGetListDTO $DTO)
    {
        $where = [];

        if (!empty($DTO->getStatus())) {
            $where['status'] = $DTO->getStatus();
        }

        return Enrollment::where($where)
            ->orderBy($DTO->getSortColumn(), $DTO->getSortDir())
            ->paginate($DTO->getLimit())->onEachSide(1);
    }
}
