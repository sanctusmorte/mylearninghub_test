<?php

namespace App\Services\Enrollment\Processors;

use App\Services\Enrollment\DTO\EnrollmentGetListDTO;
use App\Services\Enrollment\Exceptions\EnrollmentFullSearchException;
use Illuminate\Support\Facades\DB;

class FullSearchProcessor implements EnrollmentProcessor
{
    const COLUMN_MAPPER = [
        'id' => 'enrollments.id',
        'status' => 'courses.status',
        'course_title' => 'courses.title',
        'user_email' => 'users.email',
        'user_name' => 'users.name',
    ];

    public function getList(EnrollmentGetListDTO $DTO)
    {
        try {
            $query = DB::table('enrollments')
                ->join('users', 'enrollments.user_id', '=', 'users.id')
                ->join('courses', 'enrollments.course_id', '=', 'courses.id');

            if (!empty($DTO->getUserName())) {
                $query->where('users.name', 'like', '%'.$DTO->getUserName().'%');
            }

            if (!empty($DTO->getUserEmail())) {
                $query->where('users.email', 'like', '%'.$DTO->getUserEmail().'%');
            }

            if (!empty($DTO->getCourseTitle())) {
                $query->where('courses.title', 'like', '%'.$DTO->getCourseTitle().'%');
            }

            return $query
                ->select(
                    [
                        'enrollments.id as enrollment_id', 'users.email as user_email', 'users.name as user_name',
                        'users.id as user_id', 'courses.title as course_title','courses.id as course_id', 'status'
                    ]
                )
                ->orderBy(self::COLUMN_MAPPER[$DTO->getSortColumn()], $DTO->getSortDir())
                ->paginate($DTO->getLimit());
        } catch (\Exception $e) {
            dd($e);
            throw new EnrollmentFullSearchException($e->getMessage(), 402, $e);
        }
    }
}
