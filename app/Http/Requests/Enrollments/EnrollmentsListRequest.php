<?php

namespace App\Http\Requests\Enrollments;

use App\Http\Requests\BaseRequest;
use App\Models\Enrollment\Enum\EnrollmentStatusEnum;
use App\Rules\Support\Rule;
use App\Services\Enrollment\DTO\EnrollmentGetListDTO;

class EnrollmentsListRequest extends BaseRequest
{
    private int $defaultLimit = 20;

    public function rules(): array
    {
        return [
            'course_title' => 'string',
            'user_email' => 'string',
            'user_name' => 'string',
            'status' => ['string', Rule::in(EnrollmentStatusEnum::list())],
            'limit' => ['integer', 'max:100'],
            'page' => 'integer',
            'sort_column' => ['string', Rule::in(['id', 'course_title', 'user_email', 'user_name', 'status'])],
            'sort_dir' => ['string', Rule::in(['desc', 'asc'])],
        ];
    }

    public function data(): EnrollmentGetListDTO
    {
        return new EnrollmentGetListDTO(
            $this->input('course_title'),
            $this->input('user_email'),
            $this->input('user_name'),
            $this->input('status'),
            is_null($this->get('limit')) ? $this->defaultLimit : (int)$this->get('limit'),
            ((int)$this->get('page', 1) - 1) * $this->get('limit', $this->defaultLimit),
            $this->input('sort_column') ?? 'id',
            $this->input('sort_dir') ?? 'desc',
        );
    }
}
