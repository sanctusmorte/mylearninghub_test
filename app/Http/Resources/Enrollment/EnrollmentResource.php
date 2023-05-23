<?php

declare(strict_types=1);

namespace App\Http\Resources\Enrollment;

use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    public function toArray($request): array
    {
        if (isset($this->resource->enrollment_id)) {
            return [
                'id' => $this->resource->enrollment_id,
                'status' => $this->resource->status,
                'course' => [
                    'title' => $this->resource->course_title,
                    'id' => $this->resource->course_id,
                ],
                'user' => [
                    'id' => $this->resource->user_id,
                    'email' => $this->resource->user_email,
                    'name' => $this->resource->user_name,
                ],
            ];
        }

        return [
            'id' => $this->resource->id,
            'status' => $this->resource->status,
            'course' => new CourseResource($this->resource->course()->firstOrFail()),
            'user' => new UserResource($this->resource->user()->firstOrFail()),
        ];
    }
}
