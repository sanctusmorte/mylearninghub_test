<?php

namespace App\Support;

use App\Constants\ResponseEnum;
use JsonSerializable;

class Response implements JsonSerializable
{
    public ?string $status = null;
    public ?string $errorMessage = null;

    public static function basicResponse(array $data = []): self
    {
        $obj = new static;
        $obj->setData($data);

        return $obj;
    }

    public static function responseSuccess(array $data = []): self
    {
        $obj = new static;
        $obj->status = ResponseEnum::RESPONSE_STATUS_SUCCESS;
        $obj->setData($data);

        unset($obj->errorMessage);

        return $obj;
    }

    public static function responseError(string $errorMessage = '', array $data = []): self
    {
        $obj = new static;
        $obj->setData($data);
        $obj->status = ResponseEnum::RESPONSE_STATUS_ERROR;
        $obj->errorMessage = $errorMessage;

        return $obj;
    }

    public function isSuccess(): bool
    {
        return $this->status === ResponseEnum::RESPONSE_STATUS_SUCCESS;
    }

    public function isError(): bool
    {
        return $this->status === ResponseEnum::RESPONSE_STATUS_ERROR;
    }

    public function isInfo(): bool
    {
        return $this->status === ResponseEnum::RESPONSE_STATUS_INFO;
    }

    protected function setData($data): bool
    {
        if (empty($data)) {
            return true;
        }

        foreach ($data as $key => $prop) {
            $this->{$key} = $prop;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getData(): self
    {
        unset($this->status);
        unset($this->error_message);

        return $this;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
