<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name,
            'id' => $this->resource->id,
            'email' => $this->resource->email,
        ];
    }
}
