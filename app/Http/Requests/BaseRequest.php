<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

class BaseRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    protected function failedValidation(Validator $validator): void
    {
        $errors = [];

        foreach ($validator->errors()->toArray() as $key => $value) {
            $errors[$key] = array_shift($value);
        }

        throw new HttpResponseException(
            Response::json(['errors' => $errors, 'status' => 'error', 'error_message' => 'wrong_params'])
        );
    }
}
