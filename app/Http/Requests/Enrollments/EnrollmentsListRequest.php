<?php

namespace App\Http\Requests\Enrollments;

use App\Http\Requests\BaseRequest;
use App\Models\Enrollment\Enum\EnrollmentStatusEnum;
use App\Rules\Support\Rule;
use App\Services\Enrollment\DTO\EnrollmentGetListDTO;

class EnrollmentsListRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => ['string'],
            'user_email' => ['string'],
            'user_name' => ['string'],
            'status' => ['string', Rule::in(EnrollmentStatusEnum::list())],
            'limit' => ['integer', 'max:100'],
            'page' => ['integer'],
        ];
    }

    public function data(): EnrollmentGetListDTO
    {
        return new EnrollmentGetListDTO(
            $this->input('title'),
            $this->input('user_email'),
            $this->input('user_name'),
            $this->input('status'),
            is_null($this->get('limit')) ? 15 : (int)$this->get('limit'),
            ((int)$this->get('page', 1) - 1) * $this->get('limit', 15),
        );
    }
}
