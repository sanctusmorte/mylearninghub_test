<?php

namespace App\Http\Requests\Enrollments;

use App\Http\Requests\BaseRequest;
use App\Models\Enrollment\Enum\EnrollmentStatusEnum;
use App\Rules\Support\Rule;


class EnrollmentDeleteRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => ['integer', 'required'],
        ];
    }
}
