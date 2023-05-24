<?php

namespace App\Http\Requests\Enrollments;

use App\Http\Requests\BaseRequest;
use App\Models\Enrollment\Enum\EnrollmentStatusEnum;
use App\Rules\Support\Rule;


class EnrollmentCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['integer', 'required'],
            'course_id' => ['integer', 'required'],
        ];
    }
}
